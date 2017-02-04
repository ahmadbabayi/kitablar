<?php

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('session');
    }

    public function index() {
        redirect('user/login', 'location');
    }

    public function register() {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('captcha');
        $vals = array('img_path' => './captcha/',
            'img_url' => $this->config->base_url().'/captcha/',
            'font_path' => './system/fonts/texb.ttf',
            'img_width' => '150',
            'img_height' => 30,
            'expiration' => 7200,
            'word_length' => 6,
            'font_size' => 16,
            'img_id' => 'Imageid',
            'pool' => '0123456789',
            // White background and border, black text and red grid
            'colors' => array(
                'background' => array(255, 255, 255),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array(255, 40, 40)
            )
        );
        $cap = create_captcha($vals);
        $data['captcha'] = $cap['image'];
        $this->session->set_userdata('captchaword', $cap['word']);

        $data['description'] = 'user registration form';
        $data['keywords'] = '';
        $data['title'] = 'user registration';
        $this->load->view('header', $data);
        $this->load->view('user/register/register', $data);
        $this->load->view('footer');
    }

    public function captcha($str) {
        $captchaword = $this->session->userdata('captchaword');
        if ($captchaword != $str) {
            $this->form_validation->set_message('captcha', 'The %s was not input correctly. Please try again.');
            return false;
        }

        return true;
    }

    public function registering() {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('captcha');

        $str = $this->input->post('captcha');
        $word = $this->session->userdata('captchaword');


        $this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|min_length[4]|is_unique[users.username]', array('is_unique' => 'This username already exists. Please choose another one.'));
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|min_length[6]|matches[password]');
        $this->form_validation->set_rules('captcha', 'CAPTCHA', 'trim|required|callback_captcha');


        if ($this->form_validation->run() == TRUE && strcmp(strtoupper($str), strtoupper($word)) == 0) {
            // set variables from the form
            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            if ($this->user_model->create_user($username, $email, $password)) {

                // user creation ok
                $this->session->unset_userdata('captchaword');
                $this->load->view('header', $data);
                $this->load->view('user/register/register_success');
                $this->load->view('footer');
            } else {

                // user creation failed, this should never happen
                $data->error = 'There was a problem creating your new account. Please try again.';

                // send error to the view
                $this->load->view('header', $data);
                $this->load->view('user/register/register', $data);
                $this->load->view('footer');
            }
        } else {
            // validation not ok, send validation errors to the view
            $vals = array('img_path' => './captcha/',
                'img_url' => $this->config->base_url().'/captcha/',
                'font_path' => './system/fonts/texb.ttf',
                'img_width' => '150',
                'img_height' => 30,
                'expiration' => 7200,
                'word_length' => 6,
                'font_size' => 16,
                'img_id' => 'Imageid',
                'pool' => '0123456789',
                // White background and border, black text and red grid
                'colors' => array(
                    'background' => array(255, 255, 255),
                    'border' => array(255, 255, 255),
                    'text' => array(0, 0, 0),
                    'grid' => array(255, 40, 40)
                )
            );
            $cap = create_captcha($vals);
            $data['captcha'] = $cap['image'];
            $this->session->set_userdata('captchaword', $cap['word']);
            $this->load->view('header', $data);
            $this->load->view('user/register/register', $data);
            $this->load->view('footer');
        }
    }

    public function login() {
        // load form helper and validation library
        $this->load->helper('form');
        $this->load->library('form_validation');
        $data['description'] = 'user login form';
        $data['keywords'] = '';
        $data['title'] = 'user login';

        // set validation rules
        $this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == false) {

            // validation not ok, send validation errors to the view
            $this->load->view('header', $data);
            $this->load->view('user/login/login');
            $this->load->view('footer');
        } else {

            // set variables from the form
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            if ($this->user_model->resolve_user_login($username, $password)) {

                $user_id = $this->user_model->get_user_id_from_username($username);
                $user = $this->user_model->get_user($user_id);

                // set session user datas
                $_SESSION['user_id'] = (int) $user->id;
                $_SESSION['username'] = (string) $user->username;
                $_SESSION['logged_in'] = (bool) true;
                $_SESSION['is_confirmed'] = (bool) $user->is_confirmed;
                $_SESSION['is_admin'] = (bool) $user->is_admin;

                // user login ok
                redirect('member/', 'location');
            } else {

                // login failed
                $data['errormatn'] = '<div>Wrong username or password.</div>';

                // send error to the view
                $this->load->view('header', $data);
                $this->load->view('user/login/login', $data);
                $this->load->view('footer');
            }
        }
    }

    public function logout() {
        $data['description'] = 'user logout';
        $data['keywords'] = '';
        $data['title'] = 'user logout';
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {

            // remove session datas
            foreach ($_SESSION as $key => $value) {
                unset($_SESSION[$key]);
            }

            // user logout ok
            $this->load->view('header', $data);
            $this->load->view('user/logout/logout_success', $data);
            $this->load->view('footer');
        } else {

            // there user was not logged in, we cannot logged him out,
            // redirect him to site root
            redirect('/');
        }
    }

}

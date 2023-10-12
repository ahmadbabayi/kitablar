<?php

class Contactus extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Your own constructor code
        $this->load->library('form_validation');
        $this->load->model('contact_model');
    }

    public function index() {
        //captcha
        $this->load->helper('captcha');   
        $this->load->helper('spam_helper');
        
        $str = $this->input->post('captcha');
        $word = $this->session->userdata('captchaword');
        
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('message', 'Message', 'required');
        $this->form_validation->set_rules('captcha', 'CAPTCHA', 'trim|required|callback_captcha');

        $data['description'] = 'Contact us form';
        $data['keywords'] = '';
        $data['title'] = 'Contact us';
        
        if ($this->form_validation->run() == FALSE) {
            $vals = array('img_path' => './captcha/',
            'img_url' => $this->config->base_url().'/captcha/',
            'font_path' => './system/fonts/texb.ttf',
            'img_width' => '150',
            'img_height' => 50,
            'expiration' => 7200,
            'word_length' => 6,
            'font_size' => 16,
            'img_id' => 'Imageid',
            'pool' => '0123456789',
        );
        $cap = create_captcha($vals);
        $data['captcha'] = $cap['image'];
        $this->session->set_userdata('captchaword', $cap['word']);
        $this->load->view('header', $data);
            $this->load->view('contact/contactus');
        } else {
            $this->load->view('header', $data);
            if(not_spam($this->input->post('message'))){
            $this->contact_model->insert_contact();
            }
            $this->load->view('contact/contactussuccess');
            // remove session datas
            foreach ($_SESSION as $key => $value) {
                unset($_SESSION[$key]);
            }
        }
        
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

}
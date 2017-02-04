<?php

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->helper('file');
        if (!(isset($_SESSION['username']) && $_SESSION['logged_in'] === true)) {
            redirect('user/login', 'location');
        }
        if (!($_SESSION['is_admin'] === true)) {
            redirect('member/booklist', 'location');
        }
    }

    public function index() {
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'admin area';
        $data['booklist'] = $this->admin_model->get_books();
        $this->load->view('header', $data);
        $this->load->view('admin/main');
        $this->load->view('admin/booklist', $data);
        $this->load->view('footer');
    }

    public function backup() {
        $this->load->dbutil();
        $backup = $this->dbutil->backup();
        $this->load->helper('file');
        $this->load->helper('download');
        force_download('mybackup.gz', $backup);
    }

    public function restore() {
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'admin area';
        //$this->db->query(file_get_contents("MySqlScript.sql"));
        $this->load->view('header', $data);
        $this->load->view('admin/main');
        $this->load->view('footer');
    }

    public function verifybook() {
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'admin area';
        $data['booklist'] = $this->admin_model->get_verify();
        $this->load->view('header', $data);
        $this->load->view('admin/main');
        $this->load->view('admin/verifybook', $data);
        $this->load->view('footer');
    }

    public function verifying() {
        $id = $this->uri->segment(3, 0);
        $this->admin_model->update_verify($id);
        redirect('admin/bookdetails/' . $id, 'location');
    }

    public function deverifying() {
        $id = $this->uri->segment(3, 0);
        $this->admin_model->update_deverify($id);
        redirect('admin/bookdetails/' . $id, 'location');
    }

    public function booklist() {
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'admin area';
        $data['booklist'] = $this->admin_model->get_books($this->session->userdata('user_id'));
        $total_row = $this->admin_model->record_count($this->session->userdata('user_id'));
        $data['totalrows'] = $total_row;
        $this->load->view('header', $data);
        $this->load->view('admin/main');
        $this->load->view('admin/booklist', $data);
        $this->load->view('footer');
    }

    public function bookdetails($id) {
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'admin area';
        $this->load->helper('number');
        $this->load->library('form_validation');
        $data['row'] = $this->admin_model->show_books($id);
        $lang = $this->admin_model->show_books($id);
        $data['filerow'] = $this->admin_model->show_files($id);
        $this->load->model('member_model');
        $data['categorylist'] = $this->member_model->get_categories($lang['language']);
        $selectedcat = $this->member_model->get_book_categories($id);
        $checkedcat = array();
        foreach ($selectedcat as $value) {
            $checkedcat[] = $value['category_id'];
        }
        $data['selectedcategory'] = $checkedcat;
        $this->load->view('header', $data);
        $this->load->view('admin/main');
        $this->load->view('admin/bookdetails', $data);
        $this->load->view('footer');
    }

    public function editbook($id) {
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'admin area';
        $this->load->library('form_validation');
        $data['row'] = $this->admin_model->show_books($id);
        $this->load->view('header', $data);
        $this->load->view('admin/main');
        $this->load->view('admin/editbook', $data);
        $this->load->view('footer');
    }

    public function editingbook() {
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'admin area';
        $id = $this->input->post('id');
        $data['row'] = $this->admin_model->show_books($id);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');


        $this->form_validation->set_rules('title', 'Title', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('header', $data);
            $this->load->view('admin/editbook', $data);
            $this->load->view('footer');
        } else {
            $this->admin_model->update_book();
            //redirect('admin/test1/', 'location');
            redirect('admin/bookdetails/' . $id, 'location');
        }
    }

    public function changecover() {
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'admin area';
        $id = $this->input->post('id');
        $data['row'] = $this->admin_model->show_books($id);
        if (!empty($data['row'])) {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');

            $dir = './data/books/bk' . $id . '/';
            $config['upload_path'] = $dir;
            $config['file_name'] = 'cover';
            $config['allowed_types'] = 'jpg';
            $config['max_size'] = 900;
            $config['overwrite'] = TRUE;
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('cover')) {
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('header', $data);
                $this->load->view('admin/uploadfileerror', $error);
                $this->load->view('footer');
            } else {
                $data = array('upload_data' => $this->upload->data());
                //creat thumbnail of cover
                $this->load->helper('thumb_helper');
                $image1_path = $dir . 'cover.jpg';
                branding($image1_path);
                $image2_path = $dir . 'coverthumb.jpg';
                create_thumb($image1_path, $image2_path, $box = 160);
                redirect('admin/bookdetails/' . $id, 'location');
            }
        }
    }

    public function removebook($id) {
        $id = intval($id);
        if ($id > 0) {
            if ($this->db->query('delete from books where id=' . $id)) {
                $dir = './data/books/bk' . $id . '/';
                $dir2 = './data/trash/bk' . $id . '/';
                rename($dir, $dir2);
            }
        }
        redirect('admin/booklist/', 'location');
    }

    public function bookfileuploading() {
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'admin area';
        $id = $this->input->post('id');

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config['upload_path'] = './data/books/bk' . $id . '/';
        $config['file_name'] = 'f' . $id;
        $config['allowed_types'] = 'jpg|zip|pdf|doc|docx|epub|txt|odt';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('bookfile')) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('header', $data);
            $this->load->view('admin/uploadfileerror', $error);
            $this->load->view('footer');
        } else {
            $data = array('upload_data' => $this->upload->data());
            $filename = $this->upload->data('file_name');
            $this->admin_model->insert_book_file($id, $filename);
            redirect('admin/bookdetails/' . $id, 'location');
        }
    }

    public function removefile($book_id, $id) {
        $id = intval($id);
        if ($id > 0) {
            $this->db->query('delete from book_files where id=' . $id);
        }
        redirect('admin/bookdetails/' . $book_id, 'location');
    }

    public function userlist() {
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'admin area';
        $data['booklist'] = $this->admin_model->get_users();
        $this->load->view('header', $data);
        $this->load->view('admin/main');
        $this->load->view('admin/userlist', $data);
        $this->load->view('footer');
    }

    public function userdetails($id) {
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'admin area';
        $this->load->library('form_validation');
        $this->load->helper('date');
        $data['row'] = $this->admin_model->show_users($id);
        $this->load->view('header', $data);
        $this->load->view('admin/main');
        $this->load->view('admin/userdetails', $data);
        $this->load->view('footer');
    }

    public function useredit($id) {
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'admin area';
        $this->load->library('form_validation');
        $data['row'] = $this->admin_model->show_users($id);
        $this->load->view('header', $data);
        $this->load->view('admin/main');
        $this->load->view('admin/useredit', $data);
        $this->load->view('footer');
    }

    public function userediting() {
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'admin area';
        $id = $this->input->post('id');
        $data['row'] = $this->admin_model->show_users($id);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'User name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('header', $data);
            $this->load->view('admin/main');
            $this->load->view('admin/useredit', $data);
            $this->load->view('footer');
        } else {
            $this->admin_model->user_update();
            redirect('admin/userdetails/' . $id, 'location');
        }
    }

    public function useradd() {
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'admin area';
        $this->load->library('form_validation');
        $this->load->view('header', $data);
        $this->load->view('admin/main');
        $this->load->view('admin/useradd');
        $this->load->view('footer');
    }

    public function useradding() {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');


        $this->form_validation->set_rules('username', 'User name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');

        if ($this->form_validation->run() == FALSE) {
            $data['description'] = '';
            $data['keywords'] = '';
            $data['title'] = 'admin area';
            $this->load->view('header', $data);
            $this->load->view('admin/main');
            $this->load->view('admin/useradd');
            $this->load->view('footer');
        } else {
            $this->admin_model->insert_user();
            redirect('admin/userlist/', 'location');
        }
    }

    public function userremove($id) {
        $id = intval($id);
        if ($id > 0) {
            $this->db->query('delete from users where id=' . $id);
        }
        redirect('admin/userlist/', 'location');
    }

    public function categorylist() {
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'admin area';
        $data['booklist'] = $this->admin_model->get_categories();
        $this->load->view('header', $data);
        $this->load->view('admin/main');
        $this->load->view('admin/categorylist', $data);
        $this->load->view('footer');
    }

    public function categoryadd() {
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'admin area';
        $this->load->library('form_validation');
        $this->load->view('header', $data);
        $this->load->view('admin/main');
        $this->load->view('admin/categoryadd');
        $this->load->view('footer');
    }

    public function categoryadding() {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');


        $this->form_validation->set_rules('title', 'category name', 'required');
        $this->form_validation->set_rules('lang', 'Language', 'is_natural_no_zero');
        if ($this->form_validation->run() == FALSE) {
            $data['description'] = '';
            $data['keywords'] = '';
            $data['title'] = 'admin area';
            $this->load->view('header', $data);
            $this->load->view('admin/main');
            $this->load->view('admin/categoryadd');
            $this->load->view('footer');
        } else {
            $this->admin_model->insert_category();
            redirect('admin/categorylist/', 'location');
        }
    }

    public function categorydetails($id) {
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'admin area';
        $data['row'] = $this->admin_model->show_categories($id);
        $this->load->view('header', $data);
        $this->load->view('admin/main');
        $this->load->view('admin/categorydetails', $data);
        $this->load->view('footer');
    }

    public function categoryremove($id) {
        $id = intval($id);
        if ($id > 0) {
            $this->db->query('delete from categories where id=' . $id);
        }
        redirect('admin/categorylist/', 'location');
    }

    public function categoryedit($id) {
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'admin area';
        $this->load->library('form_validation');
        $data['row'] = $this->admin_model->show_categories($id);
        $this->load->view('header', $data);
        $this->load->view('admin/main');
        $this->load->view('admin/categoryedit', $data);
        $this->load->view('footer');
    }

    public function categoryediting() {
        $id = $this->input->post('id');
        $data['row'] = $this->admin_model->show_categories($id);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('title', 'category name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['description'] = '';
            $data['keywords'] = '';
            $data['title'] = 'admin area';
            $this->load->view('header', $data);
            $this->load->view('admin/main');
            $this->load->view('admin/categoryedit', $data);
            $this->load->view('footer');
        } else {
            $this->admin_model->category_update();
            redirect('admin/categorydetails/' . $id, 'location');
        }
    }

    public function categorylistadd() {
        $this->load->model('member_model');
        $id = $this->input->post('id');
        $this->member_model->insert_category();
        redirect('admin/bookdetails/' . $id, 'location');
    }
    
    public function test1() {
        $data['booklist'] = $this->admin_model->get_books2();
        $this->load->view('admin/booklisttest', $data);
    }

}

<?php

class Member extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('member_model');
        $this->load->helper('file');
        if (!(isset($_SESSION['username']) && $_SESSION['logged_in'] === true)) {
            redirect('user/login', 'location');
        }
    }

    public function index() {
        $data['booklist'] = $this->member_model->get_books($this->session->userdata('user_id'));
        $total_row = $this->member_model->record_count($this->session->userdata('user_id'));
        $data['totalrows'] = $total_row;
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'mamber area';
        $this->load->view('header', $data);
        $this->load->view('member/main');
        $this->load->view('member/booklist', $data);
        $this->load->view('footer');
    }

    public function addbook() {
        $this->load->library('form_validation');
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'mamber area';
        $this->load->view('header', $data);
        $this->load->view('member/main');
        $this->load->view('member/addbook');
        $this->load->view('footer');
    }

    public function addingbook() {
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'mamber area';
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('book_lang', 'Language', 'is_natural_no_zero');

        if ($this->form_validation->run() == FALSE || $this->input->post('book_lang') == 0) {
            $this->load->view('header', $data);
            $this->load->view('member/addbook');
            $this->load->view('footer');
        } else {
            $this->member_model->insert_book();
            $id = $this->db->insert_id();

            $dir = './data/books/bk' . $id . '/';
            mkdir($dir);

            $config['upload_path'] = './data/books/bk' . $id . '/';
            $config['file_name'] = 'cover';
            $config['allowed_types'] = 'jpg';
            $config['max_size'] = 900;
            $this->load->library('upload', $config);
            $this->upload->do_upload('cover');

            //creat thumbnail of cover
            $this->load->helper('thumb_helper');
            $image1_path = $dir . 'cover.jpg';
            $image2_path = $dir . 'coverthumb.jpg';
            create_thumb($image1_path, $image2_path, $box = 160);

            $data['row'] = $this->member_model->show_books($id);
            $data['filerow'] = $this->member_model->show_files($id);
            $lang = $data['row'];
            $data['categorylist'] = $this->member_model->get_categories($lang['language']);
            $selectedcat = $this->member_model->get_book_categories($id);
            $checkedcat = array();
            foreach ($selectedcat as $value) {
                $checkedcat[] = $value['category_id'];
            }
            $data['selectedcategory'] = $checkedcat;
            $this->load->view('header', $data);
            $this->load->view('member/main');
            $this->load->view('member/bookdetails', $data);
            $this->load->view('footer');
        }
    }

    public function booklist() {
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'mamber area';
        $data['booklist'] = $this->member_model->get_books($this->session->userdata('user_id'));
        $total_row = $this->member_model->record_count($this->session->userdata('user_id'));
        $data['totalrows'] = $total_row;
        $this->load->view('header', $data);
        $this->load->view('member/main');
        $this->load->view('member/booklist', $data);
        $this->load->view('footer');
    }

    public function bookdetails($id) {
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'mamber area';
        $this->load->helper('number');
        $this->load->library('form_validation');
        $data['row'] = $this->member_model->show_books($id);
        if (!empty($data['row'])) {
            $lang = $data['row'];
            $data['filerow'] = $this->member_model->show_files($id);
            $data['categorylist'] = $this->member_model->get_categories($lang['language']);
            $selectedcat = $this->member_model->get_book_categories($id);
            $checkedcat = array();
            foreach ($selectedcat as $value) {
                $checkedcat[] = $value['category_id'];
            }
            $data['selectedcategory'] = $checkedcat;
            $this->load->view('header', $data);
            $this->load->view('member/main');
            $this->load->view('member/bookdetails', $data);
            $this->load->view('footer');
        }
    }

    public function editbook($id) {
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'mamber area';
        $this->load->library('form_validation');
        $data['row'] = $this->member_model->show_books($id);
        if (!empty($data['row'])) {
            $this->load->view('header', $data);
            $this->load->view('member/main');
            $this->load->view('member/editbook', $data);
            $this->load->view('footer');
        }
 else {show_404();}
    }

    public function editingbook() {
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'mamber area';
        $id = intval($this->input->post('id'));
        if ($id > 0) {
            $data['row'] = $this->member_model->show_books($id);
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');

            $this->form_validation->set_rules('title', 'Title', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('header', $data);
                $this->load->view('member/editbook', $data);
                $this->load->view('footer');
            } else {
                $this->member_model->update_book();
                redirect('member/bookdetails/' . $id, 'location');
            }
        }
    }

    public function changecover() {
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'mamber area';
        $id = $this->input->post('id');
        $data['row'] = $this->member_model->show_books($id);
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
                $this->load->view('member/uploadfileerror', $error);
                $this->load->view('footer');
            } else {
                $data = array('upload_data' => $this->upload->data());
                //creat thumbnail of cover
                $this->load->helper('thumb_helper');
                $image1_path = $dir . 'cover.jpg';
                branding($image1_path);
                $image2_path = $dir . 'coverthumb.jpg';
                create_thumb($image1_path, $image2_path, $box = 160);
                redirect('member/bookdetails/' . $id, 'location');
            }
        }
    }

    public function removebook($id) {
        $id = intval($id);
        if ($id > 0) {
            if ($this->db->query('delete from books where id=' . $id . ' and user_id=' . $this->session->userdata('user_id')))
            {
                $dir = './data/books/bk' . $id . '/';
                $dir2 = './data/trash/bk' . $id . '/';
                rename($dir, $dir2); 
            }
        }
        redirect('member/booklist/', 'location');
    }

    public function bookfileuploading() {
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'mamber area';
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
            $this->load->view('member/uploadfileerror', $error);
            $this->load->view('footer');
        } else {
            $data = array('upload_data' => $this->upload->data());
            $filename = $this->upload->data('file_name');
            $this->member_model->insert_book_file($id, $filename);
            redirect('member/bookdetails/' . $id, 'location');
        }
    }

    public function removefile($book_id, $id) {
        $data['row'] = $this->member_model->show_books($book_id);
        if (!empty($data['row'])) {
            if ($id > 0) {
                $this->db->query('delete from book_files where id=' . $id . ' and book_id=' . $book_id);
            }
            redirect('member/bookdetails/' . $book_id, 'location');
        }
    }

    public function profile() {
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'mamber area';
        $this->load->library('form_validation');

        $data['row'] = $this->member_model->show_profile($this->session->userdata('user_id'));
        $this->load->view('header', $data);
        $this->load->view('member/main');
        $this->load->view('member/profile', $data);
        $this->load->view('footer');
    }

    public function profileupdate() {
        $this->load->library('form_validation');
        $id = $this->input->post('id');
        $data['row'] = $this->member_model->show_profile($this->session->userdata('user_id'));
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $data['description'] = '';
            $data['keywords'] = '';
            $data['title'] = 'mamber area';
            $this->load->view('header', $data);
            $this->load->view('member/main');
            $this->load->view('member/profile', $data);
            $this->load->view('footer');
        } else {
            $this->member_model->update_profile();
            redirect('member/', 'location');
        }
    }

    public function booklibrary() {
        $data['booklist'] = $this->member_model->get_library($this->session->userdata('user_id'));
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'mamber area';
        $this->load->view('header', $data);
        $this->load->view('member/main');
        $this->load->view('member/librarylist', $data);
        $this->load->view('footer');
    }

    public function addlibrary() {
        $this->load->library('form_validation');
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'mamber area';
        $this->load->view('header', $data);
        $this->load->view('member/main');
        $this->load->view('member/addlibrary');
        $this->load->view('footer');
    }

    public function addinglibrary() {
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'mamber area';
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('title', 'Title', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('header', $data);
            $this->load->view('member/addlibrary');
            $this->load->view('footer');
        } else {
            $this->member_model->insert_library();
            $data['booklist'] = $this->member_model->get_library($this->session->userdata('user_id'));
            $this->load->view('header', $data);
            $this->load->view('member/main');
            $this->load->view('member/librarylist', $data);
            $this->load->view('footer');
        }
    }

    public function librarydetails($id) {
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'mamber area';
        $this->load->helper('number');
        $this->load->library('form_validation');
        $bookids = $this->member_model->library_book_ids($id);
        if (!empty($bookids)) {
            $ids = explode(' ', $bookids['book_ids']);
            $data['booklist'] = $this->member_model->show_library_books($ids);
            $data['id'] = $id;
            $this->load->view('header', $data);
            $this->load->view('member/main');
            $this->load->view('member/librarydetails', $data);
            $this->load->view('footer');
        }
    }

    public function categoryadd() {
        $id = $this->input->post('id');
        $this->member_model->insert_category();
        redirect('member/bookdetails/' . $id, 'location');
    }

}

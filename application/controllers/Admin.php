<?php

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('admin_model','book_model', 'user_model', 'author_model', 'tag_model'));
        $this->load->helper(array('str_helper', 'file', 'thumb_helper', 'number'));
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
    
    public function importbooks() {
        $dir = 'data/import';
        $dirlist = scan_Dir($dir);
        foreach ($dirlist as $value) {
            if (pathinfo($value, PATHINFO_EXTENSION) == 'opf') {
                echo '-------------------------------------<br>';
                $path_parts = pathinfo($value);
                $path = $path_parts['dirname'];
                $file = $path_parts['basename'];
                $filename = $path_parts['filename'];
                
                //define variables
                $description = '';
                $keywords = '';
                $lang = 0;
                
                $feed = file_get_contents('../' . $value) or die("Error: Cannot create object");
                $sxe = new SimpleXMLElement($feed);
                $sxe->registerXPathNamespace('c', 'http://purl.org/dc/elements/1.1/');
                $titles = $sxe->xpath('//c:title');
                $authors = $sxe->xpath('//c:creator');
                $des = $sxe->xpath('//c:description');
                $tags = $sxe->xpath('//c:subject');
                $language = $sxe->xpath('//c:language');

                foreach ($titles as $val) {
                    $title = $val;
                }
                
                $keywords = $title;
                
                foreach ($authors as $val) {
                    $author = $val;
                    $keywords = $keywords.' '.$val;
                }
                $authors = explode(',', $author);
                
                foreach ($tags as $val) {
                    $keywords = $keywords.' '.$val;
                }

                foreach ($des as $val) {
                    $description = $val;
                }

                foreach ($language as $val) {
                    if ($val == 'fas') {
                        $lang = 3;
                    }
                    if ($val == 'aze') {
                        $lang = 2;
                    }
                    if ($val == 'azb') {
                        $lang = 1;
                    }
                }
                $keywords = str_replace(',', ' ', $keywords);
                $keywords = str_replace('  ', ' ', $keywords);
                $keywords = str_replace(' ', ', ', $keywords);
                $this->book_model->insert_book2($lang, $title, $description, $keywords);
                $id = $this->db->insert_id();
                $dir = '../data/books/bk' . $id . '/';
                mkdir($dir);
                $f = '../' . $value;
                $cover = str_replace('.opf', '.jpg', $f);
                $pdf = str_replace('.opf', '.pdf', $f);
                $epub = str_replace('.opf', '.epub', $f);
                if (file_exists($cover)) {
                    //creat thumbnail of cover
                    $image1_path = $dir . 'cover.jpg';
                    copy($cover, $image1_path);
                    branding($image1_path);
                    $image2_path = $dir . 'coverthumb.jpg';
                    create_thumb($image1_path, $image2_path, $box = 160);
                }

                if (file_exists($pdf)) {
                    $pdffile = 'f' . $id . '.pdf';
                    copy($pdf, $dir . $pdffile);
                    $this->book_model->insert_book_file($id, $pdffile, 'pdf');
                }
                
                if (file_exists($epub)) {
                    $epubfile = 'f' . $id . '.epub';
                    copy($epub, $dir . $epubfile);
                    $this->book_model->insert_book_file($id, $epubfile, 'epub');
                }

                //search & insert book authors
                $this->insertauthors2($id, $authors);
                //search & insert book tags
                $this->inserttags2($id, $tags);
                
            }
        }
    }

    public function backup() {
        $this->load->dbutil();
        $backup = $this->dbutil->backup();
        $this->load->helper('file');
        $this->load->helper('download');
        force_download('mybackup.gz', $backup);
    }

    public function restore() {
        $this->load->library('form_validation');
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'admin area';
        $dir = './data/';
        $config['upload_path'] = $dir;
        $config['file_name'] = 'backup';
        $config['allowed_types'] = 'sql';
        $config['overwrite'] = TRUE;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('uploadfile')) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('header', $data);
            $this->load->view('admin/main');
            $this->load->view('admin/uploadfileerror', $error);
            $this->load->view('admin/restore');
            $this->load->view('footer');
        } else {
            $data = array('upload_data' => $this->upload->data());

            if (file_exists('./data/backup.sql')) {
                $sql = file_get_contents("./data/backup.sql");
                $sqls = explode(';', $sql);
                array_pop($sqls);
                $this->db->query("SET foreign_key_checks = 0;");
                foreach ($sqls as $statement) {
                    $statment = $statement . ";";
                    $this->db->query($statement);
                }
            }
            redirect('admin', 'location');
        }
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
        $data['row'] = $this->admin_model->show_book($id);
        $lang = $this->admin_model->show_book($id);
        $data['filerow'] = $this->admin_model->show_files($id);

        $this->load->view('header', $data);
        $this->load->view('admin/main');
        $this->load->view('admin/bookdetails', $data);
        $this->load->view('footer');
    }

    public function editbook() {
        if ($this->uri->segment(3, 0) == '') {
            $id = intval($this->input->post('id'));
        } else {
            $id = $this->uri->segment(3, 0);
        }
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'admin area';
        $data['row'] = $this->admin_model->show_book($id);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('title', 'Title', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('header', $data);
            $this->load->view('admin/main');
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
        $data['row'] = $this->admin_model->show_book($id);
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

    public function useredit() {
        if ($this->uri->segment(3, 0) == '') {
            $id = intval($this->input->post('id'));
        } else {
            $id = $this->uri->segment(3, 0);
        }
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'admin area';
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

    public function contacts() {
        $this->load->helper('date');
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'admin area';
        $data['booklist'] = $this->admin_model->get_contacts();
        $this->load->view('header', $data);
        $this->load->view('admin/main');
        $this->load->view('admin/contacts', $data);
        $this->load->view('footer');
    }

    public function contactremove($id) {
        $id = intval($id);
        if ($id > 0) {
            $this->db->query('delete from contact where id=' . $id);
        }
        redirect('admin/contacts/', 'location');
    }
    
    //----------------------------------------------------------------------
    private function inserttags2($id, $tags) {
        $this->db->query('delete from book_tag where book_id=' . $id);
        foreach ($tags as $tag) {
            $tag = ucfirst(trim($tag));
            if ($tag != '') {
                $tag_id = $this->tag_model->search_tag($tag);
                if ($tag_id == 0) {
                    $tag_id = $this->tag_model->insert_tag($tag);
                }
                $this->book_model->insert_book_tag($id, $tag_id);
            }
        }
    }

    private function insertauthors2($id, $authors) {
        $this->db->query('delete from book_author where book_id=' . $id);
        foreach ($authors as $author) {
            $author = ucfirst(trim($author));
            if ($author != '') {
                $author_id = $this->author_model->search_author($author);
                if ($author_id == 0) {
                    $author_id = $this->author_model->insert_author($author);
                }
                $this->book_model->insert_book_author($id, $author_id);
            }
        }
    }

}

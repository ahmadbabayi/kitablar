<?php

class Member extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('book_model', 'user_model', 'author_model', 'tag_model'));
        $this->load->helper(array('form', 'url', 'str_helper', 'file', 'thumb_helper', 'number'));
        $this->load->library('form_validation');
        if (!(isset($_SESSION['username']) && $_SESSION['logged_in'] === true)) {
            redirect('user/login', 'location');
        }
    }

    public function index() {
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'mamber area';
        $this->load->view('header', $data);
        $this->load->view('member/main');
        $this->load->view('footer');
    }

    public function addbook() {
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'mamber area';
        $this->load->library('form_validation');

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('book_lang', 'Language', 'is_natural_no_zero');

        if ($this->form_validation->run() == FALSE || $this->input->post('book_lang') == 0) {
            $this->load->view('header', $data);
            $this->load->view('member/addbook');
            $this->load->view('footer');
        } else {
            $this->book_model->insert_book();
            $id = $this->db->insert_id();

            //search & insert book authors
            $this->insertauthors($id);
            //search & insert book tags
            $this->inserttags($id);
            $this->cleanauthors();
            $this->cleantags();

            $dir = './data/books/bk' . $id . '/';
            mkdir($dir);

            $config['upload_path'] = './data/books/bk' . $id . '/';
            $config['file_name'] = 'cover';
            $config['allowed_types'] = 'jpg';
            $config['max_size'] = 900;
            $this->load->library('upload', $config);
            $this->upload->do_upload('cover');

            //creat thumbnail of cover
            $image1_path = $dir . 'cover.jpg';
            branding($image1_path);
            $image2_path = $dir . 'coverthumb.jpg';
            create_thumb($image1_path, $image2_path, $box = 160);

            $data['row'] = $this->book_model->get_user_book($id);
            $data['filerow'] = $this->book_model->show_files($id);

            $this->load->view('header', $data);
            $this->load->view('member/main');
            $this->load->view('member/bookdetails', $data);
            $this->load->view('footer');
        }
    }

    public function editbook() {
        if ($this->uri->segment(3, 0) == '') {
            $id = intval($this->input->post('id'));
        } else {
            $id = $this->uri->segment(3, 0);
        }
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'mamber area';
        if ($id > 0) {
            $data['row'] = $this->book_model->get_user_book($id);
            $data['authors'] = $this->book_model->get_book_authors($id);
            $data['tags'] = $this->book_model->get_book_tags($id);
            if (!empty($data['row'])) {


                $this->form_validation->set_rules('title', 'Title', 'required');

                if ($this->form_validation->run() == FALSE) {
                    $this->load->view('header', $data);
                    $this->load->view('member/editbook', $data);
                    $this->load->view('footer');
                } else {
                    $this->book_model->update_book();

                    //search & insert book authors
                    $this->insertauthors($id);
                    //search & insert book tags
                    $this->inserttags($id);
                    $this->cleanauthors();
                    $this->cleantags();

                    redirect('book/details/' . $id . '/' . $id, 'location');
                }
            } else {
                show_404();
            }
        }
    }

    public function booklist() {
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'mamber area';
        $data['booklist'] = $this->book_model->get_user_books($this->session->userdata('user_id'));
        $total_row = $this->book_model->user_book_record_count($this->session->userdata('user_id'));
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
        $this->load->library('form_validation');
        $data['row'] = $this->book_model->get_user_book($id);
        if (!empty($data['row'])) {
            $lang = $data['row'];
            $data['authors'] = $this->book_model->get_book_authors($id);
            $data['filerow'] = $this->book_model->show_files($id);
            $this->load->view('header', $data);
            $this->load->view('member/bookdetails', $data);
            $this->load->view('footer');
        } else {
            show_404();
        }
    }

    public function changecover() {
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'mamber area';
        $id = $this->input->post('id');
        $data['row'] = $this->book_model->get_user_book($id);
        if (!empty($data['row'])) {

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
            $data['row'] = $this->book_model->get_user_book($id);
            if (!empty($data['row'])) {
                if ($this->db->query('delete from books where id=' . $id)) {
                    $dir = './data/books/bk' . $id . '/';
                    $dir2 = './data/trash/bk' . $id . '/';
                    rename($dir, $dir2);
                    $this->cleanauthors();
                    $this->cleantags();
                }
            } else {
                show_404();
            }
        }
        redirect('member/booklist/', 'location');
    }

    public function bookfileuploading() {
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'mamber area';
        $id = $this->input->post('id');

        $config['upload_path'] = './data/books/bk' . $id . '/';
        $config['file_name'] = 'f' . $id;
        $config['max_size'] = 10000;
        $config['allowed_types'] = 'jpg|zip|pdf|doc|docx|epub|txt|odt';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('bookfile')) {
            $error = array('error' => $this->upload->display_errors());
            $data['error'] = $error;
            $this->load->view('header', $data);
            $this->load->view('member/uploadfileerror', $error);
            $this->load->view('footer');
        } else {
            $filename = $this->upload->data('file_name');
            $this->book_model->insert_book_file($id, $filename, $this->upload->data('file_ext'));
            redirect('member/bookdetails/' . $id, 'location');
        }
    }

    public function removefile($book_id, $id) {
        $data['row'] = $this->book_model->get_user_book($book_id);
        $item = $this->book_model->show_file($id);
        if (!empty($data['row'])) {
            if ($id > 0) {
                $this->db->query('delete from book_files where id=' . $id . ' and book_id=' . $book_id);
                $filename = './data/books/bk' . $item['book_id'] . '/' . $item['file_name'];
                unlink($filename);
            }
            redirect('member/bookdetails/' . $book_id, 'location');
        }
    }

    public function profile() {
        $this->load->library('form_validation');
        $id = $this->input->post('id');
        $data['row'] = $this->user_model->show_profile($this->session->userdata('user_id'));
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
            $this->user_model->update_profile();
            redirect('member/', 'location');
        }
    }

    //--------------------------------------------------------------------------------------
    //private functions
    private function cleanauthors() {
        $list = $this->author_model->show_authors();
        foreach ($list as $value) {
            $author_id = $this->author_model->search_author_by_id($value['id']);
            if ($author_id == 0) {
                $this->db->query('delete from authors where id=' . $value['id']);
            }
        }
    }

    private function cleantags() {
        $list = $this->tag_model->show_tags();
        foreach ($list as $value) {
            $tag_id = $this->tag_model->search_tag_by_id($value['id']);
            if ($tag_id == 0) {
                $this->db->query('delete from tags where id=' . $value['id']);
            }
        }
    }

    private function inserttags($id) {
        $tags = $this->input->post('tags');
        $tags = explode(',', $tags);
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

    private function insertauthors($id) {
        $authors = $this->input->post('authors');
        $authors = explode(',', $authors);
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

    public function send2telegram() {
        if ($this->uri->segment(3, 0) == '') {
            $id = intval($this->input->post('id'));
        } else {
            $id = $this->uri->segment(3, 0);
        }
        if ($id > 0) {
            $row = $this->book_model->show_book($id);
            $message = $row['title'] . "\n";
            $authors = $this->book_model->get_book_authors($id);
            foreach ($authors as $author) {
                $message .= $author['author'] . "\n";
            }
            $message .= $row['description'] . "\n";
            $message .= "@kitablar";
            if (!empty($row)) {
                $link = 'data/books/bk' . $row['id'] . '/cover.jpg';
                if (file_exists($link)) {
                    $link = 'https://kitablar.com/data/books/bk' . $row['id'] . '/cover.jpg';

                    $apiToken = "2066963836:AAFwELD388SZu2EfhyHad7nXwRzsaTkooqQ";

                    $filerow = $this->book_model->show_files($id);
                    
                    foreach ($filerow as $item) {
                        $ext = pathinfo($item['file_name'], PATHINFO_EXTENSION);
                        $ext = strtoupper($ext);
                        $filename = 'data/books/bk' . $row['id'] . '/' . $item['file_name'];
                        if (file_exists($filename)) {
                            if ($ext == 'PDF') {
                                $data = ['chat_id' => '@kitablar', 'photo' => $link];
                                $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendPhoto?" . http_build_query($data));

                                $document = 'https://kitablar.com/' . $filename;
                                $data = ['chat_id' => '@kitablar', 'document' => $document];
                                $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendDocument?" . http_build_query($data));

                                $data = ['chat_id' => '@kitablar', 'text' => $message];
                                $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data));
                            }
                        }
                    }
                }
            }
            $data['id'] = $id + 1;
            $this->load->view('telegram', $data);
        }
    }

}

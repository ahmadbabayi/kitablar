<?php

class Opds extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('book_model', 'author_model', 'tag_model'));
        $this->load->helper('str_helper');
    }

    public function index() {
        $data['ddd'] = '123';
        $string = $this->load->view('opds/root', $data, TRUE);
        $this->output->set_content_type('application/xml')->set_output($string);
    }

    public function author() {
        $this->lang->load('dil', 'english');
        if ($this->uri->segment(3, 0) == '') {
            $data['list'] = $this->author_model->show_authors();
            $string = $this->load->view('opds/authors', $data, TRUE);
            $this->output->set_content_type('application/xml')->set_output($string);
        } else {
            $id = $this->uri->segment(3, 0);
            $data['id'] = $id;

            //author book list
            $ids = $this->book_model->get_book_authors_ids($id);
            if (!empty($ids)) {
                foreach ($ids as $value) {
                    $bookids[] = $value['book_id'];
                }
                $data['list'] = $this->book_model->show_category_books($bookids);
            }
            if (!empty($data['list'])) {

                $string = $this->load->view('opds/author', $data, TRUE);
                $this->output->set_content_type('application/xml')->set_output($string);
                $ids = $this->book_model->get_book_authors_ids($id);
            } else {
                show_404();
            }
        }
    }

}

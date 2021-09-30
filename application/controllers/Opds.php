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
            } else {
                show_404();
            }
        }
    }

    public function language() {
        $this->lang->load('dil', 'english');
        if ($this->uri->segment(3, 0) == '') {
            $data['list'] = 1;
            $string = $this->load->view('opds/languages', $data, TRUE);
            $this->output->set_content_type('application/xml')->set_output($string);
        } else {
            $id = $this->uri->segment(3, 0);
            $data['id'] = $id;
            $data['list'] = $this->book_model->show_language_books($id);
            if (!empty($data['list'])) {

                $string = $this->load->view('opds/language', $data, TRUE);
                $this->output->set_content_type('application/xml')->set_output($string);
            } else {
                show_404();
            }
        }
    }

    public function format() {
        $this->lang->load('dil', 'english');
        if ($this->uri->segment(3, 0) == '') {
            $data['list'] = $this->book_model->show_formats();
            $string = $this->load->view('opds/formats', $data, TRUE);
            $this->output->set_content_type('application/xml')->set_output($string);
        } else {
            $id = $this->uri->segment(3, 0);
            $data['id'] = $id;

            $data['list'] = $this->book_model->show_format_books($id);

            if (!empty($data['list'])) {

                $string = $this->load->view('opds/format', $data, TRUE);
                $this->output->set_content_type('application/xml')->set_output($string);
            } else {
                show_404();
            }
        }
    }

    public function tag() {
        $this->lang->load('dil', 'english');
        if ($this->uri->segment(3, 0) == '') {
            $data['list'] = $this->tag_model->show_tags();
            $string = $this->load->view('opds/tags', $data, TRUE);
            $this->output->set_content_type('application/xml')->set_output($string);
        } else {
            $id = $this->uri->segment(3, 0);
            $data['tag'] = $this->uri->segment(4, 0);
            $data['id'] = $id;

            $ids = $this->book_model->get_book_tags_ids($id);
            if (!empty($ids)) {
                foreach ($ids as $value) {
                    $bookids[] = $value['book_id'];
                }
                $data['list'] = $this->book_model->show_category_books($bookids);
            }

            if (!empty($data['list'])) {

                $string = $this->load->view('opds/tag', $data, TRUE);
                $this->output->set_content_type('application/xml')->set_output($string);
            } else {
                show_404();
            }
        }
    }

    public function book() {
        if ($this->uri->segment(3, 0) == '') {
            $data['list'] = $this->book_model->show_books();
            $string = $this->load->view('opds/books', $data, TRUE);
            $this->output->set_content_type('application/xml')->set_output($string);
        } else {
            $id = $this->uri->segment(3, 0);
            $this->load->model('tag_model');
            $this->load->helper(array('file', 'str_helper', 'download', 'number', 'date'));
            $this->lang->load('dil', 'english');
            $data['authors'] = $this->book_model->get_book_authors($id);
            $data['tags'] = $this->book_model->get_book_tags($id);
            $metadata = $this->book_model->show_book($id);
            if (!empty($metadata)) {
                $data['value'] = $metadata;
                $data['filerow'] = $this->book_model->show_files($id);
                $this->book_model->update_hit($id, $metadata['hits']);

                $string = $this->load->view('opds/book', $data, TRUE);
                $this->output->set_content_type('application/xml')->set_output($string);
            } else {
                show_404();
            }
        }
    }

    public function search() {
      
        
        if ($this->uri->segment(3, 0) == '') {
            $data['list'] = 1;
            $string = $this->load->view('opds/search', $data, TRUE);
            $this->output->set_content_type('application/xml')->set_output($string);
        } else {
            $id = $this->uri->segment(3, 0);
            $data['id'] = $id;
            $data['list'] = $this->book_model->search_opds($id);
            if (!empty($data['list'])) {

                $string = $this->load->view('opds/searchlist', $data, TRUE);
                $this->output->set_content_type('application/xml')->set_output($string);
            } else {
                show_404();
            }
        }
    }

}

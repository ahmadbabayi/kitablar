<?php

class Search extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('book_model');
        $this->load->library('form_validation');
        $this->load->helper('str_helper');
    }

    public function index() {
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'search page';

        $this->load->view('header', $data);
        if ($this->book_model->search_records()) {
            $data['booklist'] = $this->book_model->search_records();
            $this->load->view('search/booklist', $data);
        } else {
            $this->load->view('search/searchform');
        }

        $this->load->view('footer');
    }
}

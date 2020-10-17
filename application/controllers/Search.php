<?php

class Search extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('search_model');
        $this->load->library('form_validation');

    }

    public function index() {
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'search page';

        $this->load->view('header', $data);
        if ($this->search_model->search_records()) {
            $data['booklist'] = $this->search_model->search_records();
            $this->load->view('search/booklist', $data);
        } else {
            $this->load->view('search/searchform');
        }

        $this->load->view('footer');
    }
}

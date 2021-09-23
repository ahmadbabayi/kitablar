<?php

class Author extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('author_model');
        $this->load->helper('str_helper');
    }

    public function index() {
        $start = $this->uri->segment(3, 0);
        $limit = $this->config->item('per_page');
        $data['authorlist'] = $this->author_model->show_authors();
        $total_row = $this->author_model->record_count();
        $data['totalrows'] = $total_row;
        $data['description'] = 'Authgors list';
        $data['keywords'] = 'authors, kitablar,Azərbaycan dili, آذربایجان دیلی, tarix, ədəbiyyat, roman, dərslik';
        $data['title'] = 'Author list';
        $this->load->view('header', $data);
        $this->load->view('author/authorlist', $data);
        $this->load->view('footer');
    }
}
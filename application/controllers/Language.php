<?php

class Language extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('author_model');
    }

    public function index() {
        $start = $this->uri->segment(3, 0);
        $limit = $this->config->item('per_page');
        $data['authorlist'] = $this->author_model->show_authors();
        $total_row = $this->author_model->record_count();
        $data['totalrows'] = $total_row;
        $data['description'] = 'E-book list in some languages';
        $data['keywords'] = 'آذربایجانجا  Azərbaycanca فارسی Türkçe English other';
        $data['title'] = 'Author list';
        $this->load->view('header', $data);
        $this->load->view('language/languages');
        $this->load->view('footer');
    }
}
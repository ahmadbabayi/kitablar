<?php

class Format extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('book_model');
    }

    public function index() {
        $data['authorlist'] = $this->book_model->show_formats();
        $data['description'] = 'E-book list in some languages';
        $data['keywords'] = 'آذربایجانجا  Azərbaycanca فارسی Türkçe English other';
        $data['title'] = 'Author list';
        $this->load->view('header', $data);
        $this->load->view('format/format');
        $this->load->view('footer');
    }
    
    public function extension() {
        $start = $this->uri->segment(3, 0);
        $data['authorlist'] = $this->book_model->show_formats();
        $data['description'] = 'E-book list in some languages';
        $data['keywords'] = 'آذربایجانجا  Azərbaycanca فارسی Türkçe English other';
        $data['title'] = 'Author list';
        $this->load->view('header', $data);
        $this->load->view('format/format');
        $this->load->view('footer');
    }
}
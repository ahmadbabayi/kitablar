<?php

class tag extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('tag_model');
    }

    public function index() {
        $start = $this->uri->segment(3, 0);
        $limit = $this->config->item('per_page');
        $data['taglist'] = $this->tag_model->show_tags();
        $total_row = $this->tag_model->record_count();
        $data['totalrows'] = $total_row;
        $data['description'] = 'E-book list in some languages';
        $data['keywords'] = 'آذربایجانجا  Azərbaycanca فارسی Türkçe English other';
        $data['title'] = 'Tag list';
        $this->load->view('header', $data);
        $this->load->view('tag/taglist', $data);
        $this->load->view('footer');
    }
}
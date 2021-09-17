<?php

class Format extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('book_model');
        $this->load->library('pagination');

        //pagination
        $config['base_url'] = site_url() . '/book/page/';
        $total_row = $this->book_model->record_count();
        $config['total_rows'] = $total_row;
        $config['per_page'] = $this->config->item('per_page');
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        $config['attributes'] = array('class' => 'w3-container w3-button');
        $this->pagination->initialize($config);
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

    public function ext() {
        $format = $this->uri->segment(3, 0);

        $total_row = $this->book_model->record_format_count($format);
        $config['total_rows'] = $total_row;
        $config['base_url'] = site_url() . '/format/ext/' . $format;
        $this->pagination->initialize($config);
        $start = $this->uri->segment(4, 0);
        $limit = $this->config->item('per_page');
        $data['booklist'] = $this->book_model->fetch_format_records($limit, $start, $format);
        $data['pagination'] = $this->pagination->create_links();
        $data['totalrows'] = $total_row;
        $pages = round($total_row / $this->config->item('per_page'));
        if ($total_row / $this->config->item('per_page') > $pages) {
            $pages = $pages + 1;
        }
        $data['pages'] = $pages;

        $data['description'] = 'E-book list in some languages';
        $data['keywords'] = 'آذربایجانجا  Azərbaycanca فارسی Türkçe English other';
        $data['title'] = 'Author list';
        $this->load->view('header', $data);
        $this->load->view('book/booklist', $data);
        $this->load->view('footer');
    }

}

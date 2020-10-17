<?php

class Rss extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('main_model');
        $this->load->helper('date');
        $this->load->helper('file');
    }

    public function index() {
        $data['booklist'] = $this->main_model->get_last_entries();
        $string = $this->load->view('rss/rss', $data, TRUE);
        $this->output
        ->set_content_type('application/rss+xml')
        ->set_output($string);
    }

}

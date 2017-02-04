<?php

class Rss extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('main_model');
        $this->load->helper('date');
    }

    public function index() {
        $data['booklist'] = $this->main_model->get_last_entries();
        header("Content-Type: application/rss+xml; charset=UTF-8");
        $this->load->view('rss/rss', $data);
    }
    
}

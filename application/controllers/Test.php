<?php

class Test extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('main_model');
    }

    public function index() {
        $this->load->view('template2');
    }
}

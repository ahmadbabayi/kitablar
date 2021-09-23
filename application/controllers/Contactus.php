<?php

class Contactus extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Your own constructor code
        $this->load->library('form_validation');
        $this->load->model('contact_model');
    }

    public function index() {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('message', 'Message', 'required');

        $data['description'] = 'Contact us form';
        $data['keywords'] = '';
        $data['title'] = 'Contact us';
        $this->load->view('header', $data);
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('contact/contactus');
        } else {
            $this->contact_model->insert_contact();
            $this->load->view('contact/contactussuccess');
        }
        
        $this->load->view('footer');
    }

}

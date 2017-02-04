<?php

class Contactus extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Your own constructor code
        $this->load->library('form_validation');
        $this->load->model('contact_model');
    }

    public function index() {
        $data['description'] = 'Contact us form';
        $data['keywords'] = '';
        $data['title'] = 'Contact us';
        
        $this->load->view('header', $data);
        $this->load->view('contact/contactus');
        $this->load->view('footer');
    }

    public function submitebook() {
        $data['description'] = 'Submit ebook form';
        $data['keywords'] = '';
        $data['title'] = 'Submit ebook';
        
        $this->load->view('header', $data);
        $this->load->view('contact/submitbook');
        $this->load->view('footer');
    }

    public function contactingus() {
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('subject', 'subject', 'required');
        $this->form_validation->set_rules('message', 'Message', 'required');
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email');

        $this->load->view('header');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('contact/contactus');
        } else {
            $this->contact_model->insert_contact();
            $this->load->view('contact/contactussuccess');
        }
        
        $this->load->view('footer');
    }
    
    public function submitingbook() {
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('link', 'Download link', 'required');
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email');

        $this->load->view('header');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('contact/submitbook');
        } else {
            $this->contact_model->insert_submitbook();
            $this->load->view('contact/contactussuccess');
        }
        
        $this->load->view('footer');
    }

}

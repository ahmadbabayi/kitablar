<?php

class Contact_model extends CI_Model {

    public function __construct() {
        
    }

    public function insert_contact() {
        $this->username = $this->input->post('name');
        $this->subject = $this->input->post('subject');
        $this->email = $this->input->post('email');
        $this->contacttext = $this->input->post('message');

        $this->ip = $this->input->ip_address();
        $this->date = time();

        $this->db->insert('contact', $this);
    }
    
    public function insert_submitbook() {
        $this->username = $this->input->post('name');
        $this->subject = $this->input->post('title');
        $this->email = $this->input->post('email');
        
        $description = $this->input->post('link');
        $description .= ' ..... ';
        $description .= $this->input->post('description');
        
        $this->contacttext = $description;

        $this->ip = $this->input->ip_address();
        $this->date = time();

        $this->db->insert('contact', $this);
    }

}

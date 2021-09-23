<?php

class Contact_model extends CI_Model {

    public function __construct() {
        
    }

    public function insert_contact() {
        $this->username = $this->input->post('name');
        $this->phone = $this->input->post('phone');
        $this->email = $this->input->post('email');
        $this->message = $this->input->post('message');

        $this->ip = $this->input->ip_address();
        $this->date = time();

        $this->db->insert('contact', $this);
    }
}

<?php

class Main_model extends CI_Model {

    public function __construct() {
        
    }

    public function get_last_five_entries() {
        $this->db->where('active',1);
        $this->db->order_by('id','DESC');
        $query = $this->db->get('books', 6);
        return $query->result_array();
    }
    
    public function get_last_entries() {
        $this->db->where('active',1);
        $this->db->order_by('id','DESC');
        $query = $this->db->get('books', 51);
        return $query->result_array();
    }

}

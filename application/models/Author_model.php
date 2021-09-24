<?php

class Author_model extends CI_Model {

    public function __construct() {
        
    }

    public function record_count() {
        return $this->db->count_all_results('authors');
    }

    public function show_authors() {
        $this->db->order_by('author');
        $query = $this->db->get('authors');
        return $query->result_array();
    }
}

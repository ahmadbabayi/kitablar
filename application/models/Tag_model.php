<?php

class Tag_model extends CI_Model {

    public function __construct() {
        
    }

    public function record_count() {
        return $this->db->count_all_results('tags');
    }

    public function show_tags() {
        $this->db->order_by('tag');
        $query = $this->db->get('tags');
        return $query->result_array();
    }

}

<?php

class Search_model extends CI_Model {

    public function __construct() {
        
    }

    public function search_records() {
        $search = $this->input->post('search');
        if (strlen($search) > 2) {
            $this->db->select('*');
            $this->db->from('books');
            $this->db->like('title', $search);
            $this->db->or_like('author', $search);
            $this->db->or_like('translator', $search);
            $this->db->or_like('description', $search);
            $this->db->or_like('keywords', $search);
            $this->db->where('active', 1);
            $this->db->order_by('id', 'DESC');
            $query = $this->db->get();
            return $query->result_array();
        }
    }

}

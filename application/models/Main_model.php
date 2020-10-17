<?php

class Main_model extends CI_Model {

    public function __construct() {
        
    }

    public function get_last_five_entries() {
        $this->db->where('active', 1);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('books', 6);
        return $query->result_array();
    }
    
    public function get_last_five_entries_top() {
        $this->db->where('active', 1);
        $this->db->order_by('hits', 'DESC');
        $query = $this->db->get('books', 6);
        return $query->result_array();
    }

    public function get_last_entries() {
        $this->db->where('active', 1);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('books', 50);
        return $query->result_array();
    }

    public function get_words_list() {
        $query = $this->db->get('words');
        return $query->result_array();
    }

    public function insert_word($latin, $arab) {
        $this->latin = mb_strtolower($latin);
        $this->arab = $arab;
        $this->db->insert('words', $this);
    }
    public function words_count() {
        return $this->db->count_all_results('words');
    }
    public function update_word($latin, $arab) {
        $this->latin = $latin;
        $this->arab = $arab;
        $this->db->update('words', $this, array('latin' => $latin));
    }
    public function search_word($latin) {
        $this->db->select('id');
        $this->db->where('latin', $latin);
        $query = $this->db->get('words');
        return $query->num_rows();
    }

}

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

    public function get_authors($id) {
        $this->db->select('book_author.author_id,authors.author');
        $this->db->where('book_id', $id);
        $this->db->from('book_author');
        $this->db->join('authors', 'authors.id = book_author.author_id', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

}

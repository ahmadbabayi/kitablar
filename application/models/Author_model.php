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
        $this->db->where('book_id',$id);
        $this->db->from('book_author');
        $this->db->join('authors', 'authors.id = book_author.author_id', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_book_authors($id) {
        $this->db->select('book_id');
        $this->db->where('author_id',$id);
        $query = $this->db->get('book_author');
        return $query->result_array();
    }
    
    public function show_categories($id) {
        $this->db->where('language_id', $id);
        $query = $this->db->get('categories');
        return $query->result_array();
    }
    
    public function show_category_books($ids) {
        $this->db->where_in('id', $ids);
        $this->db->where('active', 1);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('books');
        return $query->result_array();
    }
    
    public function get_book_categories($id) {
        $this->db->select('book_id');
        $this->db->where('category_id',$id);
        $query = $this->db->get('book_category');
        return $query->result_array();
    }
    
    public function show_related_books($id) {
        $this->db->where('language', $id);
        $this->db->where('active', 1);
        $this->db->order_by('id', 'random');
        $query = $this->db->get('books', 6);
        return $query->result_array();
    }

}

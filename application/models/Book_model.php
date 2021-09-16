<?php

class Book_model extends CI_Model {

    public function __construct() {
        
    }

    public function record_count() {
        $this->db->where('active', 1);
        return $this->db->count_all_results('books');
    }

    public function record_language_count($lang) {
        $this->db->where('language', $lang);
        $this->db->where('active', 1);
        return $this->db->count_all_results('books');
    }

    public function record_category_book_count($lang) {
        $this->db->where('language', $lang);
        $this->db->where('active', 1);
        return $this->db->count_all_results('books');
    }
    
    public function get_books() {
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('books');
        return $query->result_array();
    }

    public function fetch_records($limit, $start) {
        $this->db->limit($limit, $start);
        $this->db->where('active', 1);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('books');
        return $query->result_array();
    }

    public function fetch_language_records($limit, $start, $lang) {

        $this->db->where('active', 1);
        $this->db->where('language', $lang);
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get('books');
        return $query->result_array();
    }
    
    public function fetch_author_records($id) {
        $this->db->select('books.*');
        $this->db->from('books');
        $this->db->where('books.active', 1);
        $this->db->order_by('books.id', 'DESC');
        $this->db->join('users', 'users.id = books.user_id', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function show_books($id) {
        $this->db->select('books.id,books.title,books.translator,books.language,books.isbn,books.hits,books.user_id,books.description,books.keywords,users.username');
        $this->db->from('books');
        $this->db->where('books.id', $id);
        $this->db->join('users', 'users.id = books.user_id', 'left');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function show_files($id) {
        $this->db->where('book_id', $id);
        $query = $this->db->get('book_files');
        return $query->result_array();
    }

    public function show_file($id) {
        $query = $this->db->get_where('book_files', array('id' => $id));
        return $query->row_array();
    }

    public function insert_book() {
        $this->language = $this->input->post('book_lang');
        $this->title = $this->input->post('title');
        $this->author = $this->input->post('author');
        $this->translator = $this->input->post('translator');
        $this->isbn = $this->input->post('isbn');
        $this->description = $this->input->post('description');
        $this->date = time();

        $this->db->insert('books', $this);
    }
    
    public function update_book() {
        $this->language = $this->input->post('book_lang');
        $this->title = $this->input->post('title');
        $this->author = $this->input->post('author');
        $this->translator = $this->input->post('translator');
        $this->isbn = $this->input->post('isbn');
        $this->description = $this->input->post('description');
        $this->date = time();
        $id = $this->input->post('id');

        $this->db->update('books', $this, array('id' => $id));
    }
    
    public function update_hit($id,$num) {
        $this->hits = $num+1;
        $this->db->update('books', $this, array('id' => $id));
    }
    
    public function update_download_hit($id,$num) {
        $this->download = $num+1;
        $this->db->update('book_files', $this, array('id' => $id));
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
    
    public function show_formats() {
        $this->db->select('format');
        $this->db->distinct();
        $query = $this->db->get('book_files');
        return $query->result_array();
    }

}

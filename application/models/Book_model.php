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
    
    
    public function record_format_count($format) {
        $this->db->select('book_files.book_id,book_files.format,books.*');
        $this->db->from('book_files');
        $this->db->where('books.active', 1);
        $this->db->where('book_files.format', $format);
        $this->db->order_by('books.id', 'DESC');
        $this->db->join('books', 'books.id = book_files.book_id', 'left');
        //$query = $this->db->get();
        return $this->db->count_all_results();
    }
    
    public function fetch_format_records($limit, $start, $format) {
        $this->db->select('book_files.book_id,book_files.format,books.*');
        $this->db->from('book_files');
        $this->db->where('books.active', 1);
        $this->db->where('book_files.format', $format);
        $this->db->order_by('books.id', 'DESC');
        $this->db->join('books', 'books.id = book_files.book_id', 'left');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
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

    public function show_book($id) {
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
    
    public function get_tags($id) {
        $this->db->select('book_tag.tag_id,tags.tag');
        $this->db->where('book_id',$id);
        $this->db->from('book_tag');
        $this->db->join('tags', 'tags.id = book_tag.tag_id', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_book_tags($id) {
        $this->db->select('book_id');
        $this->db->where('tag_id',$id);
        $query = $this->db->get('book_tag');
        return $query->result_array();
    }
    
    public function show_category_books($ids) {
        $this->db->where_in('id', $ids);
        $this->db->where('active', 1);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('books');
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

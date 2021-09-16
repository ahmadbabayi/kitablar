<?php

class Test_model extends CI_Model {

    public function __construct() {
        
    }
    
    public function get_books() {
        $query = $this->db->get('books');
        return $query->result_array();
    }

    public function get_books2() {
        $this->db->where('language', 2);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('books');
        return $query->result_array();
    }

    public function show_books2() {
        $this->db->select('books.*,book_files.*');
        $this->db->from('book_files');
        $this->db->join('books', 'books.id = book_files.book_id', 'left');
        $this->db->where('books.language', 3);
        $this->db->order_by('book_files.md5file', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function show_books3() {
        $this->db->select('books.*,book_files.*');
        $this->db->from('book_files');
        $this->db->join('books', 'books.id = book_files.book_id', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_authors() {
        $query = $this->db->get('authors');
        return $query->result_array();
    }
    
    public function search_author($id) {
        $query = $this->db->query('SELECT book_id FROM book_author WHERE author_id = "'.$id.'"');
        $row = $query->row();
        if ($query->num_rows()>0) {
            return $row->book_id;
        } else {
            return 0;
        }
    }

    public function insert_metadata($row,$format) {
        $this->language = 'fas';
        $this->title = $row['title'];
        $this->author = $row['author'];
        $this->translator = $row['translator'];
        $this->isbn = $row['isbn'];
        $this->description = $row['description'];
        $this->md5file = $row['md5file'];
        $this->format = $format;

        $this->db->insert('metadata', $this);
    }

    public function show_all_files() {
        $this->db->order_by('book_id', 'ASC');
        $query = $this->db->get('book_files');
        return $query->result_array();
    }
    
    public function search_word($author) {
        $query = $this->db->query('SELECT id FROM authors WHERE author = "'.$author.'"');
        $row = $query->row();
        if ($query->num_rows()>0) {
            return $row->id;
        } else {
            return 0;
        }
    }
    
    public function insert_word($word) {
        $this->author = $word;
        $this->db->insert('authors', $this);
        unset($this->author);
        return $this->db->insert_id();
    }
}

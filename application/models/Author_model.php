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
    
    public function search_author($author) {
        $query = $this->db->query('SELECT id FROM authors WHERE BINARY author = "'.$author.'"');
        $row = $query->row();
        if ($query->num_rows()>0) {
            return $row->id;
        } else {
            return 0;
        }
    }
    
    public function insert_author($author) {
        $this->author = $author;
        $this->db->insert('authors', $this);
        unset($this->author);
        return $this->db->insert_id();
    }
    
}

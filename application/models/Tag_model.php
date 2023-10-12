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
    
    public function search_tag($tag) {
        $query = $this->db->query('SELECT id FROM tags WHERE BINARY tag = "'.$tag.'"');
        $row = $query->row();
        if ($query->num_rows()>0) {
            return $row->id;
        } else {
            return 0;
        }
    }
    
    public function search_tag_by_id($id) {
        $query = $this->db->query('SELECT book_id FROM book_tag WHERE tag_id = "'.$id.'"');
        $row = $query->row();
        if ($query->num_rows()>0) {
            return $row->book_id;
        } else {
            return 0;
        }
    }
    
    public function insert_tag($tag) {
        $this->tag = $tag;
        $this->db->insert('tags', $this);
        unset($this->tag);
        return $this->db->insert_id();
    }

}

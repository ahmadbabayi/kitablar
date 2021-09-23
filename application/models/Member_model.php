<?php

class Member_model extends CI_Model {

    public function __construct() {
        
    }

    public function record_count($userid) {
        $this->db->where('user_id', $userid);
        return $this->db->count_all_results('books');
    }

    public function get_user_books($userid) {
        $this->db->where('user_id', $userid);
        $query = $this->db->get('books');
        return $query->result_array();
    }

    public function show_book($id) {
        $query = $this->db->get_where('books', array('id' => $id , 'user_id' => $this->session->userdata('user_id')));
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
        $this->title = ucfirst(arab2farsi($this->input->post('title')));
        $this->translator = ucfirst(arab2farsi($this->input->post('translator')));
        $this->isbn = $this->input->post('isbn');
        $this->description = arab2farsi($this->input->post('description'));
        $this->user_id = $this->session->userdata('user_id');
        $this->date = time();

        $this->db->insert('books', $this);
        
        unset($this->language);
        unset($this->title);
        unset($this->translator);
        unset($this->isbn);
        unset($this->description);
        unset($this->user_id);
        unset($this->date);
    }

    public function insert_book_file($id, $filename) {
        $this->book_id = $id;
        $this->file_name = $filename;
        $this->date = time();

        $this->db->insert('book_files', $this);
    }

    public function update_book() {
        if ($this->input->post('book_lang') == 0) {
            $this->language = $this->input->post('book_lang_code');
        } else {
            $this->language = $this->input->post('book_lang');
        }

        $this->title = $this->input->post('title');
        $this->translator = $this->input->post('translator');
        $this->isbn = $this->input->post('isbn');
        $this->description = $this->input->post('description');
        $this->date = time();
        $id = $this->input->post('id');

        $this->db->update('books', $this, array('id' => $id));     
        
        unset($this->language);
        unset($this->title);
        unset($this->translator);
        unset($this->isbn);
        unset($this->description);
        unset($this->date);
    }

    public function show_profile($id) {

        $query = $this->db->get_where('users', array('id' => $id));
        return $query->row_array();
    }

    public function update_profile() {

        $this->email = $this->input->post('email');
        $this->password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
        $id = $this->input->post('id');

        $this->db->update('users', $this, array('id' => $id));
    }
    
    public function get_authors($id) {
        $this->db->select('book_author.author_id,authors.author');
        $this->db->where('book_id',$id);
        $this->db->from('book_author');
        $this->db->join('authors', 'authors.id = book_author.author_id', 'left');
        $query = $this->db->get();
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
    
    public function insert_book_author($id,$author_id) {
        $this->book_id = $id;
        $this->author_id = $author_id;
        $this->db->insert('book_author', $this);
        unset($this->book_id);
        unset($this->author_id);
    }

    public function get_categories($id) {
        $this->db->where('language_id',$id);
        $query = $this->db->get('tags');
        return $query->result_array();
    }
    
    public function insert_category() {
        $id = $this->input->post('id');
        $this->db->query('delete from book_tag where book_id='.$id);
        $category = $this->input->post('tags');
        $ins_array = array();
        if (!empty($category)){
        foreach ($category as $key => $value) {
            $ins_array[] = "('$id','$value')";
        }
        $this->db->query('INSERT INTO `book_tag` (`book_id`,`tag_id`) VALUES'.  implode(',', $ins_array));
        }
    }
    
    public function get_book_categories($id) {
        $this->db->select('tag_id');
        $this->db->where('book_id',$id);
        $query = $this->db->get('book_tag');
        return $query->result_array();
    }
}

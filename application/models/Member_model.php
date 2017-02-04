<?php

class Member_model extends CI_Model {

    public function __construct() {
        
    }

    public function record_count($userid) {
        $this->db->where('user_id', $userid);
        return $this->db->count_all_results('books');
    }

    public function get_books($userid) {
        $this->db->where('user_id', $userid);
        $query = $this->db->get('books');
        return $query->result_array();
    }

    public function show_books($id) {
        $query = $this->db->get_where('books', array('id' => $id , 'user_id' => $this->session->userdata('user_id')));
        return $query->row_array();
    }

    public function show_files($id) {
        $this->db->where('book_id', $id);
        $query = $this->db->get('book_files');
        return $query->result_array();
    }

    public function insert_book() {
        $this->language = $this->input->post('book_lang');
        $this->title = $this->input->post('title');
        $this->author = $this->input->post('author');
        $this->translator = $this->input->post('translator');
        $this->isbn = $this->input->post('isbn');
        $this->description = $this->input->post('description');
        $this->user_id = $this->session->userdata('user_id');
        $this->date = time();

        $this->db->insert('books', $this);
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
        $this->author = $this->input->post('author');
        $this->translator = $this->input->post('translator');
        $this->isbn = $this->input->post('isbn');
        $this->description = $this->input->post('description');
        $this->date = time();
        $id = $this->input->post('id');

        $this->db->update('books', $this, array('id' => $id));
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

    public function get_library($userid) {
        $this->db->where('user_id', $userid);
        $query = $this->db->get('library');
        return $query->result_array();
    }

    public function insert_library() {
        $this->title = $this->input->post('title');
        $this->user_id = $this->session->userdata('user_id');

        $this->db->insert('library', $this);
    }
    
    public function library_book_ids($id) {
        $this->db->select('book_ids');
        $this->db->where('id',$id);
        $this->db->where('user_id',$this->session->userdata('user_id'));
        $query = $this->db->get('library');
        return $query->row_array();
    }

    public function show_library_books($ids) {
        $this->db->where_in('id', $ids);
        $query = $this->db->get('books');
        return $query->result_array();
    }
    
    public function insert_library_book($id,$book_ids) {
        $this->book_ids = $book_ids;
        $this->db->update('library', $this, array('id' => $id, 'user_id' => $this->session->userdata('user_id')));
    }
    
    public function show_library_name($id) {
        $query = $this->db->get_where('library', array('id' => $id));
        return $query->row_array();
    }

    public function get_categories($id) {
        $this->db->where('language_id',$id);
        $query = $this->db->get('categories');
        return $query->result_array();
    }
    
    public function insert_category() {
        $id = $this->input->post('id');
        $this->db->query('delete from book_category where book_id='.$id);
        $category = $this->input->post('category');
        $ins_array = array();
        if (!empty($category)){
        foreach ($category as $key => $value) {
            $ins_array[] = "('$id','$value')";
        }
        $this->db->query('INSERT INTO `book_category` (`book_id`,`category_id`) VALUES'.  implode(',', $ins_array));
        }
    }
    
    public function get_book_categories($id) {
        $this->db->select('category_id');
        $this->db->where('book_id',$id);
        $query = $this->db->get('book_category');
        return $query->result_array();
    }
}

<?php

class Admin_model extends CI_Model {

    public function __construct() {
        
    }

    public function record_count() {
        return $this->db->count_all('books');
    }

    public function get_verify() {
        $this->db->where('active', 0);
        $query = $this->db->get('books');
        return $query->result_array();
    }

    public function update_verify($id) {
        $this->active = 1;
        $this->db->update('books', $this, array('id' => $id));
    }

    public function update_deverify($id) {
        $this->active = 0;
        $this->db->update('books', $this, array('id' => $id));
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

    public function show_books($id) {

        $query = $this->db->get_where('books', array('id' => $id));
        return $query->row_array();
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

    public function show_files($id) {
        $this->db->where('book_id', $id);
        $query = $this->db->get('book_files');
        return $query->result_array();
    }

    public function show_all_files() {
        $this->db->order_by('book_id', 'ASC');
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

    public function get_users() {
        $query = $this->db->get('users');
        return $query->result_array();
    }

    public function show_users($id) {

        $query = $this->db->get_where('users', array('id' => $id));
        return $query->row_array();
    }

    public function insert_user() {
        $this->username = $this->input->post('username');
        $this->email = $this->input->post('email');
        $this->password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
        $this->created_at = time();

        $this->db->insert('users', $this);
    }

    public function user_update() {
        if ($this->input->post('password') != '') {
            $this->password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
        }
        $this->username = $this->input->post('username');
        $this->email = $this->input->post('email');
        $id = $this->input->post('id');
        $this->db->update('users', $this, array('id' => $id));
    }

    public function get_categories() {
        $query = $this->db->get('categories');
        return $query->result_array();
    }

    public function insert_category() {
        $this->title = $this->input->post('title');
        $this->description = $this->input->post('description');
        $this->language_id = $this->input->post('lang');

        $this->db->insert('categories', $this);
    }

    public function show_categories($id) {

        $query = $this->db->get_where('categories', array('id' => $id));
        return $query->row_array();
    }

    public function category_update() {
        if ($this->input->post('lang') == 0) {
            $this->language_id = $this->input->post('lang_code');
        } else {
            $this->language_id = $this->input->post('lang');
        }
        $this->title = $this->input->post('title');
        $this->description = $this->input->post('description');
        $id = $this->input->post('id');
        $this->db->update('categories', $this, array('id' => $id));
    }

    public function get_contacts() {
        $query = $this->db->get('contact');
        return $query->result_array();
    }

}

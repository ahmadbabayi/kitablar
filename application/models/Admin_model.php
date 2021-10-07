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

    public function show_book($id) {
        $query = $this->db->get_where('books', array('id' => $id));
        return $query->row_array();
    }

    public function show_files($id) {
        $this->db->where('book_id', $id);
        $query = $this->db->get('book_files');
        return $query->result_array();
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

    public function get_contacts() {
        $query = $this->db->get('contact');
        return $query->result_array();
    }

}

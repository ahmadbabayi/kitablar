<?php

class Book extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('book_model');
        $this->load->library('pagination');

        //pagination
        $config['base_url'] = site_url() . '/book/page/';
        $total_row = $this->book_model->record_count();
        $config['total_rows'] = $total_row;
        $config['per_page'] = $this->config->item('per_page');
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        $config['attributes'] = array('class' => 'w3-button');
        $this->pagination->initialize($config);
    }

    public function index() {
        $start = $this->uri->segment(3, 0);
        $limit = $this->config->item('per_page');
        $data['booklist'] = $this->book_model->fetch_records($limit, $start);
        $data['pagination'] = $this->pagination->create_links();
        $total_row = $this->book_model->record_count();
        $data['totalrows'] = $total_row;
        $pages = round($total_row / $this->config->item('per_page'));
        if ($total_row / $this->config->item('per_page') > $pages) {
            $pages = $pages + 1;
        }
        $data['pages'] = $pages;
        $data['description'] = 'E-book list in some languages';
        $data['keywords'] = 'آذربایجانجا  Azərbaycanca فارسی Türkçe English other';
        $data['title'] = 'E-book list';
        $this->load->view('header', $data);
        $this->load->view('book/booklist', $data);
        $this->load->view('footer');
    }

    public function page() {
        $start = $this->uri->segment(3, 0);
        $limit = $this->config->item('per_page');
        $data['booklist'] = $this->book_model->fetch_records($limit, $start);
        $data['pagination'] = $this->pagination->create_links();
        $total_row = $this->book_model->record_count();
        $data['totalrows'] = $total_row;
        $pages = round($total_row / $this->config->item('per_page'));
        if ($total_row / $this->config->item('per_page') > $pages) {
            $pages = $pages + 1;
        }
        $data['pages'] = $pages;
        $data['description'] = 'E-book list in some languages';
        $data['keywords'] = 'آذربایجانجا  Azərbaycanca فارسی Türkçe English other';
        $data['title'] = 'E-book list';
        $this->load->view('header', $data);
        $this->load->view('book/booklist', $data);
        $this->load->view('footer');
    }

    public function language() {
        $lang = intval($this->uri->segment(3, 0));
        $catid = intval($this->uri->segment(5, 0));
        if ($lang < 1 || $lang > 6) {
            redirect('book', 'location');
        }

        //categiry list
        if ($lang > 0 && $lang < 7) {
            $data['categorylist'] = $this->book_model->show_categories($lang);
        }
        $data['lang'] = $lang;

        if ($catid > 0) {
            //meta information
            $data['description'] = '';
            $data['keywords'] = '';
            $data['title'] = '';
            $data['booklist'] = [];

            //categiry list
            $ids = $this->book_model->get_book_categories($catid);
            if (!empty($ids)) {
                foreach ($ids as $value) {
                    $bookids[] = $value['book_id'];
                }
                $data['booklist'] = $this->book_model->show_category_books($bookids);
            }
            $this->load->view('header', $data);
            $this->load->view('book/categorybooklist', $data);
            $this->load->view('footer');
        } else {

            //change pagination method
            $total_row = $this->book_model->record_language_count($lang);
            $config['total_rows'] = $total_row;
            $config['base_url'] = site_url() . '/book/language/' . $lang;
            $this->pagination->initialize($config);

            $start = $this->uri->segment(4, 0);
            $limit = $this->config->item('per_page');
            $data['booklist'] = $this->book_model->fetch_language_records($limit, $start, $lang);
            $data['pagination'] = $this->pagination->create_links();
            $data['totalrows'] = $total_row;
            $pages = round($total_row / $this->config->item('per_page'));
            if ($total_row / $this->config->item('per_page') > $pages) {
                $pages = $pages + 1;
            }
            $data['pages'] = $pages;
            //meta information
            $this->load->helper('language_meta_helper');
            $data['description'] = lang_descriptions($lang);
            $data['keywords'] = lang_keywords($lang);
            $data['title'] = lang_title($lang);
            $this->load->view('header', $data);
            $this->load->view('book/languages');
            $this->load->view('book/booklist', $data);
            $this->load->view('footer');
        }
    }

    public function author() {
        $id = intval($this->uri->segment(4, 0));
        if ($id == 0) {
            redirect('book', 'location');
        }
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'search page';

        //author book list
        $ids = $this->book_model->get_book_authors($id);
        if (!empty($ids)) {
            foreach ($ids as $value) {
                $bookids[] = $value['book_id'];
            }
            $data['booklist'] = $this->book_model->show_category_books($bookids);
        }
        if (!empty($data['booklist'])) {

            $this->load->view('header', $data);
            $this->load->view('search/booklist', $data);
            $this->load->view('footer');
        } else {
            show_404();
        }
    }

    public function details() {
        $id = intval($this->uri->segment(3, 0));
        if ($id == 0) {
            redirect('book', 'location');
        }
        $this->load->model('member_model');
        $this->load->helper('file');
        $this->load->helper('download');
        $this->load->helper('number');
        $this->load->helper('date');
        $this->lang->load('dil', 'english');
        $ip = $this->input->ip_address();
        $this->session->set_userdata('downloadtoken', $ip);
        $data['authors'] = $this->book_model->get_authors($id);
        $metadata = $this->book_model->show_books($id);
        if (!empty($metadata)) {
            $data['row'] = $metadata;
            $data['filerow'] = $this->book_model->show_files($id);
            $data['related_books'] = $this->book_model->show_related_books($metadata['language']);
            $this->book_model->update_hit($id, $metadata['hits']);

            $data['description'] = $metadata['description'];
            $data['keywords'] = $metadata['keywords'];
            $data['title'] = $metadata['title'];

            $this->load->view('header', $data);
            $this->load->view('book/bookdetails', $data);
            $this->load->view('footer');
        } else {
            show_404();
        }
    }

    public function library() {
        $id = intval($this->uri->segment(3, 0));
        $this->session->set_userdata('libraryid', $id);
        redirect('book', 'location');
    }

    public function libraryadd() {
        $this->load->model('member_model');
        $id = intval($this->uri->segment(3, 0));
        $bookids2 = $this->member_model->library_book_ids($this->session->userdata('libraryid'));
        $bookids = $bookids2['book_ids'];
        $ids = explode(' ', $bookids);
        if (!in_array($id, $ids)) {
            $bookids .= " " . $id;
            $this->member_model->insert_library_book($this->session->userdata('libraryid'), $bookids);
        }
        echo '<button onclick="libraryremove(' . $id . ')">Remove from library</button>';
    }

    public function libraryremove() {
        $this->load->model('member_model');
        $id = intval($this->uri->segment(3, 0));
        $bookids2 = $this->member_model->library_book_ids($this->session->userdata('libraryid'));
        $bookids = $bookids2['book_ids'];
        $ids = explode(' ', $bookids);
        foreach ($ids as $key => $val) {
            if ($val == $id) {
                unset($ids[$key]);
            }
        }
        $idsnew = trim(implode(' ', $ids));
        $this->member_model->insert_library_book($this->session->userdata('libraryid'), $idsnew);
        echo '<button onclick="libraryadd(' . $id . ')">Add to library</button>';
    }

    public function download() {
        $id = intval($this->uri->segment(3, 0));
        $item = $this->book_model->show_file($id);
        if ($id == 0) {
            redirect('book', 'location');
        }
        if (!$this->session->has_userdata('downloadtoken')) {
            redirect('book/details/' . $item['book_id'], 'location');
        }
        $this->load->helper('download');

        $this->book_model->update_download_hit($id, $item['download']);

        $filename = './data/books/bk' . $item['book_id'] . '/' . $item['file_name'];
        force_download($filename, NULL);
        $this->session->unset_userdata('downloadtoken');
    }

}

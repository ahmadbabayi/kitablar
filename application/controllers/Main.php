<?php

class Main extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('main_model');
    }

    public function index() {
        $data['booklist'] = $this->main_model->get_last_five_entries();
        $data['topbooklist'] = $this->main_model->get_last_five_entries_top();
        $data['description'] = 'kitablar kitaplar kitab kitap ketab elekteron dicital elektronik pdf dərslik məktəb azeri azəri ebook free ebook yüklə endir yükle download ədəbiyyat tarix uşaq internet bilgisayar din kömpyuter türkcə türkçe library کتاب کیتاب دانلود رایگان کتب دیجیتال الکترونیک کامپیوتر اینترنت تاریخ تاریخی ادبیات داستان رمان آموزش آموزشی شعر زبان درسی درس پی دی اف ایبوک مجانیKitablar free ebook management system';
        $data['keywords'] = 'kitablar kitaplar kitab kitap ketab elekteron dicital elektronik pdf dərslik məktəb azeri azəri ebook free ebook yüklə endir yükle download ədəbiyyat tarix uşaq internet bilgisayar din kömpyuter türkcə türkçe library کتاب کیتاب دانلود رایگان کتب دیجیتال الکترونیک کامپیوتر اینترنت تاریخ تاریخی ادبیات داستان رمان آموزش آموزشی شعر زبان درسی درس پی دی اف ایبوک مجانی';
        $data['title'] = 'Kitablar free E-book management system';
        $this->load->view('header', $data);
        $this->load->view('main', $data);
        $this->load->view('footer');
    }
}

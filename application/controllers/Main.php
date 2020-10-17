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
        $this->load->view('book/languages');
        $this->load->view('main', $data);
        $this->load->view('footer');
    }

    public function la2arconvert() {
        $this->load->helper('str_helper');
        $this->load->library('form_validation');
        if (!(isset($_SESSION['username']) && $_SESSION['logged_in'] === true)) {
            $data['login'] = FALSE;
        } else {
            $data['login'] = TRUE;
        }
        $data['description'] = 'az';
        $data['keywords'] = 'az';
        $data['title'] = 'Kitablar free E-book management system';
        $wordslist = $this->main_model->get_words_list();
        $data['wordcount'] = $this->main_model->words_count();
        mb_internal_encoding("utf-8");

        $memo1 = $this->input->post('latin');

        if (mb_stripos($memo1, 'à') !== FALSE || mb_stripos($memo1, 'å') !== FALSE || mb_stripos($memo1, 'è') !== FALSE || mb_stripos($memo1, 'î') !== FALSE || mb_stripos($memo1, 'ÿ') !== FALSE || mb_stripos($memo1, 'þ') !== FALSE) {
            $memo1 = vajaqconvert($memo1);
        }

        $memo2 = trim($memo1);
        $memo2 = firstconvert($memo2);
        $memo2 = mb_strtolower($memo2);


        $memolist = preg_split('/[\s]+/', $memo2);

        for ($i = 0; $i < count($memolist); $i++) {
            if (convertableword($memolist[$i])) {
                $memolist[$i] = firstwordconvert($memolist[$i], $wordslist);
                $memolist[$i] = firstcharacter($memolist[$i]);
                $memolist[$i] = strreplace($memolist[$i]);
            }
        }
        $memo2 = implode(' ', $memolist);
        $memo2 = lastconvert($memo2);
        $data['memo1'] = $memo1;
        $data['memo2'] = $memo2;

        $this->load->view('header', $data);
        if ($data['login']) {
            $this->load->view('main/wordajaxadd');
        }
        $this->load->view('main/form', $data);
        $this->load->view('footer');
    }

    public function wordadd() {
        $latin = htmlspecialchars(strip_tags(urldecode($this->uri->segment(3, 0))));
        $latin = str_replace('ә', 'ə', $latin);
        $arab = htmlspecialchars(strip_tags(urldecode($this->uri->segment(4, 0))));
        if ($latin != '0' && $arab != '0' && isset($_SESSION['username']) && $_SESSION['logged_in'] === true) {
            $numrows = $this->main_model->search_word($latin);
            if ($numrows > 0) {
                $this->main_model->update_word($latin, $arab);
            } else {
                $this->main_model->insert_word($latin, $arab);
            }
        }
    }

}

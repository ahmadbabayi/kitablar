<?php

class Test extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('test_model');
        $this->load->helper('str_helper');
    }

    public function index() {
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'admin area';
        $this->load->view('template3', $data);
    }

    public function exportzip() {
        $data['description'] = '';
        $data['keywords'] = '';
        $data['title'] = 'admin area';
        $filelist = $this->test_model->show_all_files();
        //$zip = new ZipArchive;
        foreach ($filelist as $row) {
            $filename = 'data/books/bk' . $row['book_id'] . '/' . $row['file_name'];
            if (pathinfo($filename, PATHINFO_EXTENSION) == 'zip') {
                echo anchor('book/details/' . $row['book_id'], $row['file_name'] . '--' . $row['book_id'] . '<br>');
                //$res = $zip->open($filename);
                $extractpath = 'data/books/bk' . $row['book_id'] . '/';
                //$zip->extractTo($extractpath);
                //$zip->close();
                $pdffile = 'data/books/bk' . $row['book_id'] . '/' . basename($filename, ".zip") . '.apk';
                if (file_exists($pdffile)) {
                    echo 'zzzzzzzzz';
                    $this->db->query('UPDATE `book_files` SET `file_name`="' . basename($pdffile) . '" WHERE id=' . $row['id']);
                } else {
                    if ($handle = opendir($extractpath)) {
                        while (false !== ($entry = readdir($handle))) {
                            if ($entry != "." && $entry != "..") {
                                if (pathinfo($extractpath . $entry, PATHINFO_EXTENSION) == 'apk') {
                                    echo '<br>------------------------------<br>';
                                    rename($extractpath . $entry, $pdffile);
                                }
                                echo "$entry\n";
                            }
                        }
                        closedir($handle);
                    }
                }
                echo '<br><br>';
            }
        }
    }

    public function md5file() {
        $filelist = $this->test_model->show_all_files();
        foreach ($filelist as $row) {
            $filename = 'data/books/bk' . $row['book_id'] . '/' . $row['file_name'];
            $extractpath = 'data/export/';
            if (pathinfo($filename, PATHINFO_EXTENSION) == 'doc') {
                echo anchor('book/details/' . $row['book_id'], $row['file_name'] . '--' . $row['book_id'] . '<br>');
                if (file_exists($filename)) {
                    $this->db->query('UPDATE `book_files` SET `md5file`="' . md5_file($filename) . '" WHERE id=' . $row['id']);
                    //$handle = fopen($extractpath.'f'.$row['book_id'].'.txt', "w");
                    //fwrite($handle, md5_file($filename));
                    //copy($filename, $extractpath.'f'.$row['book_id'].'.pdf');
                    //fclose($handle);
                }
                echo '<br><br>';
            }
        }
    }

    public function files() {
        $filelist = $this->test_model->show_all_files();
        foreach ($filelist as $row) {
            $filename = 'data/books/bk' . $row['book_id'] . '/' . $row['file_name'];

            if (!file_exists($filename)) {
                echo anchor('book/details/' . $row['book_id'], $row['file_name'] . '--' . $row['book_id'] . '<br>');
                echo '<br><br>';
            }
        }
    }

    public function format() {
        $filelist = $this->test_model->show_all_files();
        foreach ($filelist as $row) {
            $filename = 'data/books/bk' . $row['book_id'] . '/' . $row['file_name'];
            $rmstr = 'data/books/bk' . $row['book_id'] . '/';
            $format = 'html';
            if (pathinfo($filename, PATHINFO_EXTENSION) == $format) {
                echo anchor('book/details/' . $row['book_id'], $row['file_name'] . '--' . $row['book_id'] . '<br>');
                $this->db->query('UPDATE `book_files` SET `format`="' . $format . '" WHERE id=' . $row['id']);
                //rename($filename, $filename.'l');
                echo '<br><br>';
            }
        }
    }

    public function bookmetadata() {
        $filelist = $this->test_model->show_books2();
        foreach ($filelist as $row) {
            $filename = 'data/books/bk' . $row['book_id'] . '/' . $row['file_name'];
            $extractpath = 'data/export/';
            $format = 'doc';
            if ($row['md5file'] != 0) {
                if (pathinfo($filename, PATHINFO_EXTENSION) == $format) {
                    echo $row['book_id'] . '--' . $row['title'] . '--' . $row['file_name'] . '--' . $row['md5file'];
                    echo '<br><br>';
                    //$this->test_model->insert_metadata($row,$format);
                }
            }
        }
    }

    public function cleanfiles() {
        $filelist = $this->test_model->show_books3();
        foreach ($filelist as $row) {
            $filename = 'data/books/bk' . $row['book_id'] . '/' . $row['file_name'];
            $exportpath = 'data/export/bk' . $row['book_id'];
            $cover = 'data/books/bk' . $row['book_id'] . '/cover.jpg';
            $coverthumb = 'data/books/bk' . $row['book_id'] . '/coverthumb.jpg';
            //mkdir($exportpath);
            copy($filename, $exportpath . '/' . $row['file_name']);
            if (file_exists($cover)) {
                copy($cover, $exportpath . '/cover.jpg');
                copy($coverthumb, $exportpath . '/coverthumb.jpg');
            }
        }
    }

    public function updatelang() {
        $filelist = $this->test_model->get_books();
        foreach ($filelist as $row) {
            $language = $row['language'];
            if ($language == "aze") {
                $this->db->query('UPDATE `books` SET `language`=2 WHERE id=' . $row['id']);
                //$handle = fopen($extractpath.'f'.$row['book_id'].'.txt', "w");
                //fwrite($handle, md5_file($filename));
                //copy($filename, $extractpath.'f'.$row['book_id'].'.pdf');
                //fclose($handle);

                echo '<br>' . $row['id'] . '<br>';
            }
        }
    }

    public function authors() {
        $list = $this->test_model->get_books();
        foreach ($list as $row) {
            $word = $row['author'];
            if ($word != '') {
                $word_id = $this->test_model->search_word($word);
                if ($word_id == 0) {
                    $word_id = $this->test_model->insert_word($word);
                    echo $word_id . '<br>';
                }
            }
        }
    }

    public function updateauthors() {
        $list = $this->test_model->get_books();
        foreach ($list as $row) {
            $word = $row['author'];
            if ($word != '') {
                $word_id = $this->test_model->search_word($word);
                if ($word_id != 0) {
                    $this->db->query('UPDATE `books` SET `author`="' . $word_id . '" WHERE id=' . $row['id']);
                }
            }
        }
    }

    public function updatestr() {
        $filelist = $this->test_model->get_books();
        foreach ($filelist as $row) {
            $str = arab2farsi($row['author']);
            $this->db->query('UPDATE `books` SET `author`="' . $str . '" WHERE id=' . $row['id']);
        }
    }

    public function upstr() {
        $filelist = $this->test_model->get_books();
        foreach ($filelist as $row) {
            $str = upstr($row['author']);
            if ($row['language'] == 2) {
                echo $str . '<br>';
                $this->db->query('UPDATE `books` SET `author`="' . $str . '" WHERE id=' . $row['id']);
            }
        }
    }

    public function insert2ba() {
        $filelist = $this->test_model->get_books();
        foreach ($filelist as $row) {
            if ($row['author'] != '') {
                $this->db->query('INSERT INTO `book_author`(`book_id`, `author_id`) VALUES (' . $row['id'] . ',' . $row['author'] . ')');
            }
        }
    }

    public function cleanauthors() {
        $list = $this->test_model->get_authors();
        foreach ($list as $value) {
            $author_id = $this->test_model->search_author($value['id']);
            if ($author_id == 0) {
                echo $value['author'] . '<br>';
                $this->db->query('delete from authors where id=' . $value['id']);
            }
        }
    }

}
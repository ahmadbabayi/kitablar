<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function arab2farsi($str) {
    $str = str_replace('ي', 'ی', $str);
    $str = str_replace('ك', 'ک', $str);
    $str = str_replace('دوکتور ', '', $str);

    return $str;
}

function upstr($str) {
    $len = get_num_of_words($str);
    if ($len == 2) {
        $str = ucwords( $str, " ") ;
        return $str;
    }
    return $str;
}

function get_num_of_words($string) {
      $string = preg_replace('/\s+/', ' ', trim($string));
      $words = explode(" ", $string);
      return count($words);
}

function remove_bracket($str) {
    $str = str_replace('(', '', $str);
    $str = str_replace(')', '', $str);
    $str = str_replace('&', ' - ', $str);
    return $str;
}

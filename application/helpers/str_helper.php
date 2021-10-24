<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function arab2farsi($str) {
    $str = str_replace('ي', 'ی', $str);
    $str = str_replace('ي', 'ی', $str);
    $str = str_replace('ك', 'ک', $str);
    return $str;
}

function upstr($str) {
    $len = get_num_of_words($str);
    if ($len == 2) {
        $str = ucwords($str, " ");
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
    $str = str_replace(',', ' ', $str);
    $str = str_replace('  ', ' ', $str);
    //$str = str_replace(' ', '_', $str);
    //$str = str_replace(':', '_', $str);
    $str = str_replace('(', '', $str);
    $str = str_replace(')', '', $str);
    $str = str_replace('&', ' - ', $str);
    $str = str_replace('/', '-', $str);
    $str = str_replace('\'', '', $str);
    return $str;
}

function getuid($string) {
    $hash = md5($string);
    return substr($hash, 0, 8) . '-' . substr($hash, 8, 4) . '-' . substr($hash, 12, 4) . '-' . substr($hash, 16, 4) . '-' . substr($hash, 20, 12);
}

function scan_Dir($dir) {
    $arrfiles = array();
    if (is_dir($dir)) {
        if ($handle = opendir($dir)) {
            chdir($dir);
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != "..") {
                    if (is_dir($file)) {
                        $arr = scan_Dir($file);
                        foreach ($arr as $value) {
                            $arrfiles[] = $dir . "/" . $value;
                        }
                    } else {
                        $arrfiles[] = $dir . "/" . $file;
                    }
                }
            }
            chdir("../");
        }
        closedir($handle);
    }
    return $arrfiles;
}

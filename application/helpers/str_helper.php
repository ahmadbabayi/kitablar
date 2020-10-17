<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function strreplace($str) {
    $str = str_replace('aa', 'اعا', $str);
    $str = str_replace('iy', 'ی', $str);
    $str = str_replace('a', 'ا', $str);
    $str = str_replace('b', 'ب', $str);
    $str = str_replace('c', 'ج', $str);
    $str = str_replace('d', 'د', $str);
    $str = str_replace('e', 'ئ', $str);
    $str = str_replace('f', 'ف', $str);
    $str = str_replace('g', 'گ', $str);
    $str = str_replace('h', 'ه', $str);
    $str = str_replace('j', 'ژ', $str);
    $str = str_replace('k', 'ک', $str);
    $str = str_replace('i', 'ی', $str);
    $str = str_replace('l', 'ل', $str);
    $str = str_replace('m', 'م', $str);
    $str = str_replace('n', 'ن', $str);
    $str = str_replace('o', 'و', $str);
    $str = str_replace('p', 'پ', $str);
    $str = str_replace('q', 'ق', $str);
    $str = str_replace('r', 'ر', $str);
    $str = str_replace('s', 'س', $str);
    $str = str_replace('t', 'ت', $str);
    $str = str_replace('x', 'خ', $str);
    $str = str_replace('y', 'ی', $str);
    $str = str_replace('v', 'و', $str);
    $str = str_replace('u', 'و', $str);
    $str = str_replace('z', 'ز', $str);
    $str = str_replace('ə', '', $str);
    $str = str_replace('ü', 'و', $str);
    $str = str_replace('ö', 'ؤ', $str);
    $str = str_replace('ğ', 'غ', $str);
    $str = str_replace('ç', 'چ', $str);
    $str = str_replace('ş', 'ش', $str);
    $str = str_replace('ı', 'ی', $str);

    return $str;
}

function firstconvert($str) {
    $str = str_replace('ј', 'y', $str);
    $str = str_replace('Ә', 'ə', $str);
    $str = str_replace('ә', 'ə', $str);
    $str = str_replace('Ə', 'ə', $str);
    $str = str_replace('Ö', 'ö', $str);
    $str = str_replace('Ğ', 'ğ', $str);
    $str = str_replace('I', 'ı', $str);
    $str = str_replace('Ç', 'ç', $str);
    $str = str_replace('Ş', 'ş', $str);
    $str = str_replace('Ü', 'ü', $str);
    $str = str_replace('İ', 'i', $str);
    $str = str_replace('?', ' ?', $str);
    $str = str_replace('?', '؟', $str);
    $str = str_replace('/*', '', $str);
    $str = str_replace('*/', '', $str);
    $str = str_replace(',', ' ,', $str);
    $str = str_replace('.', ' .', $str);
    $str = str_replace('
', ' %% ', $str);
    
    return $str;
}

function firstwordconvert($str,$wordslist) {
    foreach ($wordslist as $row) {
        if ($str == $row['latin']) {
          $str = str_replace($row['latin'], $row['arab'], $str);  
        }
    }
    return $str;
}

function lastconvert($str) {
    $str = str_replace(' %% ', '
', $str);
    $str = str_replace('%% ', '
', $str);
    $str = str_replace('%%', '
', $str);
    $str = str_replace('ووو', 'وو', $str);
    $str = str_replace(' ,', ',', $str);
    $str = str_replace(' .', '.', $str);
    $str = str_replace(' ؟', '؟', $str);
    
    return $str;
}

function firstcharacter($str) {
    $firstchar = mb_substr($str, 0, 1);
    $str2 = mb_substr($str, 1);

    if ($firstchar == 'a') {
        $firstchar = str_replace('a', 'آ', $firstchar);
    }
    if ($firstchar == 'i') {
        $firstchar = str_replace('i', 'ای', $firstchar);
    }
    if ($firstchar == 'o') {
        $firstchar = str_replace('o', 'او', $firstchar);
    }
    if ($firstchar == 'ö') {
        $firstchar = str_replace('ö', 'اؤ', $firstchar);
    }
    if ($firstchar == 'u') {
        $firstchar = str_replace('u', 'او', $firstchar);
    }
    if ($firstchar == 'ü') {
        $firstchar = str_replace('ü', 'او', $firstchar);
    }
    if ($firstchar == 'e') {
        $firstchar = str_replace('e', 'ائ', $firstchar);
    }
    if ($firstchar == 'ə') {
        $firstchar = str_replace('ə', 'ا', $firstchar);
    }
    $str = $firstchar.$str2;

    $lastchar = mb_substr($str, -1);
    $str2 = mb_substr($str, 0,-1);

    if ($lastchar == 'ə') {
        $lastchar = str_replace('ə', 'ه', $lastchar);

    }

    $str = $str2.$lastchar;
    return $str;
}

function convertableword($str) {
    if (strpos($str, 'w') !== FALSE || strpos($str, 'http') !== FALSE){
        return 0;
    }
 else {
        return 1;    
    }
}

function vajaqconvert($str) {
    $str = str_replace('À', 'A', $str);
    $str = str_replace('Á', 'B', $str);
    $str = str_replace('Ú', 'C', $str);
    $str = str_replace('Ä', 'D', $str);
    $str = str_replace('Å', 'E', $str);
    $str = str_replace('Ô', 'F', $str);
    $str = str_replace('Ý', 'G', $str);
    $str = str_replace('Ù', 'H', $str);
    $str = str_replace('È', 'İ', $str);
    $str = str_replace('Û', 'I', $str);
    $str = str_replace('Æ', 'J', $str);
    $str = str_replace('Ê', 'K', $str);
    $str = str_replace('Ë', 'L', $str);
    $str = str_replace('Ì', 'M', $str);
    $str = str_replace('Í', 'N', $str);
    $str = str_replace('Î', 'O', $str);
    $str = str_replace('Ï', 'P', $str);
    $str = str_replace('Ã', 'Q', $str);
    $str = str_replace('Ð', 'R', $str);
    $str = str_replace('Ñ', 'S', $str);
    $str = str_replace('Ò', 'T', $str);
    $str = str_replace('Â', 'V', $str);  
    $str = str_replace('Ó', 'U', $str);
    $str = str_replace('Õ', 'X', $str);
    $str = str_replace('É', 'Y', $str);
    $str = str_replace('Ü', 'Ğ', $str);
    $str = str_replace('ß', 'Ə', $str);
    $str = str_replace('Ø', 'Ş', $str);
    $str = str_replace('Õ', 'X', $str);
    $str = str_replace('Ö', 'Ü', $str);
    $str = str_replace('Þ', 'Ö', $str);
    $str = str_replace('Ç', 'Z', $str);
    $str = str_replace('×', 'Ç', $str);    
    
    $str = str_replace('à', 'a', $str);
    $str = str_replace('á', 'b', $str);
    $str = str_replace('ú', 'c', $str);
    $str = str_replace('ä', 'd', $str);
    $str = str_replace('å', 'e', $str);
    $str = str_replace('ô', 'f', $str);
    $str = str_replace('ý', 'g', $str);
    $str = str_replace('ù', 'h', $str);
    $str = str_replace('è', 'i', $str);
    $str = str_replace('æ', 'j', $str);
    $str = str_replace('ê', 'k', $str);
    $str = str_replace('ë', 'l', $str);
    $str = str_replace('ì', 'm', $str);
    $str = str_replace('í', 'n', $str);
    $str = str_replace('î', 'o', $str);
    $str = str_replace('ï', 'p', $str);
    $str = str_replace('ã', 'q', $str);
    $str = str_replace('ð', 'r', $str); 
    $str = str_replace('ñ', 's', $str);
    $str = str_replace('ò', 't', $str);
    $str = str_replace('â', 'v', $str);
    $str = str_replace('ó', 'u', $str);
    $str = str_replace('õ', 'x', $str);
    $str = str_replace('é', 'y', $str); 
    $str = str_replace('ÿ', 'ə', $str);
    $str = str_replace('ü', 'ğ', $str); 
    $str = str_replace('ç', 'z', $str); 
    $str = str_replace('ö', 'ü', $str);
    $str = str_replace('ø', 'ş', $str);  
    $str = str_replace('÷', 'ç', $str);  
    $str = str_replace('û', 'ı', $str);  
    $str = str_replace('þ', 'ö', $str);
       
    return $str;
}

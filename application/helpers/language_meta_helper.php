<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

function lang_descriptions($param) {
    switch ($param) {
        case 1:
            $text = 'آذربایجان دیلینده پولسوز تورکی کیتابلار دانلود ائدین بوتون فرمت لرده پی دی اف، ورد و ساییر';
            break;
        case 2:
            $text = 'Azərbaycan dilində ücrətsiz olaraq kitab endirin';
            break;
        case 3:
            $text = 'دانلود رایگان کتاب تورکی و کتاب فارسی در فرمتهای مختلف';
            break;
        case 4:
            $text = 'Anadolu türkçesinde ücretsiz kitap endirin';
            break;
        case 5:
            $text = 'download free english ebook in any file format';
            break;

        default:
            $text = 'download free ebook in any file format';
            break;
    }
    return $text;
}

function lang_keywords($param) {
    switch ($param) {
        case 1:
            $text = 'تورکی کیتاب تورکجه پی دی اف pdf آذربایجانجا آذری کتاب آذربایجانی ترکی ترک شاعر شعر دیل دیلچیلیک تاریخ ادبیات موسیقی';
            break;
        case 2:
            $text = 'azərbaycanca azerbaijani azəri azeri kitab kitablar pdf doc epub türkcə tarix ədəbiyyat musiqi dil dilçilik lüğət';
            break;
        case 3:
            $text = 'کتاب ترکی تورکی ترک فارسی رایگان آذربایجانی آذری تاریخ ادبیات زبان آموزش دانلود';
            break;
        case 4:
            $text = 'Anadolu türkçe ücretsiz kitap endir';
            break;
        case 5:
            $text = 'download free english ebook';
            break;

        default:
            $text = 'download free ebook';
            break;
    }
    return $text;
}

function lang_title($param) {
    switch ($param) {
        case 1:
            $text = 'آذربایجان دیلینده تورکجه کیتابلار';
            break;
        case 2:
            $text = 'Azərbaycan dilində kitablar';
            break;
        case 3:
            $text = 'کتابهای رایگان فارسی';
            break;
        case 4:
            $text = 'Anadolu türkçesinde kitaplar';
            break;
        case 5:
            $text = 'english free ebook';
            break;

        default:
            $text = 'free ebook';
            break;
    }
    return $text;
}
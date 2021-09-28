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
            $text = 'Azərbaycan dilində kitablar';
            break;
        case 3:
            $text = 'دانلود رایگان کتاب تورکی و کتاب فارسی';
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
            $text = ',تورکی ,کیتاب ,تورکجه ,پی دی اف pdf, آذربایجانجا ,آذری ,کتاب ,آذربایجانی ,ترکی ,ترک ,شاعر ,شعر ,دیل ,دیلچیلیک ,تاریخ ,ادبیات ,موسیقی';
            break;
        case 2:
            $text = 'azərbaycanca, azerbaijani, azəri, azeri, kitab, kitablar, pdf, doc, epub, türkcə, tarix, ədəbiyyat, musiqi, dil, dilçilik, lüğət';
            break;
        case 3:
            $text = 'کتاب ,ترکی ,تورکی ,ترک ,فارسی ,رایگان ,آذربایجانی ,آذری ,تاریخ ,ادبیات ,زبان ,آموزش ,دانلود';
            break;
        case 4:
            $text = 'Anadolu, türkçe, ücretsiz, kitap, kitaplar';
            break;
        case 5:
            $text = 'download, free, english, ebook';
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
            $text = 'English free ebook';
            break;

        default:
            $text = 'free ebook';
            break;
    }
    return $text;
}

function format_descriptions($param) {
    switch ($param) {
        case 'pdf':
            $text = 'Pdf format book list';
            break;
        case 'epub':
            $text = 'Epub format book list';
            break;
        case 'exe':
            $text = 'Exe format book list';
            break;
        case 'doc':
            $text = 'Microsoft word format book list';
            break;
        case 'docx':
            $text = 'Microsoft word format book list';
            break;
        case 'html':
            $text = 'Html format book list';
            break;
        case 'txt':
            $text = 'Text format book list';
            break;
        case 'apk':
            $text = 'Android application format book list';
            break;
        case 'jar':
            $text = 'Jar mobile application format book list';
            break;
        default:
            $text = 'Other format';
            break;
    }
    return $text;
}

function format_title($param) {
    switch ($param) {
        case 'pdf':
            $text = 'Pdf format book list';
            break;
        case 'epub':
            $text = 'Epub format book list';
            break;
        case 'exe':
            $text = 'Exe format book list';
            break;
        case 'doc':
            $text = 'Microsoft word format book list';
            break;
        case 'docx':
            $text = 'Microsoft word format book list';
            break;
        case 'html':
            $text = 'Html format book list';
            break;
        case 'txt':
            $text = 'Text format book list';
            break;
        case 'apk':
            $text = 'Android application format book list';
            break;
        case 'jar':
            $text = 'Jar mobile application format book list';
            break;

        default:
            $text = 'Free ebook';
            break;
    }
    return $text;
}

function format_keywords($param) {
    switch ($param) {
        case 'pdf':
            $text = 'Pdf, book, kitablar, kitab, Azərbaycan dili, آذربایجان دیلی, ترکی, کتاب, دانلود, تورکی, فارسی';
            break;
        case 'epub':
            $text = 'Epub, book, kitablar, kitab, Azərbaycan dili, آذربایجان دیلی, ترکی, کتاب, دانلود, تورکی, فارسی';
            break;
        case 'exe':
            $text = 'Exe, book, kitablar, kitab, Azərbaycan dili, آذربایجان دیلی, ترکی, کتاب, دانلود, تورکی, فارسی';
            break;
        case 'doc':
            $text = 'Doc, book, kitablar, kitab, Azərbaycan dili, آذربایجان دیلی, ترکی, کتاب, دانلود, تورکی, فارسی';
            break;
        case 'docx':
            $text = 'Docx, book, kitablar, kitab, Azərbaycan dili, آذربایجان دیلی, ترکی, کتاب, دانلود, تورکی, فارسی';
            break;
        case 'html':
            $text = 'Html, book, kitablar, kitab, Azərbaycan dili, آذربایجان دیلی, ترکی, کتاب, دانلود, تورکی, فارسی';
            break;
        case 'txt':
            $text = 'Text, book, kitablar, kitab, Azərbaycan dili, آذربایجان دیلی, ترکی, کتاب, دانلود, تورکی, فارسی';
            break;
        case 'apk':
            $text = 'Apk, android, book, kitablar, kitab, Azərbaycan dili, آذربایجان دیلی, ترکی, کتاب, دانلود, تورکی, فارسی';
            break;
        case 'jar':
            $text = 'Jar, mobile, book, kitablar, kitab, Azərbaycan dili, آذربایجان دیلی, ترکی, کتاب, دانلود, تورکی, فارسی';
            break;

        default:
            $text = 'download free ebook';
            break;
    }
    return $text;
}
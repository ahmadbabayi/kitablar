<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function create_thumb($image1_path, $image2_path, $box = 160) {
    // get image size and type
    list($width1, $height1, $image1_type) = getimagesize($image1_path);

    // make image smaller if doesn't fit to the box
    if ($width1 > $box || $height1 > $box) {
        // set the largest dimension
        $width2 = 115;
        $height2 = 160;

        // set image type, blending and set functions for gif, jpeg and png
        switch ($image1_type) {
            case IMAGETYPE_PNG: $img = 'png';
                $blending = false;
                break;
            case IMAGETYPE_GIF: $img = 'gif';
                $blending = true;
                break;
            case IMAGETYPE_JPEG: $img = 'jpeg';
                break;
        }
        $imagecreate = "imagecreatefrom$img";
        $imagesave = "image$img";

        // initialize image from the file
        $image1 = $imagecreate($image1_path);

        // create a new true color image with dimensions $width2 and $height2
        $image2 = imagecreatetruecolor($width2, $height2);

        // preserve transparency for PNG and GIF images
        if ($img == 'png' || $img == 'gif') {
            // allocate a color for thumbnail
            $background = imagecolorallocate($image2, 0, 0, 0);
            // define a color as transparent
            imagecolortransparent($image2, $background);
            // set the blending mode for thumbnail
            imagealphablending($image2, $blending);
            // set the flag to save alpha channel
            imagesavealpha($image2, true);
        }

        // save thumbnail image to the file
        imagecopyresampled($image2, $image1, 0, 0, 0, 0, $width2, $height2, $width1, $height1);
        $imagesave($image2, $image2_path);
    }
    // else just copy the image
    else {
        copy($image1_path, $image2_path);
    }
}

function brand_image($img) {
    $font = './system/fonts/texb.ttf';
    $fg = hextorgb('#ffffff');
    $bg = hextorgb('#000000');
    $alpha = 70 * 1.27;
    $bgcol = imagecolorallocatealpha($img, $bg['red'], $bg['green'], $bg['blue'], $alpha);
    $col = imagecolorallocate($img, $fg['red'], $fg['green'], $fg['blue']);
    if (function_exists('imagettfbbox') && $font != '' && file_exists($font)) {
        $bbox = imagettfbbox('12', 0, $font, 'www.kitablar.com');
        $width = $bbox[2] - $bbox[0];
        $height = $bbox[1] - $bbox[7]+10;
        $xoff = $bbox[0];
        $yoff = $bbox[1];
        $x = imagesx($img) - $xoff - $width - 5;
        $y = imagesy($img) - $yoff - 5 ;
        imagefilledrectangle($img, 0, imagesy($img) - $height, imagesx($img), imagesy($img), $bgcol);
        imagettftext($img, '12', 0, $x, $y, $col, $font, 'www.kitablar.com');
    } else {
        $width = imagefontwidth(2) * strlen('www.kitablar.com');
        $height = imagefontheight(2) + 4;
        imagefilledrectangle($img, 0, imagesy($img) - $height, imagesx($img), imagesy($img), $bgcol);
        imagestring($img, 2, imagesx($img) - $width - 4, imagesy($img) - $height, 'www.kitablar.com', $col);
    }
    return true;
}

//******************************************************************************************
function hextorgb($hex) {
    $hex = preg_replace('/[^0-9a-f]/i', '', $hex);
    $hex = str_pad($hex, 6, '0');
    $ret = array('red' => hexdec(substr($hex, 0, 2)), 'green' => hexdec(substr($hex, 2, 2)), 'blue' => hexdec(substr($hex, 4, 2)));
    return $ret;
}

//******************************************************************************************
function get_file_extension($file_name) {
    if (preg_match("#(.+)\.(.+)#", get_basefile($file_name), $regs)) {
        return strtolower($regs[2]);
    }
    return false;
}

//******************************************************************************************
function get_basefile($path) {
    $basename = get_basename($path);
    preg_match("#(.+)\?(.+)#", $basename, $regs);
    return isset($regs[1]) ? $regs[1] : $basename;
}

//******************************************************************************************
function get_basename($path) {
    $path = str_replace("\\", "/", $path);
    $name = substr(strrchr($path, "/"), 1);
    return $name ? $name : $path;
}

//******************************************************************************************
function branding($name) {
    $file_extension = get_file_extension($name);
    if ($file_extension == 'jpg' || $file_extension == 'JPG' || $file_extension == 'jpeg') {
        $img = imagecreatefromjpeg($name);
        brand_image($img);
        imagejpeg($img, $name, 90);
    }
}

<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function not_spam($str) {
    if (str_contains($str, "porn") || str_contains($str, "sex") || str_contains($str, "http")) {
    return false;
}
 else {
    return true;
}
}
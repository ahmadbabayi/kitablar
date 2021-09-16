<!DOCTYPE html>
<html>
    <title><?php echo $title; ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $description; ?>">
    <meta name="keywords" content="<?php echo $keywords; ?>">
    <script type="text/javascript" src="<?php echo base_url('cssjs/javascript.js'); ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url('cssjs/w3.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('cssjs/mycss.css'); ?>">
    <link rel="shortcut icon" href="<?php echo base_url('favicon.ico'); ?>">
    <link rel="alternate" type="application/rss+xml" title="RSS Feed for kitablar.com" href="<?php echo base_url('rss'); ?>" />
    <style>
        html,body,h1,h2,h3,h4,h5,h6 {font-family: "Tahoma", sans-serif;}
        .w3-sidebar {
            z-index: 3;
            width: 250px;
            top: 43px;
            bottom: 0;

        }
    </style>
    <body>
        <!-- Navbar -->
        <div class="w3-top">
            <div class="w3-bar w3-green w3-top w3-left-align w3-large">
                <a class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium w3-hover-white w3-large w3-theme-l1" href="javascript:void(0)" onclick="w3_open()"><i class="w3-button">☰</i></a>
                <a href="<?php echo base_url('') ?>" class="w3-bar-item"><img src="<?php echo base_url('images/logo.jpg'); ?>" alt="kitablar.com"/></a>
                <a href="<?php echo base_url('author') ?>" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Authors</a>
                <a href="<?php echo base_url('language') ?>" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Languages</a>
                <a href="<?php echo base_url('format') ?>" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Formats</a>
                <a href="<?php echo base_url('tag') ?>" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Tags</a>
                <a href="<?php echo base_url('book') ?>" class="w3-bar-item w3-button w3-hide-small w3-hover-white">All books</a>
                <?php if (isset($_SESSION['username']) && $_SESSION['logged_in'] === true) : ?>
                    <a href="<?php echo base_url('member') ?>" class="w3-bar-item w3-button w3-hide-small w3-hover-white"><?php echo $_SESSION['username'] ?></a>
                    <a href="<?= base_url('user/logout') ?>" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Logout</a>
                <?php else : ?>
                    <a href="<?= base_url('contactus') ?>" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Contac</a>
                <a href="<?php echo base_url('user/login'); ?>" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Login</a>
            <?php
            endif;
            ?>
            <div class="w3-right-align w3-hide-small w3-padding-16">
                <form action="<?php echo site_url('search/'); ?>" accept-charset="UTF-8" method="post"><input class="" type="text" name="search" placeholder="Search" required="" /> &nbsp;<button type="submit">Search</button></form>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <nav class="w3-sidebar w3-hide-large w3-hide-medium w3-bar-block w3-large w3-light-gray w3-animate-left" id="mySidebar" style="display:none;">
        <a href="javascript:void(0)" onclick="w3_close()" class="w3-right w3-xlarge w3-padding-large w3-hover-black" title="Close Menu">
            <i class="w3-hide-large">Close</i>
        </a>
        <h4 class="w3-bar-item"><b>Menu</b></h4>
        <div class="w3-container">
            <form action="<?php echo site_url('search/'); ?>" accept-charset="UTF-8" method="post"><input type="text" name="search" placeholder="Search" required="" /> &nbsp;<button type="submit">Search</button></form>
        </div>
        <a class="w3-bar-item w3-button w3-hover-black" onclick="w3_close()" href="<?php echo base_url('author') ?>">Authors</a>
        <a class="w3-bar-item w3-button w3-hover-black" onclick="w3_close()" href="<?php echo base_url('language') ?>">Languages</a>
        <a class="w3-bar-item w3-button w3-hover-black" onclick="w3_close()" href="<?php echo base_url('format') ?>">Formats</a>
        <a class="w3-bar-item w3-button w3-hover-black" onclick="w3_close()" href="<?php echo base_url('tag') ?>">Tags</a>
        <a class="w3-bar-item w3-button w3-hover-black" onclick="w3_close()" href="<?php echo base_url('book') ?>">All books</a>
        <?php if (isset($_SESSION['username']) && $_SESSION['logged_in'] === true) : ?>
                    <a href="<?php echo base_url('member') ?>" class="w3-bar-item w3-button w3-hover-black" onclick="w3_close()"><?php echo $_SESSION['username'] ?></a>
                    <a href="<?= base_url('user/logout') ?>" class="w3-bar-item w3-button w3-hover-black" onclick="w3_close()">Logout</a>
                <?php else : ?>
                    <a href="<?= base_url('contactus') ?>" class="w3-bar-item w3-button w3-hover-black" onclick="w3_close()">Contac</a>
                <a href="<?php echo base_url('user/login'); ?>" class="w3-bar-item w3-button w3-hover-black" onclick="w3_close()">Login</a>
            <?php
            endif;
            ?>
    </nav>
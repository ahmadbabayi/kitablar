<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?php echo $description; ?>">
        <meta name="keywords" content="<?php echo $keywords; ?>">
        <script type="text/javascript" src="<?php echo base_url('cssjs/javascript.js'); ?>"></script>
        <link rel="stylesheet" href="<?php echo base_url('cssjs/w3.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('cssjs/mycss.css'); ?>">
        <link rel="shortcut icon" href="<?php echo base_url('favicon.ico'); ?>">
        <link rel="alternate" type="application/rss+xml" title="RSS Feed for kitablar.com" href="<?php echo base_url('rss'); ?>" />
        <title><?php echo $title; ?></title>
    </head>
    <body>

        <div class="w3-top">
            <div class="w3-row w3-padding w3-green">
                <div class="w3-col s3">
                    <a id="nav1" href="<?= base_url('') ?>" class="w3-button w3-block w3-green">Home</a>
                </div>
                <div class="w3-col s3">
                    <a id="nav2" href="<?= base_url('book') ?>" class="w3-button w3-block w3-green">E-books</a>
                </div>

                <?php if (isset($_SESSION['username']) && $_SESSION['logged_in'] === true) : ?><div class="w3-col s3"><a href="<?php echo base_url('member') ?>" class="w3-button w3-block w3-green"><?php echo $_SESSION['username'] ?></a></div><div class="w3-col s3"><a href="<?= base_url('user/logout') ?>" class="w3-button w3-block w3-green">Logout</a></div>

                <?php else : ?>
                    <div class="w3-col s3"><a href="<?= base_url('contactus') ?>" class="w3-button w3-block w3-green">Contact Us</a></div>
                    <div class="w3-col s3">
                        <a id="nav5" href="<?php echo base_url('user/login'); ?>" class="w3-button w3-block w3-green">Login</a>
                    </div>
                <?php
                endif;
                ?>
            </div>
        </div>
        <div style="padding-top: 65px;">
            <div class="w3-container w3-center">
                <form action="<?php echo site_url('search/'); ?>" accept-charset="UTF-8" method="post"><input type="text" name="search" placeholder="Search" required="" /> &nbsp;<button type="submit">Search</button></form>
            </div>
        </div>
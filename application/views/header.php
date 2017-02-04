<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?php echo $description;  ?>">
        <meta name="keywords" content="<?php echo $keywords;  ?>">
        <script type="text/javascript" src="<?php echo base_url('js/javascript.js'); ?>"></script>
        <link rel="shortcut icon" href="<?php echo base_url('favicon.ico'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style.css'); ?>"/>
        <link rel="alternate" type="application/rss+xml" title="RSS Feed for kitablar.com" href="<?php echo base_url('rss'); ?>" />
        <title><?php echo $title;  ?></title>
    </head>
    <body>
        <div class="main">
            <div class="bashmain">
                <div class="bashtitle"><a href=""><img width="100px" src="<?php echo base_url(); ?>kitablarlogo.jpg"/>
                        <span>KITABLAR E-book management system</span></a>
                </div>
                <div class="searchbash"><form action="<?php echo site_url('search/'); ?>" accept-charset="UTF-8" method="post"><input type="text" name="search" placeholder="Search" required="" /> &nbsp;<button type="submit">Search</button></form></div>
                <div class="bash">
                    <ul>
                        <li><a href="<?= base_url('') ?>">Home</a></li>
                        <li><?php echo anchor('book', 'E-book list'); ?></li>
                        <li><?php echo anchor('contactus/submitebook', 'Submit E-book'); ?></li>
                        <li><?php echo anchor('contactus', 'Contact Us'); ?></li>
                        <li><?php if (isset($_SESSION['username']) && $_SESSION['logged_in'] === true) : ?><a href="<?= site_url('user/logout') ?>">Logout</a>
                            <?php else : ?><a href="<?php echo site_url('user/login'); ?>">Login</a> <?php endif; ?></li>
                        <?php
                        if (isset($_SESSION['username']) && $_SESSION['logged_in'] === true) {
                            echo '<li>' . anchor('member', 'Member area') . '</li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>

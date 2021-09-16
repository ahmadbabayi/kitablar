<!DOCTYPE html>
<html lang="en">
    <title>W3.CSS Template</title>
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
    <title><?php echo $title; ?></title>
    <body>

        <!-- Navbar -->
        <div class="w3-top">
            <div class="w3-bar w3-green w3-top w3-left-align w3-large">
                <a class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium w3-hover-white w3-large w3-theme-l1" href="javascript:void(0)" onclick="w3_open()"><i class="w3-button">☰</i></a>
                <a href="<?= base_url('') ?>" class="w3-bar-item w3-button w3-theme-l1">Logo</a>
                <a href="<?= base_url('author') ?>" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Authors</a>
                <a href="<?= base_url('language') ?>" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Languages</a>
                <a href="<?= base_url('format') ?>" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Formats</a>
                <a href="<?= base_url('tag') ?>" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Tags</a>
                <a href="<?= base_url('book') ?>" class="w3-bar-item w3-button w3-hide-small w3-hover-white">All books</a>
                <a href="<?= base_url('contactus') ?>" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Contact</a>
                <div class="w3-right-align w3-hide-small w3-padding-16">
                    <form action="<?php echo site_url('search/'); ?>" accept-charset="UTF-8" method="post"><input class="" type="text" name="search" placeholder="Search" required="" /> &nbsp;<button type="submit">Search</button></form>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <nav class="w3-hide-large w3-hide-medium w3-bar-block w3-collapse w3-large w3-light-gray w3-animate-left" id="mySidebar" style="display:none;">
            <a href="javascript:void(0)" onclick="w3_close()" class="w3-right w3-xlarge w3-padding-large w3-hover-black" title="Close Menu">
                <i class="w3-hide-large">Close</i>
            </a>
            <h4 class="w3-bar-item"><b>Menu</b></h4>
            <div class="w3-container">
                    <form action="<?php echo site_url('search/'); ?>" accept-charset="UTF-8" method="post"><input type="text" name="search" placeholder="Search" required="" /> &nbsp;<button type="submit">Search</button></form>
                </div>
            <a class="w3-bar-item w3-button w3-hover-black" onclick="w3_close()" href="#">Authors</a>
            <a class="w3-bar-item w3-button w3-hover-black" onclick="w3_close()" href="#">Languages</a>
            <a class="w3-bar-item w3-button w3-hover-black" onclick="w3_close()" href="#">Formats</a>
            <a class="w3-bar-item w3-button w3-hover-black" onclick="w3_close()" href="#">Tags</a>
            <a class="w3-bar-item w3-button w3-hover-black" onclick="w3_close()" href="#">All books</a>
            <a class="w3-bar-item w3-button w3-hover-black" onclick="w3_close()" href="#">Contact</a>
        </nav>


        <div class="w3-row w3-padding-64">
            <div class="w3-container">
                <h1 class="w3-text-teal">Heading</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum
                    dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>

        </div>

        <div class="w3-row">
            <div class=" w3-container">
                <h1 class="w3-text-teal">Heading</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum
                    dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
        </div>

        <div class="w3-row w3-padding-64">
            <div class="w3-container">
                <h1 class="w3-text-teal">Heading</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum
                    dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
        </div>

        <!-- Pagination -->
        <div class="w3-center w3-padding-32">
            <div class="w3-bar">
                <a class="w3-button w3-black" href="#">1</a>
                <a class="w3-button w3-hover-black" href="#">2</a>
                <a class="w3-button w3-hover-black" href="#">3</a>
                <a class="w3-button w3-hover-black" href="#">4</a>
                <a class="w3-button w3-hover-black" href="#">5</a>
                <a class="w3-button w3-hover-black" href="#">&raquo;</a>
            </div>
        </div>

        <footer id="myFooter">
            <div class="w3-container w3-theme-l2 w3-padding-32">
                <h4>Footer</h4>
            </div>

            <div class="w3-container w3-theme-l1">
                <p>Powered by <a href="http://www.kitablar.com/" target="_blank">Kitablar.com</a></p>
            </div>
        </footer>

        <!-- END MAIN -->

    <script>
        // Get the Sidebar
        var mySidebar = document.getElementById("mySidebar");

        // Get the DIV with overlay effect
        var overlayBg = document.getElementById("myOverlay");

        // Toggle between showing and hiding the sidebar, and add overlay effect
        function w3_open() {
            if (mySidebar.style.display === 'block') {
                mySidebar.style.display = 'none';
            } else {
                mySidebar.style.display = 'block';
            }
        }

        // Close the sidebar with the close button
        function w3_close() {
            mySidebar.style.display = "none";
            overlayBg.style.display = "none";
        }
    </script>

</body>
</html>
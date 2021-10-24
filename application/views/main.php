<div class="w3-container w3-padding-64">
    <h1>Kitablar Free Ebooks</h1>
    <h2>Kitablar is a library of free eBook in Azerbaijani, Persian, Turkish and English languages.</h2>
</div>

<div class="w3-container w3-display-container">
    <img class="mySlides" src="images/slide_opds.jpg" style="width:100%">
    <img class="mySlides" src="images/slide_telegram.jpg" style="width:100%">
    <img class="mySlides" src="images/slide_kitablar.jpg" style="width:100%">
    <div class="w3-center w3-container w3-section w3-large w3-text-white w3-display-bottommiddle" style="width:100%">
        <div class="w3-left w3-hover-text-khaki" onclick="plusDivs(-1)">&#10094;</div>
        <div class="w3-right w3-hover-text-khaki" onclick="plusDivs(1)">&#10095;</div>
        <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(1)"></span>
        <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(2)"></span>
        <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(3)"></span>
    </div>
</div>

<script>
    var slideIndex = 1;
    showDivs(slideIndex);

    function plusDivs(n) {
        showDivs(slideIndex += n);
    }

    function currentDiv(n) {
        showDivs(slideIndex = n);
    }

    function showDivs(n) {
        var i;
        var x = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("demo");
        if (n > x.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = x.length
        }
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" w3-white", "");
        }
        x[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " w3-white";
    }
</script>

<div class="w3-row">
    <div class="w3-container w3-center">
        <h2 class="w3-text-teal">New E-books</h2>
        <div class="w3-bar">
            <?php
            foreach ($booklist as $row):
                $link = 'data/books/bk' . $row['id'] . '/coverthumb.jpg';
                if (!file_exists($link)) {
                    $link = '/data/kitab.gif';
                }
                ?>
                <div class="w3-button w3-bar-item w3-block" style="width: 180px;">
                    <a style="text-decoration: none;" href="<?php
                    $link2 = site_url() . 'book/details/' . remove_bracket($row['title']) . '/' . $row['id'];
                    echo $link2;
                    ?>">
                        <img class="w3-border" src="<?php echo base_url($link); ?>" alt="<?php echo $row['title']; ?>">
                        <p><?php echo $row['title']; ?></p>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>

<div class="w3-row">
    <div class=" w3-container w3-center">
        <h2 class="w3-text-teal">Top E-books</h2>
        <div class="w3-bar">
            <?php
            foreach ($topbooklist as $row):
                $link = 'data/books/bk' . $row['id'] . '/coverthumb.jpg';
                if (!file_exists($link)) {
                    $link = '/data/kitab.gif';
                }
                ?>
                <div class="w3-button w3-bar-item w3-block" style="width: 180px;">
                    <a style="text-decoration: none;" href="<?php
                    $link2 = site_url() . 'book/details/' . remove_bracket($row['title']) . '/' . $row['id'];
                    echo $link2;
                    ?>">
                        <img class="w3-border" src="<?php echo base_url($link); ?>" alt="<?php echo $row['title']; ?>">        
                        <p><?php echo $row['title']; ?></p>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
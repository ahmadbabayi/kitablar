<div class="w3-container w3-center">
<div class="w3-bar">
    <?php
    echo anchor('book/language/2', 'Azərbaycan dili', 'id="lang2" class="w3-bar-item w3-button  w3-mobile"');
    echo anchor('book/language/1', 'آذربایجان دیلی', 'id="lang1" class="w3-bar-item w3-button  w3-mobile"');
    echo anchor('book/language/3', 'فارسی', 'id="lang3" class="w3-bar-item w3-button  w3-mobile"');
    echo anchor('book/language/4', 'Türkçe', 'id="lang4" class="w3-bar-item w3-button  w3-mobile"');
    echo anchor('book/language/5', 'English', 'id="lang5" class="w3-bar-item w3-button  w3-mobile"');
    echo anchor('book/language/6', 'other', 'id="lang6" class="w3-bar-item w3-button  w3-mobile"');
    ?>
</div>
<?php
$id = $this->uri->segment(3, 0);
?>
<script>
    var wow = document.getElementById("lang<?php echo $id ?>");
    wow.style.backgroundColor = "#999999";
</script>
</div>
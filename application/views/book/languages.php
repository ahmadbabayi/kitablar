<div class="w3-container" style="padding-top: 80px;">
<div class="w3-bar">
    <?php
    echo anchor('book/language/Azərbaycan dili/2', 'Azərbaycan dili', 'id="lang2" class="w3-bar-item w3-button  w3-mobile"');
    echo anchor('book/language/آذربایجان دیلی/1', 'آذربایجان دیلی', 'id="lang1" class="w3-bar-item w3-button  w3-mobile"');
    echo anchor('book/language/فارسی/3', 'فارسی', 'id="lang3" class="w3-bar-item w3-button  w3-mobile"');
    echo anchor('book/language/Türkçe/4', 'Türkçe', 'id="lang4" class="w3-bar-item w3-button  w3-mobile"');
    echo anchor('book/language/English/5', 'English', 'id="lang5" class="w3-bar-item w3-button  w3-mobile"');
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
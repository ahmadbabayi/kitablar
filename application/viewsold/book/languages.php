<div class="language">
    <ul>
        <li><?php echo anchor('book/language/1', 'آذربایجانجا', 'id="lang1"') ?></li>
        <li><?php echo anchor('book/language/2', 'Azərbaycanca', 'id="lang2"') ?></li>
        <li><?php echo anchor('book/language/3', 'فارسی', 'id="lang3"') ?></li>
        <li><?php echo anchor('book/language/4', 'Türkçe', 'id="lang4"') ?></li>
        <li><?php echo anchor('book/language/5', 'English', 'id="lang5"') ?></li>
        <li><?php echo anchor('book/language/6', 'other', 'id="lang6"') ?></li>
    </ul>
</div>
<?php
$id = $this->uri->segment(3, 0);
?>
<script>
    var wow = document.getElementById("lang<?php echo $id ?>");
    wow.style.backgroundColor = "#999999";
</script>
<div class="w3-container">
    <?php
    if (!empty($categorylist)) {
        ?>
        <div class="w3-bar">
            <?php
            foreach ($categorylist as $cat):
                ?>
                <?php echo anchor('book/language/' . $lang . '/category/' . $cat['id'], $cat['title'], 'id="lang1" class="w3-bar-item w3-button  w3-mobile"'); ?>
            <?php endforeach; ?>
        </div>

        <?php
    }
    ?>
    <div class="w3-bar">
        <?php
        foreach ($booklist as $row):
            $link = './data/books/bk' . $row['id'] . '/coverthumb.jpg';
            if (!file_exists($link)) {
                $link = '/data/kitab.gif';
            }
            ?>
            <a style="float: left; width: 200px; height: 300px;" class="w3-bar-item w3-card w3-button" href="<?php
               $link2 = site_url() . '/book/details/'.$row['title'].'/'.$row['id'];
               echo $link2;
               ?>">
                <img src="<?php echo base_url($link); ?>"><br>
                <?php echo $row['title']; ?>
            </a>
        <?php endforeach; ?>
    </div>
</div>
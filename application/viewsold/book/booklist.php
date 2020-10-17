<?php
if (!empty($categorylist)) {
    ?>
<div class="category"><a id="categorybashtitle">Select category</a>
        <div class="categorylist">
            <ul>
                <?php
                foreach ($categorylist as $cat):
                    ?>
                    <li><?php echo anchor('book/language/' . $lang . '/category/' . $cat['id'], $cat['title'], 'id="lang1"'); ?></li>
                <?php endforeach; ?>
            </ul>

        </div>
    </div>
    <?php
}
?>
<div class="booknumber">
    <p><?php echo $totalrows; ?> E-books in <?php echo $pages; ?> pages.</p>
</div>
<div class="pagination">
    <?php echo $pagination; ?>
</div>
<div>
    <ul class="booklist">
        <?php
        foreach ($booklist as $row):
            $link = 'data/books/bk' . $row['id'] . '/coverthumb.jpg';
            if (!file_exists($link)) {
                $link = '/data/kitab.gif';
            }
            ?>
            <a href="<?php
        $link2 = site_url() . 'book/details/' . $row['id'];
        echo $link2;
            ?>">
                <li><img src="<?php echo base_url($link); ?>"><br>
                    <?php echo $row['title']; ?><br>Author: 
                    <?php echo $row['author']; ?>

                </li></a>
        <?php endforeach; ?>
    </ul>

</div>
<div class="pagination">
    <?php echo $pagination; ?>
</div>



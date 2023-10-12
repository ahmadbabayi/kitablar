<div class="w3-container w3-row">
    <div class="w3-container">
        <h1 class="w3-text-teal">All books</h1>
        <p><?php echo $totalrows; ?> E-books in <?php echo $pages; ?> pages.</p>
    </div>

</div>

<div class="w3-container w3-bar">
    <?php echo $pagination; ?>
</div>

<div class="w3-bar">
    <?php
    foreach ($booklist as $row):
        $link = 'data/books/bk' . $row['id'] . '/coverthumb.jpg';
        if (!file_exists($link)) {
            $link = '/data/kitab.gif';
        }
        ?>
        <a style="float: left; width: 200px; height: 300px;" class="w3-bar-item w3-card w3-button" href="<?php
        $link2 = site_url() . 'book/details/'.$row['title'].'/'.$row['id'];
        echo $link2;
        ?>">
            <img class="w3-border" src="<?php echo base_url($link); ?>" alt="<?php echo $row['title']; ?>"><br>
            <?php echo $row['title']; ?>
        </a>
    <?php endforeach; ?>
</div>

<div class="w3-container w3-bar">
    <?php echo $pagination; ?>
</div>
<div class="w3-row w3-padding-64">
    <div class="w3-container w3-center">
        <h1 class="w3-text-teal">New E-books</h1>
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
                    $link2 = site_url() . 'book/details/' . $row['id'];
                    echo $link2;
                    ?>">
                        <img class="w3-border" src="<?php echo base_url($link); ?>">
                        <p><?php echo $row['title']; ?></p>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>

<div class="w3-row">
    <div class=" w3-container w3-center">
        <h1 class="w3-text-teal">Top E-books</h1>
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
                    $link2 = site_url() . 'book/details/' . $row['id'];
                    echo $link2;
                    ?>">
                        <img class="w3-border" src="<?php echo base_url($link); ?>">        
                        <p><?php echo $row['title']; ?></p>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
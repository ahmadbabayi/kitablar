<div class="w3-container w3-center" style="padding-top: 100px;">
    <div class="w3-bar">
        <?php
        if (isset($_SESSION['username']) && $_SESSION['logged_in'] === true && $this->session->userdata('user_id') == $row['user_id']) {
            echo anchor('member/addbook', 'Add new E-book', 'class="w3-bar-item w3-button w3-mobile"');
            echo anchor('member/editbook/' . $row['id'], 'edit E-book details', 'class="w3-bar-item w3-button w3-mobile"');
            echo anchor('member/send2telegram/' . $row['id'], 'Send to telegram', 'class="w3-bar-item w3-button w3-mobile"');
            echo anchor('member/bookdetails/' . $row['id'], 'book details and file uploads', 'class="w3-bar-item w3-button w3-mobile"');
            ?>
            <a href="<?php echo site_url() . '/member/removebook/' . $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this item?');" class="w3-bar-item w3-button w3-mobile">remove E-book</a>
        </div>
        <?php
    }
    if ($row['language'] == 1 || $row['language'] == 3) {
        $dir = 'rtl';
    } else {
        $dir = 'ltr';
    }
    $link = 'data/books/bk' . $row['id'] . '/cover.jpg';
    if (!file_exists($link)) {
        $link = '/data/kitab.gif';
    }
    ?>
    <h1><?php echo $row['title']; ?></h1>
    <img class="w3-border" style="max-width: 100%; height: auto;" src="<?php echo base_url($link); ?>" alt="<?php echo$row['title']; ?>">
    <ul class="w3-ul w3-card-4">
        <li>Authors: <?php
            if (!empty($authors)) {
                foreach ($authors as $author):
                    $links[] = anchor('book/author/' . remove_bracket($author['author']) . '/' . $author['author_id'], $author['author']);
                endforeach;
                print_r(implode(', ', $links));
            }
            ?></li>
        <li>ISBN: <?php echo $row['isbn']; ?></li>
        <li>Language: <?php echo anchor('book/language/' . $this->lang->line('l' . $row['language']) . '/' . $row['language'], $this->lang->line('l' . $row['language'])); ?></li>
        <li>Viewed: <?php echo $row['hits']; ?></li>
    </ul>
    <div class="w3-panel">
        <p style="direction: <?php echo $dir; ?>">
            <?php echo nl2br($row['description']); ?>
        </p>
    </div>
    <div>
        <?php
        if (!empty($tags)) {
            unset($links);
            foreach ($tags as $tag):
                $links[] = anchor('book/tag/' . remove_bracket($tag['tag']) . '/' . $tag['tag_id'], $tag['tag'], 'class="w3-tag"');
            endforeach;
            print_r(implode(' ', $links));
        }
        ?>
    </div>
    <table class="w3-table w3-border">
        <tr class="w3-green">
            <th>Format</th>
            <th colspan="2">Size</th>
        </tr>
        <?php foreach ($filerow as $item): ?>

            <tr>
                <td>
                    <?php
                    $ext = pathinfo($item['file_name'], PATHINFO_EXTENSION);
                    $ext = strtoupper($ext);
                    echo $ext;
                    ?>

                </td>
                <td>
                    <?php
                    $filename = 'data/books/bk' . $row['id'] . '/' . $item['file_name'];
                    if (file_exists($filename)) {
                        $filesize = get_file_info($filename);
                        $filesize = intval($filesize['size']);
                        echo byte_format($filesize);
                    }
                    ?>
                </td>
                <td><?php echo anchor('book/download/' . $item['id'], 'Download', 'class="w3-button w3-hover-green w3-red"');  echo ' '; if ($ext == 'EPUB'){echo anchor('book/epub/' . $row['id'], 'Read Online', 'class="w3-button w3-hover-green w3-red"');} ?></td>
            </tr>
        <?php endforeach; ?>

    </table>
    <div class="w3-center">
        <h2 class="w3-wide">You may also like</h2>
        <div class="w3-bar">
            <?php
            foreach ($related_books as $row):
                $link = 'data/books/bk' . $row['id'] . '/coverthumb.jpg';
                if (!file_exists($link)) {
                    $link = '/data/kitab.gif';
                }
                ?>
                <div class="w3-button w3-bar-item w3-block" style="width: 180px;">
                    <a style="text-decoration: none;" href="<?php
                    $link2 = site_url() . 'book/details/'.remove_bracket($row['title']).'/'.$row['id'];
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
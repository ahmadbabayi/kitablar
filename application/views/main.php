<div class="w3-container w3-padding-64">
    <h1>Welcome to Kitablar Free Ebooks</h1>
    <h2>Kitablar is a library of free eBook in Azerbaijani, Persian, Turkish and English languages.</h2>
</div>

<div class="w3-row">
    <div class="w3-container w3-center">
        <h2 class="w3-text-teal">Kitablar OPDS catalog</h2>
        <!-- The text field -->
        <input type="text" value="http://kitablar.com/opds" readonly="">
        <p>You can add link into OPDS Browser applications like <a href="https://www.demarque.com/en-aldiko" target="_blank">Aldiko</a>, <a href="https://fbreader.org/" target="_blank">FBReader</a> and ...</p>
        <h3>What is OPDS?</h3>
        <p>The Open Publication Distribution System (OPDS) Catalog format is a syndication format for electronic publications based on Atom and HTTP. OPDS Catalogs enable the aggregation, distribution, discovery, and acquisition of electronic publications. OPDS Catalogs use existing or emergent open standards and conventions, with a priority on simplicity.</p>
    </div>

</div>

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
                    $link2 = site_url() . 'book/details/' . $row['id'];
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
                    $link2 = site_url() . 'book/details/' . $row['id'];
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
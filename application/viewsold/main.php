<div class="content">
    <h1>kitablar book library management system</h1>
    <h2>Welcome</h2>
    <ul>
        <li>Download free E-book in Azerbaijani (Latin &amp; Arab alphabet), Persian, Turkish, English and other languages.</li>
        <li>Upload your E-book freely and put download link in your site &amp; blog.</li>
        <li>Create your E-book online and access your documents from anywhere.</li>
        <li>Download your created E-book in different format of E-book (EPUB, PDF, TXT, HTML).</li>

    </ul>
    <h2>Free Readers</h2>
    <ul>
        <li><b>EPUB: </b><a href="http://fbreader.org/" target="_blank">FBReader</a> - <a href="https://addons.mozilla.org/firefox/addon/epubreader/" target="_blank">Firefox addon EPUBReader</a> - <a href="http://www.aldiko.com/download.html" target="_blank">Aldiko (Android)</a></li>
        <li><b>PDF: </b><a href="https://wiki.gnome.org/Apps/Evince" target="_blank">Evince</a> - <a href="http://www.foxitsoftware.com/downloads/" target="_blank">Foxit Reader</a> - <a href="http://www.aldiko.com/download.html" target="_blank">Aldiko (Android)</a></li>
    </ul>
    <h2>Free Creators</h2>
    <ul>
        <li><b>EPUB: </b><a href="http://code.google.com/p/sigil/" target="_blank">Sigil</a> - <a href="http://www.epubconverter.org/" target="_blank">online EPUB creator</a></li>
        <li><b>PDF: </b><a href="http://www.libreoffice.org/" target="_blank">LibreOffice</a> - <a href="http://pdfcreator.en.softonic.com/" target="_blank">PDFCreator</a></li>
        <li><b>DOC: </b><a href="http://www.libreoffice.org/" target="_blank">LibreOffice</a></li>
    </ul>
    <h2>Language tools</h2>
    <ul>
        <li><?php  echo anchor('main/la2arconvert', 'Online convert Azerbaijan\'s Latin alphabet to Arab alphabet'); ?></li>
    </ul>
</div>
<div class="booklist">
    <h2>New E-books</h2>
    <ul>
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
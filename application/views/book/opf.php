<?php echo '<?xml version=\'1.0\' encoding=\'utf-8\'?>'; ?>
<package xmlns="http://www.idpf.org/2007/opf" unique-identifier="uuid_id" version="2.0">
    <metadata xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:opf="http://www.idpf.org/2007/opf">
        <dc:identifier opf:scheme="calibre" id="calibre_id"><?php echo $row['id']; ?></dc:identifier>
        <dc:title><?php echo $row['title']; ?></dc:title>
        <?php
        foreach ($authors as $author) {
            echo '<dc:creator opf:role="aut">' . $author['author'] . '</dc:creator>'."\n";
        }
        ?>
        <dc:contributor opf:file-as="calibre" opf:role="bkp">calibre (4.99.4) [https://calibre-ebook.com]</dc:contributor>
        <dc:description><?php echo $row['description']; ?></dc:description>
        <dc:language><?php echo $this->lang->line('c' . $row['language']); ?></dc:language>
<?php
        if (!empty($tags)) {
            foreach ($tags as $tag):
                echo '        <dc:subject>' . $tag['tag'] . '</dc:subject>' . "\n";
            endforeach;
        }
?>
    </metadata>
    <guide>
        <reference type="cover" title="Cover" href="cover.jpg"/>
    </guide>
</package>
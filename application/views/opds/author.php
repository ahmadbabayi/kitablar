<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<feed xmlns="http://www.w3.org/2005/Atom" xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns:opds="http://opds-spec.org/2010/catalog" xmlns:opensearch="http://a9.com/-/spec/opensearch/1.1/" xmlns:dcterms="http://purl.org/dc/terms/">
    <title>Alexandre Dumas</title>
    <id>cops:authors:5</id>
    <updated>2021-09-27T18:12:32+02:00</updated>
    <icon>favicon.ico</icon>
    <author>
        <name>ahmadbabayi</name>
        <uri>http://kitablar.com</uri>
    </author>

    <link href="<?php echo base_url('opds'); ?>" type="application/atom+xml;profile=opds-catalog;kind=navigation" rel="start" title="Home"/>
    <link href="<?php echo base_url('opds/author/' . $id); ?>" type="application/atom+xml;profile=opds-catalog;kind=navigation" rel="self"/>
    <link href="<?php echo base_url('opds/search'); ?>" type="application/opensearchdescription+xml" rel="search" title="Search here"/>

    <?php
    foreach ($list as $value) {
        $link = 'data/books/bk' . $value['id'] . '/cover.jpg';
        $link2 = 'data/books/bk' . $value['id'] . '/coverthumb.jpg';
        if (!file_exists($link)) {
            $link = '/data/kitab.jpg';
            $link2 = '/data/kitab.jpg';
        }
        echo '    <entry>'."\n";
        echo '        <title>' . remove_bracket($value['title']) . '</title>'."\n";
        echo '        <updated>2021-09-27T18:12:32+02:00</updated>'."\n";
        echo '        <id>urn:uuid:6c9b800c-4cda-49ba-a110-82d8fafb2c48</id>'."\n";
        echo '        <content type="text/html">123</content>'."\n";
        echo '        <link href="'.base_url($link).'" type="image/jpeg" rel="http://opds-spec.org/image"/>'."\n";
        echo '        <link href="'.base_url($link2).'" type="image/jpeg" rel="http://opds-spec.org/image/thumbnail"/>'."\n";
        echo '        <link href="download/14/Twenty%20Years%20After%20-%20Alexandre%20Dumas.epub" type="application/epub+zip" rel="http://opds-spec.org/acquisition" title="EPUB"/>'."\n";
        echo '        <link href="feed.php?page=3 - id=5" type="application/atom+xml;profile=opds-catalog;kind=navigation" rel="related" title="Other books by Alexandre Dumas"/>'."\n";
        echo '        <link href="feed.php?page=7 - id=3" type="application/atom+xml;profile=opds-catalog;kind=navigation" rel="related" title="Book 1.0 in the D\'Artagnan Romances series"/>'."\n";
        echo '        <author>'."\n";
        echo '            <name>Alexandre Dumas</name>'."\n";
        echo '            <uri>feed.php?page=3 - id=5</uri>'."\n";
        echo '        </author>'."\n";
        echo '        <dcterms:language>'.$this->lang->line('l' . $value['language']).'</dcterms:language>'."\n";
        echo '    </entry>'."\n";
    }
    ?>
</feed>
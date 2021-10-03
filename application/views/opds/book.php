<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<feed xmlns="http://www.w3.org/2005/Atom" xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns:opds="http://opds-spec.org/2010/catalog" xmlns:opensearch="http://a9.com/-/spec/opensearch/1.1/" xmlns:dcterms="http://purl.org/dc/terms/">
    <title>Book details</title>
    <id>kitablar:book:<?php echo $value['id']; ?></id>
    <updated>2021-09-27T18:12:32+02:00</updated>
    <author>
        <name>ahmadbabayi</name>
        <uri><?php echo base_url(); ?></uri>
    </author>

    <link href="<?php echo base_url('opds'); ?>" type="application/atom+xml;profile=opds-catalog;kind=navigation" rel="start" title="Home"/>
    <link href="<?php echo base_url('opds/book/' . $value['id']); ?>" type="application/atom+xml;profile=opds-catalog;kind=navigation" rel="self"/>
    <link href="<?php echo base_url('opds/search'); ?>" type="application/opensearchdescription+xml" rel="search" title="Search here"/>

    <?php
    $link = 'data/books/bk' . $value['id'] . '/cover.jpg';
    $link2 = 'data/books/bk' . $value['id'] . '/coverthumb.jpg';
    if (!file_exists($link)) {
        $link = '/data/kitab.jpg';
        $link2 = '/data/kitab.jpg';
    }
    echo '    <entry>' . "\n";
    echo '        <title>' . remove_bracket($value['title']) . '</title>' . "\n";
    echo '        <updated>2021-09-27T18:12:32+02:00</updated>' . "\n";
    echo '        <id>urn:uuid:'. getuid('kitablar:book:'.$value['id']).'</id>' . "\n";
    echo '        <content type="text/html">' . strip_tags(remove_bracket($value['description'])) . '</content>' . "\n";
    echo '        <link rel="http://opds-spec.org/image" href="' . base_url($link) . '" type="image/jpeg" />' . "\n";
    echo '        <link rel="http://opds-spec.org/image/thumbnail" href="' . base_url($link2) . '" type="image/jpeg" />' . "\n";
    echo '        <link rel="self" href="'.base_url('opds/book/' . $value['id']).'" type="application/atom+xml;type=entry;profile=opds-catalog"/>' . "\n";
    foreach ($filerow as $item) {
        $ext = pathinfo($item['file_name'], PATHINFO_EXTENSION);
        $ext = strtoupper($ext);
        $filename = 'data/books/bk' . $value['id'] . '/' . $item['file_name'];
        echo '        <link rel="http://opds-spec.org/acquisition" href="'.base_url($filename) .'" type="'. mime_content_type($filename).'" title="'.$ext.'" />' . "\n";
    }
    if (!empty($authors)) {
        foreach ($authors as $author):
            echo '        <author>' . "\n";
            echo '            <name>' . remove_bracket($author['author']) . '</name>' . "\n";
            echo '            <uri>' . base_url('opds/author/' . $author['author_id']) . '</uri>' . "\n";
            echo '        </author>' . "\n";
        endforeach;
    }
    if (!empty($tags)) {
        foreach ($tags as $tag):
            echo '        <category term="' . remove_bracket($tag['tag']) . '" label="' . remove_bracket($tag['tag']) . '"/>' . "\n";
        endforeach;
    }
    echo '        <dcterms:language>' . $this->lang->line('l' . $value['language']) . '</dcterms:language>' . "\n";
    echo '    </entry>' . "\n";
    ?>
</feed>
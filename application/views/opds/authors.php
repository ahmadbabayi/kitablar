<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<feed xmlns:app="http://www.w3.org/2007/app" xmlns:dcterms="http://purl.org/dc/terms/" xmlns:opds="http://opds-spec.org/" xmlns:opensearch="http://a9.com/-/spec/opensearch/1.1/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:thr="http://purl.org/syndication/thread/1.0" xmlns="http://www.w3.org/2005/Atom">
    <title>Authors</title>
    <id>kitablar:authors:</id>
    <updated>2021-09-27T17:34:34+02:00</updated>
    <link rel="self" href="<?php echo base_url('opds'); ?>" type="application/atom+xml;profile=opds-catalog;kind=navigation"/>
    <link rel="start" href="<?php echo base_url('opds/author'); ?>" type="application/atom+xml;profile=opds-catalog;kind=navigation"/>
    <link rel="search" href="<?php echo base_url('opds/search'); ?>" type="application/opensearchdescription+xml"/>
    <author>
        <name>ahmadbabayi</name>
        <uri><?php echo base_url(); ?></uri>
    </author>
    
    <?php 
    foreach ($list as $value) {
        echo '    <entry>'."\n";
        echo '        <title>'.remove_bracket($value['author']).'</title>'."\n";
        echo '        <updated>2021-09-27T17:34:34+02:00</updated>'."\n";
        echo '        <id>kitablar:author:'.$value['id'].'</id>'."\n";
        echo '        <link href="'. base_url('opds/author/'.$value['id']).'" type="application/atom+xml;profile=opds-catalog;kind=navigation"/>'."\n";
        echo '        <link href="'.base_url('images/author.png').'" type="image/png" rel="http://opds-spec.org/image/thumbnail"/>'."\n";
        echo '    </entry>'."\n";
    }
    ?>
</feed>
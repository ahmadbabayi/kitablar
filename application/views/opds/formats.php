<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<feed xmlns="http://www.w3.org/2005/Atom" xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns:opds="http://opds-spec.org/2010/catalog" xmlns:opensearch="http://a9.com/-/spec/opensearch/1.1/" xmlns:dcterms="http://purl.org/dc/terms/">
    <title>Formats</title>
    <id>kitablar:formats:</id>
    <updated>2021-09-27T17:34:34+02:00</updated>
    <author>
        <name>ahmadbabayi</name>
        <uri><?php echo base_url(); ?></uri>
    </author>

    <link href="<?php echo base_url('opds'); ?>" type="application/atom+xml;profile=opds-catalog;kind=navigation" rel="start" title="Home"/>
    <link href="<?php echo base_url('opds/format'); ?>" type="application/atom+xml;profile=opds-catalog;kind=navigation" rel="self"/>
    <link href="<?php echo base_url('opds/search'); ?>" type="application/opensearchdescription+xml" rel="search" title="Search here"/>
    
    <?php 
    foreach ($list as $value) {
        echo '    <entry>'."\n";
        echo '        <title>'.remove_bracket($value['format']).'</title>'."\n";
        echo '        <updated>2021-09-27T17:34:34+02:00</updated>'."\n";
        echo '        <id>kitablar:format:'.$value['format'].'</id>'."\n";
        echo '        <link href="'. base_url('opds/format/'.$value['format']).'" type="application/atom+xml;profile=opds-catalog;kind=navigation"/>'."\n";
        echo '        <link href="'.base_url('images/format.png').'" type="image/png" rel="http://opds-spec.org/image/thumbnail"/>'."\n";
        echo '    </entry>'."\n";
    }
    ?>
</feed>
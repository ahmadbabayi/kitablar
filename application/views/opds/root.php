<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<feed xmlns="http://www.w3.org/2005/Atom" xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns:opds="http://opds-spec.org/2010/catalog" xmlns:opensearch="http://a9.com/-/spec/opensearch/1.1/" xmlns:dcterms="http://purl.org/dc/terms/">
    <title>Kitablar OPDS</title>
    <id>urn:uuid:2853dacf-ed79-42f5-8e8a-a7bb3d1ae6a2</id>
    <updated>2021-09-27T17:04:41+02:00</updated>
    <link rel="self" href="<?php echo base_url('opds'); ?>" type="application/atom+xml;profile=opds-catalog;kind=navigation"/>
    <link rel="start" href="<?php echo base_url('opds'); ?>" type="application/atom+xml;profile=opds-catalog;kind=navigation"/>
    <link rel="search" href="<?php echo base_url('opds/search'); ?>" type="application/opensearchdescription+xml"  title="Search here"/>
    <icon><?php echo base_url('favicon.ico'); ?></icon>
    <author>
        <name>Ahmad Babayi</name>
        <uri>http://kitablar.com</uri>
    </author>

    <entry>
        <title>Authors</title>
        <link href="<?php echo base_url('images/author.png'); ?>" type="image/png" rel="http://opds-spec.org/image/thumbnail"/>
        <link href="<?php echo base_url('opds/author'); ?>" type="application/atom+xml;profile=opds-catalog;kind=navigation"/>
        <updated>2021-01-10T10:01:01Z</updated>
        <id>urn:uuid:d49e8018-a0e0-499e-9423-7c175fa0c56e</id>
        <content type="text">Author list sorted alphabetical.</content>
    </entry>
    
    <entry>
        <title>Languages</title>
        <link href="<?php echo base_url('images/language.png'); ?>" type="image/png" rel="http://opds-spec.org/image/thumbnail"/>
        <link href="<?php echo base_url('opds/language'); ?>" type="application/atom+xml;profile=opds-catalog;kind=navigation"/> 
        <updated>2021-01-10T10:02:00Z</updated>
        <id>urn:uuid:d49e8018-a0e0-499e-9423-7c175fa0c56c</id>
        <content type="text">Alphabetical index of the single language.</content>
    </entry>
    
    <entry>
        <title>Formats</title>
        <link href="<?php echo base_url('images/format.png'); ?>" type="image/png" rel="http://opds-spec.org/image/thumbnail"/>
        <link href="<?php echo base_url('opds/format'); ?>" type="application/atom+xml;profile=opds-catalog;kind=navigation"/>
        <updated>2021-01-10T10:02:00Z</updated>
        <id>urn:uuid:d49e8018-a0e0-499e-9423-7c175fa0c58c</id>
        <content type="text">Book format PDF, Epub, Doc, APK, ...</content>
    </entry>
    <entry>
        <title>Tags</title>
        <link href="<?php echo base_url('images/tag.png'); ?>" type="image/png" rel="http://opds-spec.org/image/thumbnail"/>
        <link href="<?php echo base_url('opds/tag'); ?>" type="application/atom+xml;profile=opds-catalog;kind=navigation"/>
        <updated>2021-01-10T10:02:00Z</updated>
        <id>urn:uuid:d49e8018-a0e0-499e-9423-7c175fa0c59c</id>
        <content type="text">Alphabetical index of the tags.</content>
    </entry>
    <entry>
        <title>All books</title>
        <link href="<?php echo base_url('images/allbook.png'); ?>" type="image/png" rel="http://opds-spec.org/image/thumbnail"/>
        <link href="<?php echo base_url('opds/book'); ?>" type="application/atom+xml;profile=opds-catalog;kind=navigation"/>
        <updated>2021-01-10T10:02:00Z</updated>
        <id>urn:uuid:d49e8018-a0e0-499e-9423-7c175fa0c59d</id>
        <content type="text">Alphabetical index of the books.</content>
    </entry>
</feed>
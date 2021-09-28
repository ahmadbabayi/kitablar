<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<feed xmlns="http://www.w3.org/2005/Atom" xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns:opds="http://opds-spec.org/2010/catalog" xmlns:opensearch="http://a9.com/-/spec/opensearch/1.1/" xmlns:dcterms="http://purl.org/dc/terms/">
    <title>Languages</title>
    <id>kitablar:languages:</id>
    <updated>2021-09-27T17:34:34+02:00</updated>
    <icon>favicon.ico</icon>
    <author>
        <name>ahmadbabayi</name>
        <uri>http://kitablar.com</uri>
    </author>

    <link href="<?php echo base_url('opds'); ?>" type="application/atom+xml;profile=opds-catalog;kind=navigation" rel="start" title="Home"/>
    <link href="<?php echo base_url('opds/language'); ?>" type="application/atom+xml;profile=opds-catalog;kind=navigation" rel="self"/>
    <link href="<?php echo base_url('opds/search'); ?>" type="application/opensearchdescription+xml" rel="search" title="Search here"/>

    <entry>
        <title>Azərbaycan dili</title>
        <updated>2021-09-27T17:34:34+02:00</updated>
        <id>kitablar:language:2</id>
        <link href="<?php echo base_url('opds/language/2'); ?>" type="application/atom+xml;profile=opds-catalog;kind=navigation"/>
        <link href="<?php echo base_url('images/language.png'); ?>" type="image/png" rel="http://opds-spec.org/image/thumbnail"/>
    </entry>
    <entry>
        <title>آذربایجان دیلی</title>
        <updated>2021-09-27T17:34:34+02:00</updated>
        <id>kitablar:language:1</id>
        <link href="<?php echo base_url('opds/language/1'); ?>" type="application/atom+xml;profile=opds-catalog;kind=navigation"/>
        <link href="<?php echo base_url('images/language.png'); ?>" type="image/png" rel="http://opds-spec.org/image/thumbnail"/>
    </entry>
    <entry>
        <title>فارسی</title>
        <updated>2021-09-27T17:34:34+02:00</updated>
        <id>kitablar:language:3</id>
        <link href="<?php echo base_url('opds/language/3'); ?>" type="application/atom+xml;profile=opds-catalog;kind=navigation"/>
        <link href="<?php echo base_url('images/language.png'); ?>" type="image/png" rel="http://opds-spec.org/image/thumbnail"/>
    </entry>
    <entry>
        <title>Türkçe</title>
        <updated>2021-09-27T17:34:34+02:00</updated>
        <id>kitablar:language:4</id>
        <link href="<?php echo base_url('opds/language/4'); ?>" type="application/atom+xml;profile=opds-catalog;kind=navigation"/>
        <link href="<?php echo base_url('images/language.png'); ?>" type="image/png" rel="http://opds-spec.org/image/thumbnail"/>
    </entry>
    <entry>
        <title>English</title>
        <updated>2021-09-27T17:34:34+02:00</updated>
        <id>kitablar:language:5</id>
        <link href="<?php echo base_url('opds/language/5'); ?>" type="application/atom+xml;profile=opds-catalog;kind=navigation"/>
        <link href="<?php echo base_url('images/language.png'); ?>" type="image/png" rel="http://opds-spec.org/image/thumbnail"/>
    </entry>
</feed>
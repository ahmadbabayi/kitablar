<?php echo '<?xml version=\'1.0\' encoding=\'utf-8\'?>'; ?>
<package xmlns="http://www.idpf.org/2007/opf" unique-identifier="uuid_id" version="2.0">
    <metadata xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:opf="http://www.idpf.org/2007/opf">
        <dc:identifier opf:scheme="calibre" id="calibre_id">95</dc:identifier>
        <dc:identifier opf:scheme="uuid" id="uuid_id">9d716567-9ba8-4073-bd7a-931e69cc046d</dc:identifier>
        <dc:title><?php echo $title; ?></dc:title>
        <dc:creator opf:file-as="Dostoyevski, Fyodor" opf:role="aut"><?php echo $author; ?></dc:creator>
        <dc:contributor opf:file-as="calibre" opf:role="bkp">calibre (4.99.4) [https://calibre-ebook.com]</dc:contributor>
        <dc:description><?php echo $description; ?></dc:description>
        <dc:language><?php echo $languge; ?></dc:language>
        <dc:subject>Dünya ədəbiyyatı</dc:subject>
        <dc:subject>roman</dc:subject>
    </metadata>
    <guide>
        <reference type="cover" title="Cover" href="<?php echo $cover; ?>"/>
    </guide>
</package>
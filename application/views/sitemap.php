<?php echo '<?xml version="1.0" encoding="utf-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
<url><loc>https://kitablar.com</loc></url>
<url><loc>https://kitablar.com/author</loc></url>
<?php
foreach ($authors as $value) {
    echo '<url><loc>https://kitablar.com/book/author/';
    echo remove_bracket($value['author']);
    echo '/';
    echo $value['id'];
    echo '</loc></url>'."\n";
}
?>
<url><loc>https://kitablar.com/language</loc></url>
<url><loc>https://kitablar.com/book/language/Azərbaycan/2</loc></url>
<url><loc>https://kitablar.com/book/language/English/5</loc></url>
<url><loc>https://kitablar.com/book/language/Türkçe/4</loc></url>
<url><loc>https://kitablar.com/book/language/آذربایجان/1</loc></url>
<url><loc>https://kitablar.com/book/language/فارسی/3</loc></url>
<url><loc>https://kitablar.com/format</loc></url>
<?php 
foreach ($formatlist as $value) {
    echo '<url><loc>https://kitablar.com/format/ext/';
    echo $value['format'];
    echo '</loc></url>'."\n";
}

?>
<url><loc>https://kitablar.com/contactus</loc></url>
<url><loc>https://kitablar.com/book</loc></url>
<?php
foreach ($booklist as $value) {
    echo '<url><loc>https://kitablar.com/book/details/';
    echo remove_bracket($value['title']);
    echo '/';
    echo $value['id'];
    echo '</loc></url>'."\n";
}
?>
<url><loc>https://kitablar.com/tag</loc></url>
<?php
foreach ($taglist as $value) {
    echo '<url><loc>https://kitablar.com/book/tag/';
    echo remove_bracket($value['tag']);
    echo '/';
    echo $value['id'];
    echo '</loc></url>'."\n";
}
?>
<url><loc>https://kitablar.com/user/login</loc></url>
<url><loc>https://kitablar.com/user/register</loc></url>

</urlset>
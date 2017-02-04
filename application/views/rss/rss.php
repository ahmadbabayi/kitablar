<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0">
    <channel>
        <title>kitablar RSS feed</title>
        <link>http://www.mywebsite.com/</link>
        <description>This is an example RSS feed</description>
        <language>en-us</language>
        <copyright>Copyright (C) 2009 mywebsite.com</copyright>
        <?php
        foreach ($booklist as $row):
            ?>
            <item>
                <title><?php echo $row['title'];  ?></title>
                <description><?php echo $row['description'];  ?></description>
                <link>http://www.kitablar.com/book/details/<?php echo $row['id'] ?></link>
                <pubDate><?php echo standard_date('DATE_W3C', $row['date']); ?></pubDate>
            </item>
        <?php endforeach; ?>
    </channel>
</rss>
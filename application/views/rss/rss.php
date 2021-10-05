<?php  echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n"; ?>
<rss version="2.0">
    <channel>
        <title>kitablar RSS feed</title>
        <link>http://www.kitablar.com/</link>
        <description>This is kitablar RSS feed</description>
        <language>en-us</language>
        <copyright>Copyright (C) 2017 kitablar.com</copyright>
        <?php
        foreach ($booklist as $row):
            ?>
            <item>
                <title><?php echo $row['title'];  ?></title>
                <description><?php echo $row['description'];  ?></description>
                <link>https://kitablar.com/book/details/<?php echo $row['title'].'/'.$row['id'] ?></link>
                <pubDate><?php echo standard_date('DATE_W3C', $row['date']); ?></pubDate>
            </item>
        <?php endforeach; ?>
    </channel>
</rss>
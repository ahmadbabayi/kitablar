<div>
    <ul class="booklist">
        <?php foreach ($booklist as $row):
            $link = './data/books/bk'.$row['id'].'/coverthumb.jpg';
        if (!file_exists($link))
        {
            $link = '/data/kitab.gif';
        }
            ?>
        <a href="<?php
        $link2 = site_url().'/book/details/'.$row['id'];
        echo $link2; 
        ?>">
        <li><img src="<?php echo base_url($link); ?>"><br>
        <?php echo $row['title']; ?><br>Author: 
        <?php echo $row['author']; ?>
        
</li></a>
<?php endforeach; ?>
    </ul>

</div>



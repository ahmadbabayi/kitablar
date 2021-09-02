<hr>
<div class="w3-container">
    <ul class="w3-ul">
        <?php
        $zip = new ZipArchive;
        
        foreach ($filelist as $row): ?>
        <li>   
            <?php
            $filename = 'data/books/bk' . $row['book_id'] . '/' . $row['file_name'];
            if (pathinfo($filename, PATHINFO_EXTENSION) == 'zip') 
            {
                echo anchor('admin/bookdetails/'.$row['id'], $row['file_name']);
                $res = $zip->open($filename);
                $extractpath = 'data/books/bk' . $row['book_id'] . '/';
               // Extract file
               $zip->extractTo($extractpath);
               $zip->close();
            }
            
            ?>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
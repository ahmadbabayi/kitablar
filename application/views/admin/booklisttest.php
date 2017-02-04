
    <ul>
        <?php foreach ($booklist as $row): ?>
        <li>   
            <?php echo anchor('admin/editbook/'.$row['id'], $row['title']); ?>
        </li>
        <?php endforeach; ?>
    </ul>
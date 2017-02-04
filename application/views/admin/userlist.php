<div class="memberbookadd">
    <ul>
        <li><?php echo anchor('admin/useradd', 'Add new user') ?></li>
    </ul>
</div>
<div class="memberbooklist">
    <ul>
        <?php foreach ($booklist as $row): ?>
        <li>   
            <?php echo anchor('admin/userdetails/'.$row['id'], $row['username']); ?>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
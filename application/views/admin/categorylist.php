<div class="memberbookadd">
    <ul>
        <li><?php echo anchor('admin/categoryadd', 'Add new category') ?></li>
    </ul>
</div>
<div class="memberbooklist">
    <ul>
        <?php foreach ($booklist as $row): ?>
        <li>   
            <?php echo anchor('admin/categorydetails/'.$row['id'], $row['tag']); ?>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
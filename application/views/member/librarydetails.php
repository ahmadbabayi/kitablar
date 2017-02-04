<div class="memberbookadd">
    <ul>
        <li><?php echo anchor('member/booklibrary', 'back'); ?></li>
        <li><?php echo anchor('book/library/'.$id, 'Add E-book to this library'); ?></li>
    </ul>
</div>
<div class="memberbooklist">
    <ul>
        <?php foreach ($booklist as $row): ?>
        <li>   
            <?php echo anchor('book/details/'.$row['id'], $row['title']); ?>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
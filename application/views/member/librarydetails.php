<div class="w3-container">
<div>
    <ul class="w3-ul">
        <li><?php echo anchor('member/booklibrary', 'back'); ?></li>
        <li><?php echo anchor('book/library/'.$id, 'Add E-book to this library'); ?></li>
    </ul>
</div>
<div>
    <ul class="w3-ul">
        <?php foreach ($booklist as $row): ?>
        <li>   
            <?php echo anchor('book/details/'.$row['id'], $row['title']); ?>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
</div>
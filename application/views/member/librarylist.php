<div class="memberbookadd">
    <ul>
        <li><?php echo anchor('member/addlibrary', 'Create new library') ?></li>
    </ul>
</div>
<div class="memberbooklist">
    <ul>
        <?php foreach ($booklist as $row): ?>
        <li>   
            <?php echo anchor('member/librarydetails/'.$row['id'], $row['title']); ?>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
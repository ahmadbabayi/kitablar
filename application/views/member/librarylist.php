<div class="w3-container">
    <div>
        <ul class="w3-ul">
            <li><?php echo anchor('member/addlibrary', 'Create new library') ?></li>
        </ul>
    </div>
    <div>
        <ul class="w3-ul">
            <?php foreach ($booklist as $row): ?>
                <li>   
                    <?php echo anchor('member/librarydetails/' . $row['id'], $row['title']); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
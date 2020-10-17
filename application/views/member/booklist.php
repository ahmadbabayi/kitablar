<div class="w3-container">
    <div>
        <ul class="w3-ul">
            <li><?php echo anchor('member/addbook', 'Add new E-book') ?></li>
            <li><?php echo anchor('main/la2arconvert', 'convert Azerbaijan\'s Latin alphabet to Arab alphabet') ?></li>
        </ul>
        <p> you have <?php echo $totalrows; ?> number of E-books!</p>
    </div>
    <div>
        <ul class="w3-ul">
            <?php foreach ($booklist as $row): ?>
                <li>   
                    <?php echo anchor('member/bookdetails/' . $row['id'], $row['title']); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
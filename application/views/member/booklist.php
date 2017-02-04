<div class="memberbookadd">
    <ul>
        <li><?php echo anchor('member/addbook', 'Add new E-book') ?></li>
    </ul>
<p> you have <?php echo $totalrows; ?> number of E-books!</p>
</div>
<div class="memberbooklist">
    <ul>
        <?php foreach ($booklist as $row): ?>
        <li>   
            <?php echo anchor('member/bookdetails/'.$row['id'], $row['title']); ?>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
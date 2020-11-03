<div class="w3-container">
    <div>
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
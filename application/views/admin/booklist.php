<hr>
<div class="w3-container">
    <ul class="w3-ul">
        <?php foreach ($booklist as $row): ?>
        <li>   
            <?php echo anchor('admin/bookdetails/'.$row['id'], $row['title']); ?>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
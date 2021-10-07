<div class="w3-container">
    <ul class="w3-ul">
        <?php foreach ($booklist as $row): ?>
        <li><?php echo 'User id: '.$row['user_id'].'<br>username: '.$row['username'].'<br>Phone: '.$row['phone'].'<br>E-mail: '.$row['email'].'<br>Message: '.$row['message'].'<br>IP:'.$row['ip'].'<br>Date: '.standard_date('DATE_W3C', $row['date']).'<br>'.anchor('admin/contactremove/'.$row['id'], 'Delete'); ?></li>
        <?php endforeach; ?>
    </ul>
</div>
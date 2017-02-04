<div class="memberbooklist">
    <ul>
        <?php foreach ($booklist as $row): ?>
        <li><?php echo 'User id: '.$row['user_id'].'<br>username: '.$row['username'].'<br>Subject: '.$row['subject'].'<br>E-mail: '.$row['email'].'<br>Message: '.$row['contacttext'].'<br>IP:'.$row['ip'].'<br>Date: '.standard_date('DATE_W3C', $row['date']).'<br>'.anchor('admin/contactremove/'.$row['id'], 'Delete'); ?></li>
        <?php endforeach; ?>
    </ul>
</div>
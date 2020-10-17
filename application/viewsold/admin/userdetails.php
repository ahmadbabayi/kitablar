<div class="memberbookadd">
    <ul>
        <li><?php echo anchor('admin/userlist/', 'back'); ?></li>
        <li><?php echo anchor('admin/useredit/' . $row['id'], 'edit user'); ?></li>
        <li><a href="<?php echo site_url() . '/admin/userremove/' . $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this item?');">remove user</a></li>
    </ul>
</div>
<div class="membermain">

    <table>
        <tr>
            <td>Username: </td><td><?php echo $row['username']; ?></td>
        </tr>
        <tr>
            <td>Email: </td><td><?php echo $row['email']; ?></td>
        </tr>
        <tr>
            <td>date : </td><td><?php
                $format = 'DATE_W3C';
                $time = $row['created_at'];
                echo standard_date($format, $time);
                ?></td>
        </tr>
    </table>

</div>
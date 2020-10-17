<div class="memberbookadd">
    <ul>
        <li><?php echo anchor('admin/categorylist/', 'back'); ?></li>
        <li><?php echo anchor('admin/categoryedit/' . $row['id'], 'edit category'); ?></li>
        <li><a href="<?php echo site_url() . '/admin/categoryremove/' . $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this item?');">remove category</a></li>
    </ul>
</div>
<div class="membermain">

    <table>
        <tr>
            <td>Category name: </td><td><?php echo $row['title']; ?></td>
        </tr>
        <tr>
            <td>description: </td><td><?php echo $row['description']; ?></td>
        </tr>
    </table>

</div>
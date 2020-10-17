<?php
echo validation_errors();
?>
<div class="memberbookadd">
    <ul>
        <li><?php echo anchor('admin/userdetails/'. $row['id'], 'back'); ?></li>
    </ul>
</div>
<?php echo form_open('admin/userediting'); ?>
<input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
<table class="memberedit">
    <tr>
        <td>user name</td><td><input type="text" name="username" value="<?php echo $row['username']; ?>" /></td>
    </tr>
    <tr>
        <td>email</td><td><input type="text" name="email" value="<?php echo $row['email']; ?>" /></td>
    </tr>
    <tr>
        <td>password</td><td><input type="password" name="password" /></td>
    </tr>

</table>
<div><input type="submit" value="Submit" /></div>

</form>
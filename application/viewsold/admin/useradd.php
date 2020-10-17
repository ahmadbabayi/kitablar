<br>
<br>
<?php
echo validation_errors();
?>
<div class="memberbookadd">
    <a href="javascript:history.go(-1)">Back</a>
</div>

<?php echo form_open_multipart('admin/useradding'); ?>
<input type="hidden" name="type" value="1" />
<table>
    <tr>
        <td>User name</td><td><input type="text" name="username"></td>
    </tr>
    <tr>
        <td>Email</td><td><input type="text" name="email"></td>
    </tr>
    <tr>
        <td>Password</td><td><input type="password" name="password"></td>
    </tr>
</table>
<div><input type="submit" value="Submit" /></div>

</form>
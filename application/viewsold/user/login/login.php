<div class="content">
    <?php
    echo validation_errors();
    echo form_open();
    if (!empty($errormatn))
    {
        echo $errormatn;
    }
    ?>
    <h1>Login</h1>
    <table>
        <tr>
            <td>Username:</td>
            <td><input type="text" name="username" required="" placeholder="Your username"></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><input type="password" class="form-control" name="password" required="" placeholder="Your password"></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="Login"></td>
        </tr>
    </table>
</form>
<div class="memberbookadd">
    <?php echo anchor('user/register', 'Register'); ?>
</div>
</div>
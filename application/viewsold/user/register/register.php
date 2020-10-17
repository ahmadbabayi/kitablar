<div class="content">
    <?php
    echo validation_errors();
    echo form_open('user/registering');
    ?>
    <h1>Register</h1>
    <table>
        <tr>
            <td>Username: </td>
            <td><input type="text" name="username" required="" placeholder="Enter a username"></td>
        </tr>
        <tr>
            <td>Email: </td>
            <td><input type="text" name="email" required="" placeholder="Enter your email"></td>
        </tr>
        <tr>
            <td>Password: </td>
            <td><input type="password" name="password" required="" placeholder="Enter your password"></td>
        </tr>
        <tr>
            <td>Confirm password: </td>
            <td><input type="password" name="password_confirm" required="" placeholder="Confirm your password"></td>
        </tr>
        <tr>
            <td><?php echo $captcha; ?></td>
            <td><input type="text" name="captcha" required="" placeholder="Enter word"></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="Register"></td>
        </tr>
    </table>
</form>
</div>
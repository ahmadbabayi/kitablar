<div class="w3-container">
    <div class="w3-center" style="width: 300px; margin: auto;">
        <h1>Contact Us</h1>
        <?php
        echo validation_errors();
        echo form_open('contactus/contactingus');
        ?>
        <table class="w3-table w3-border">
            <tr>
                <td>name: </td>
                <td><input type="text" name="name" required="" /></td>
            </tr>
            <tr>
                <td>subject: </td>
                <td><input type="text" name="subject" required="" /></td>
            </tr>
            <tr>
                <td>E-mail: </td>
                <td><input type="text" name="email" /></td>
            </tr>
            <tr>
                <td>Message:</td>
                <td><textarea name="message" required=""></textarea></td>
            </tr>
        </table>
        <div><input type="submit" value="Submit" /></div>

        </form>
        </div>
        <p>&nbsp;</p>
</div>
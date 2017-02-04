<div class="contactus">
<?php
echo validation_errors();
echo form_open('contactus/contactingus');

?>
    <h1>Contact Us</h1>
<table>
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

<div class="contactus"><?php
echo validation_errors();
echo form_open('contactus/submitingbook');

?>
    <h1>Submit E-book</h1>
<table>
    <tr>
        <td>your name: </td>
        <td><input type="text" name="name" /></td>
    </tr>
    <tr>
        <td>your email: </td>
        <td><input type="text" name="email" /></td>
    </tr>
    <tr>
        <td>E-book title: </td>
        <td><input type="text" name="title" /></td>
    </tr>
    <tr>
        <td>Ebook download link: </td>
        <td><input type="text" name="link" /></td>
    </tr>
    <tr>
        <td>Description: </td>
        <td><textarea name="description"></textarea></td>
    </tr>
</table>
<div><input type="submit" value="Submit" /></div>
</form>
</div>
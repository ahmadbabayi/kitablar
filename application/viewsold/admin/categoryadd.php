<br>
<br>
<?php
echo validation_errors();
?>
<div class="memberbookadd">
    <a href="javascript:history.go(-1)">Back</a>
</div>

<?php echo form_open_multipart('admin/categoryadding'); ?>
<table>
    <tr>
        <td>category name</td><td><input type="text" name="title"></td>
    </tr>
    <tr>
        <td>description</td><td><input type="text" name="description"></td>
    </tr>
    <tr><td>Language</td><td>
            <select name="lang">
                <option value="0" selected="selected">Select language</option>
                <option value="1">آذربایجانجا</option>
                <option value="2">Azərbaycanca</option>
                <option value="3">فارسی</option>
                <option value="4">Türkçe</option>
                <option value="5">English</option>
                <option value="6">Other</option>
            </select>
        </td>
    </tr>
</table>
<div><input type="submit" value="Submit" /></div>

</form>
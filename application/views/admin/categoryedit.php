<?php
echo validation_errors();
?>
<div class="memberbookadd">
    <ul>
        <li><?php echo anchor('admin/categorydetails/' . $row['id'], 'back'); ?></li>
    </ul>
</div>
<?php echo form_open('admin/categoryediting'); ?>
<input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
<input type="hidden" name="lang_code" value="<?php echo $row['language_id']; ?>" />
<table class="memberedit">
    <tr>
        <td>category name</td><td><input type="text" name="title" value="<?php echo $row['title']; ?>" /></td>
    </tr>
    <tr>
        <td>description</td><td><input type="text" name="description" value="<?php echo $row['description']; ?>" /></td>
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
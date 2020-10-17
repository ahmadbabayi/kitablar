<?php
echo validation_errors();
?>
<div class="memberbookadd">
    <ul>
        <li><?php echo anchor('member/bookdetails/'. $row['id'], 'back'); ?></li>
    </ul>
</div>
<?php echo form_open_multipart('member/editingbook'); ?>
<input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
<input type="hidden" name="book_lang_code" value="<?php echo $row['language']; ?>" />
<table class="memberedit">
    <tr><td>Language</td><td>
            <select name="book_lang">
                <option value="0" selected="selected">Select book language</option>
                <option value="1">آذربایجانجا</option>
                <option value="2">Azərbaycanca</option>
                <option value="3">فارسی</option>
                <option value="4">Türkçe</option>
                <option value="5">English</option>
                <option value="6">Other</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>title</td><td><input type="text" name="title" value="<?php echo $row['title']; ?>"></td>
    </tr>
    <tr>
        <td>author</td><td><input type="text" name="author" value="<?php echo $row['author']; ?>"></td>
    </tr>
    <tr>
        <td>translator</td><td><input type="text" name="translator" value="<?php echo $row['translator']; ?>"></td>
    </tr>
    <tr>
        <td>ISBN</td><td><input type="text" name="isbn" value="<?php echo $row['isbn']; ?>"></td>
    </tr>
    <tr>
        <td>description</td><td><textarea name="description"><?php echo $row['description']; ?></textarea></td>
    </tr>
</table>
<div><input type="submit" value="Submit" /></div>

</form>
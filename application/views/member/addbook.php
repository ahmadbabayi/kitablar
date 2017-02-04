<?php
echo validation_errors();
?>
<div class="memberbookadd">
    <a href="javascript:history.go(-1)">Back</a>
</div>

<?php echo form_open_multipart('member/addingbook'); ?>
<input type="hidden" name="type" value="1" />
<table>
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
        <td>cover image</td><td><input type="file" name="cover"></td>
    </tr>
    <tr>
        <td>title</td><td><input type="text" name="title"></td>
    </tr>
    <tr>
        <td>author</td><td><input type="text" name="author"></td>
    </tr>
    <tr>
        <td>translator</td><td><input type="text" name="translator"></td>
    </tr>
    <tr>
        <td>ISBN</td><td><input type="text" name="isbn"></td>
    </tr>
    <tr>
        <td>description</td><td><textarea name="description"></textarea></td>
    </tr>
</table>
<div><input type="submit" value="Submit" /></div>

</form>
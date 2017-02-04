<?php
echo validation_errors();
?>
<div class="memberbookadd">
    <a href="javascript:history.go(-1)">Back</a>
</div>

<?php echo form_open('member/addinglibrary'); ?>
<table>

    <tr>
        <td>library title</td><td><input type="text" name="title"></td>
    </tr>
</table>
<div><input type="submit" value="Submit" /></div>

</form>
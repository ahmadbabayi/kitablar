<div class="la2ar">
    <h1>Azerbaijan Latin alphabet to Arab alphabet convertor</h1>
<?php echo validation_errors(); 
echo form_open('','id="form1"');
?>
    <textarea placeholder="text in latin" name="latin"><?php echo $memo1; ?></textarea><br><br>
</form>
<button onclick="submitform()">convert</button> &nbsp;&nbsp;&nbsp;
<?php
if ($login) {
    echo '<button onclick="openmenu()">Add word</button>';
}
 else {
    echo '<button onclick="alert(\'you must login!\')">Add word</button>';
}
?>
<span><?php echo ' - '.$wordcount.' words';  ?></span>
<br><br>
<textarea id="arabtext" style="direction: rtl;" name="arab"><?php echo $memo2; ?></textarea><br><br>
<button onclick="selecttext('arabtext')">copy text</button>
</div>
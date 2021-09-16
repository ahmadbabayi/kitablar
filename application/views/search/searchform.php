<?php
echo validation_errors();
?>
<div class="w3-container w3-padding-64">
    <p>No result!</p>
    <?php echo form_open('search'); ?>
    <input type="hidden" name="type" value="1" />
    <label>Search this site!</label>
    <input type="text" name="search" required="" placeholder="Search" />
    <button type="submit">Submit</button>
</div>

</form>
<div class="w3-container">
<script>
  (function() {
    var cx = '001740427668226804337:qu4vopgwere';
    var gcse = document.createElement('script');
    gcse.type = 'text/javascript';
    gcse.async = true;
    gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(gcse, s);
  })();
</script>
<gcse:search></gcse:search>
</div>
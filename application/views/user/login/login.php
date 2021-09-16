<div class="w3-container w3-padding-64">
    <div class="w3-center" style="width: 300px; margin: auto;">
    <h1>Login</h1>
    <?php
    echo validation_errors();
    echo form_open('','class="w3-container w3-card-4"');
    if (!empty($errormatn))
    {
        echo $errormatn;
    }
    ?>

<p><label>Name</label>
    <input class="w3-input w3-border" name="username" type="text" style="width:90%" required="">
</p>
<p><label>Password</label>
    <input class="w3-input w3-border" name="password" type="password" style="width:90%" required="">
</p>

<p>
    <button class="w3-button w3-section w3-teal w3-ripple" type="submit"> Log in </button></p>

</form>
    <p>
        <a href="<?php echo base_url('user/register'); ?>" class="w3-btn w3-light-gray w3-border">Register new user</a>
    </p>
    </div>
</div>
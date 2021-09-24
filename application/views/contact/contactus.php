<!-- Contact -->
<div class="w3-container" id="contact" style="margin-top:75px">
    <h1 class="w3-xxxlarge w3-text-green"><b>Contact.</b></h1>
    <hr style="width:50px;border:5px solid green" class="w3-round">
    <?php
    echo validation_errors();
    echo form_open('', 'class="w3-container w3-card-4"');
    ?>
    <div class="w3-section">
        <label>Name</label>
        <input class="w3-input w3-border" type="text" name="name" required>
    </div>
    <div class="w3-section">
        <label>Email</label>
        <input class="w3-input w3-border" type="text" name="email" required>
    </div>
    <div class="w3-section">
        <label>Phone</label>
        <input class="w3-input w3-border" type="text" name="phone" required>
    </div>
    <div class="w3-section">
        <label>Message</label>
        <textarea class="w3-input w3-border" name="message" required=""></textarea>
    </div>
    <div class="w3-section">
        <label><?php echo $captcha; ?></label>
        <input class="w3-input w3-border" type="text" name="captcha" placeholder="Enter word">
    </div>
    <button type="submit" class="w3-button w3-block w3-padding-large w3-green w3-margin-bottom">Send Message</button>
</form>  
</div>
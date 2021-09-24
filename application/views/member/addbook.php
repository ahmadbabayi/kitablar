<div class="w3-container" id="contact" style="margin-top:75px">
    <div>
        <a class="w3-button" href="javascript:history.go(-1)">Back</a>
    </div>
    <h1 class="w3-xxxlarge w3-text-green"><b>Add new book</b></h1>
    <hr style="width:50px;border:5px solid green" class="w3-round">
    <?php
    echo validation_errors();
    echo form_open_multipart('member/addbook', 'class="w3-container w3-card-4"');
    ?>
    <div class="w3-section">
        <label>Language</label>
        <select class="w3-input w3-border" name="book_lang">
                    <option value="0" selected="selected">Select book language</option>
                    <option value="1">آذربایجانجا</option>
                    <option value="2">Azərbaycanca</option>
                    <option value="3">فارسی</option>
                    <option value="4">Türkçe</option>
                    <option value="5">English</option>
                    <option value="6">Other</option>
                </select>
    </div>
    <div class="w3-section">
        <label>Cover image</label>
        <input class="w3-input w3-border" type="file" name="cover" required>
    </div>
    <div class="w3-section">
        <label>Title</label>
        <input class="w3-input w3-border" type="text" name="title" required>
    </div>
    <div class="w3-section">
        <label>Author</label>
        <input class="w3-input w3-border" type="text" name="author" required>
    </div>
    <div class="w3-section">
        <label>Translator</label>
        <input class="w3-input w3-border" type="text" name="translator" required>
    </div>
    <div class="w3-section">
        <label>ISBN</label>
        <input class="w3-input w3-border" type="text" name="isbn" required>
    </div>
    <div class="w3-section">
        <label>Tags</label>
        <input class="w3-input w3-border" type="text" name="tags" required>
    </div>
    <div class="w3-section">
        <label>Description</label>
        <textarea class="w3-input w3-border" name="description" required=""></textarea>
    </div>
    <div class="w3-section">
        <label>Tags</label>
        <input class="w3-input w3-border" type="text" name="tags" required>
    </div>
    <button type="submit" class="w3-button w3-block w3-padding-large w3-green w3-margin-bottom">Submit</button>
</form>  
</div>
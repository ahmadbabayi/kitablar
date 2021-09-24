<div class="w3-container" id="contact" style="margin-top:75px">
    <ul>
            <?php echo anchor('book/details/' . $row['id'], '<li class="w3-button">back</li>'); ?>
        </ul>
    <h1 class="w3-xxxlarge w3-text-green"><b>Edit book</b></h1>
    <hr style="width:50px;border:5px solid green" class="w3-round">
    <?php
    echo validation_errors();
    echo form_open('member/editbook', 'class="w3-container w3-card-4"');
    ?>
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
    <input type="hidden" name="book_lang_code" value="<?php echo $row['language']; ?>" />
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
        <label>Title</label>
        <input class="w3-input w3-border" type="text" name="title" value="<?php echo $row['title']; ?>" required>
    </div>
    <div class="w3-section">
        <label>Author</label>
        <input class="w3-input w3-border" type="text" name="authors" value="<?php
                if (!empty($authors)) {
                    foreach ($authors as $author):
                        $links[] = $author['author'];
                    endforeach;
                    print_r(implode(', ', $links));
                }
                ?>">
    </div>
    <div class="w3-section">
        <label>Translator</label>
        <input class="w3-input w3-border" type="text" name="translator" value="<?php echo $row['translator']; ?>">
    </div>
    <div class="w3-section">
        <label>ISBN</label>
        <input class="w3-input w3-border" type="text" name="isbn" value="<?php echo $row['isbn']; ?>">
    </div>
    <div class="w3-section">
        <label>Description</label>
        <textarea class="w3-input w3-border" name="description"><?php echo $row['description']; ?></textarea>
    </div>
    <div class="w3-section">
        <label>Tags</label>
        <input class="w3-input w3-border" type="text" name="tags" value="<?php
                unset($links);
                if (!empty($tags)) {
                    foreach ($tags as $tag):
                        $links[] = $tag['tag'];
                    endforeach;
                    print_r(implode(', ', $links));
                }
                ?>">
    </div>
    <button type="submit" class="w3-button w3-block w3-padding-large w3-green w3-margin-bottom">Submit</button>
</form>  
</div>
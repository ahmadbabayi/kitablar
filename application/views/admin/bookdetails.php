<div class="memberbookadd">
    <ul>
        <li><?php echo anchor('admin/booklist/', 'back'); ?></li>
        <?php if ($row['active'] == 0) {
            echo '<li>';
            echo anchor('admin/verifying/' . $row['id'], 'Verify E-book');
            echo '</li>';
        } ?>
<?php if ($row['active'] == 1) {
    echo '<li>';
    echo anchor('admin/deverifying/' . $row['id'], 'Undo verify');
    echo '</li>';
} ?>
        <li><?php echo anchor('admin/editbook/' . $row['id'], 'edit E-book details'); ?></li>
        <li><a href="<?php echo site_url() . '/admin/removebook/' . $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this item?');">remove E-book</a></li>
    </ul>
</div>
<div class="membermain">
    <?php
    $link = './data/books/bk' . $row['id'] . '/coverthumb.jpg';
    $link2 = '/data/books/bk' . $row['id'] . '/cover.jpg';
    if (!file_exists($link)) {
        $link = '/data/kitab.gif';
        $link2 = '/data/kitab.gif';
    }
    ?>
    <a href=""><img src="<?php echo base_url($link); ?>" onclick="window.open('<?php echo base_url($link2); ?>', '_blank', 'width=600,height=800,scrollbars=yes,menubar=no,status=yes,resizable=yes,screenx=0,screeny=0'); return false;"></a>
    <table>
        <tr>
            <td>title: </td><td><?php echo $row['title']; ?></td>
        </tr>
        <tr>
            <td>author: </td><td><?php echo $row['author']; ?></td>
        </tr>
        <tr>
            <td>translator: </td><td><?php echo $row['translator']; ?></td>
        </tr>
        <tr>
            <td>ISBN: </td><td><?php echo $row['isbn']; ?></td>
        </tr>
        <tr>
            <td>description: </td><td><?php echo $row['description']; ?></td>
        </tr>
    </table>
    <div class="memberfileupload">
<?php echo form_open('admin/categorylistadd/'); ?>
        <label>Select category</label><br>
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <?php foreach ($categorylist as $value): ?>
            <input type="checkbox" name="category[]" value="<?php echo $value['id']; ?>" <?php if (in_array($value['id'], $selectedcategory)) {
            echo 'checked';
        } ?>>
    <?php echo $value['title']; ?><br>
<?php endforeach; ?>
        <input type="submit" value="Submit">
        </form>
    </div>
    <div class="memberfileupload">
        <?php echo form_open_multipart('admin/changecover'); ?>
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
        <label>Change E-book cover image!</label>
        <input type="file" name="cover" />
        <input type="submit" value="Submit" />
        <p>Allowed type: jpg</p>
        </form>
    </div>
    <div class="memberfileupload">
<?php echo form_open_multipart('admin/bookfileuploading'); ?>
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
        <label>Select an E-book file for uploading!</label>
        <input type="file" name="bookfile" />
        <input type="submit" value="Submit" />
        <p>Allowed type: zip,pdf,doc,docx,epub,txt,odt</p>
        </form>
    </div>
    <table class="bookfiles">
        <tr>
            <td>Format</td>
            <td colspan="3">Size</td>
        </tr>
                <?php foreach ($filerow as $item): ?>

            <tr>
                <td><?php
                    $ext = pathinfo($item['file_name'], PATHINFO_EXTENSION);
                    $ext = strtoupper($ext);
                    echo $ext;
                    ?></td>
                <td><?php
                    $filename = './data/books/bk' . $row['id'] . '/' . $item['file_name'];
                    $filesize = get_file_info($filename);
                    $filesize = intval($filesize['size']);
                    echo byte_format($filesize);
                    ?></td>
                <td><a class="downloadbutton" href="<?php echo base_url($filename); ?>">Download</a></td>
                <td><a href="<?php echo site_url() . '/admin/removefile/' . $row['id'] . '/' . $item['id']; ?>" class="downloadbutton" onclick="return confirm('Are you sure you want to delete this item?');">remove</a></td>
            </tr>
<?php endforeach; ?>

    </table>
</div>
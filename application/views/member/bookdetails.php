<div class="w3-container w3-padding-64">
    <div>
        <?php echo anchor('book/details/' . $row['id'], 'back', 'class="w3-button"'); ?>
    </div>
    <div>
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
                <td>author: </td><td><?php
                if (!empty($authors)){
                    foreach ($authors as $author):
                        $links[] = $author['author'];
                    endforeach;
                    print_r(implode(', ', $links));
                }
                    ?></td>
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
        <div id="loadergif"><img alt="upload" src="<?php echo base_url('images/upload.gif'); ?>"></div>
        <div class="w3-padding w3-margin w3-gray">
            <?php echo form_open_multipart('member/changecover'); ?>
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
            <label>Change E-book cover image!</label><br />
            <input  class="w3-input w3-border" type="file" name="cover" onchange="form.submit();" />
            <p>Allowed type: jpg</p>
            </form>
        </div>

        <div class="w3-padding w3-margin w3-gray">
            <?php echo form_open_multipart('member/bookfileuploading'); ?>
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
            <label>Select an E-book file for uploading!</label><br />
            <input  class="w3-input w3-border" type="file" name="bookfile" onchange="form.submit(), showuploadgif()" />
            <p>Allowed type: zip,pdf,doc,docx,epub,txt,odt</p>
            </form>
        </div>
        <table class="w3-table">
            <tr class="w3-green">
                <td>Format</td>
                <td colspan="3">Size</td>
            </tr>
            <?php foreach ($filerow as $item): ?>

                <tr>
                    <td>
                        <?php
                        $ext = pathinfo($item['file_name'], PATHINFO_EXTENSION);
                        $ext = strtoupper($ext);
                        echo $ext;
                        ?>

                    </td>
                    <td>
                        <?php
                        $filename = './data/books/bk' . $row['id'] . '/' . $item['file_name'];
                        $filesize = get_file_info($filename);
                        $filesize = intval($filesize['size']);
                        echo byte_format($filesize);
                        ?>
                    </td>
                    <td><a class="w3-button w3-hover-green w3-red" href="<?php echo base_url($filename); ?>">Download</a></td>
                    <td><a href="<?php echo site_url() . '/member/removefile/' . $row['id'] . '/' . $item['id']; ?>" class="w3-button w3-hover-green w3-red" onclick="return confirm('Are you sure you want to delete this item?');">remove</a></td>
                </tr>
            <?php endforeach; ?>

        </table>
    </div>
</div>
<?php
$link = 'data/books/bk' . $row['id'] . '/cover.jpg';
if (!file_exists($link)) {
    $link = '/data/kitab.gif';
}
?>
<div class="content">
    <h1><?php echo $row['title']; ?></h1>
    <img src="<?php echo base_url($link); ?>" alt="<?php echo$row['title']; ?>" border="1">
    <?php
    if ($addtolibrary) {
        echo '<div class=menimlibrary>Your selected library: '.$libraryname['title'];
        if ($inmylibrary) {
            echo '<div id="txthint"><button onclick="libraryremove(' . $row['id'] . ')">Remove from library</button></div>';
        } else {
            echo '<div id="txthint"><button onclick="libraryadd(' . $row['id'] . ')">Add to library</button></div>';
        }
        echo '</div>';
    }
    ?>
    <ul>
        <li>Author: <?php echo $row['author']; ?></li>
        <li>Translated by: <?php echo $row['translator']; ?></li>
        <li>ISBN: <?php echo $row['isbn']; ?></li>
        <li>Date: <?php echo standard_date('DATE_W3C', $row['date']); ?></li>
        <li>Added by: <?php echo $row['username']; ?></li>
        <li><?php echo $row['description']; ?></li>
    </ul>
    <table class="bookfiles">
        <tr>
            <td>Format</td>
            <td colspan="2">Size</td>
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
                    $filename = 'data/books/bk' . $row['id'] . '/' . $item['file_name'];
                    $filesize = get_file_info($filename);
                    $filesize = intval($filesize['size']);
                    echo byte_format($filesize);
                    ?>
                </td>
                <td><?php echo anchor('book/download/' . $item['id'], 'Download', 'class="downloadbutton"') ?></td>
            </tr>
<?php endforeach; ?>

    </table>
    <div>
        <h2>Download URL:</h2>
        <input onfocus="this.select();" class="urlinput" type="text" value="http://www.kitablar.com/book/details/<?php echo $row['id'] ?>">
    </div>
</div>
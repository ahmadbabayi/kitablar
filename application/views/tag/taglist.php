<div class="w3-row" style="padding-top: 64px;">
    <div class="w3-container">
        <h1 class="w3-text-teal">Tag list</h1>
        <p><?php echo $totalrows; ?> tag</p>
    </div>

</div>

<div class="w3-container w3-bar">
    <?php
    foreach ($taglist as $value):
        echo anchor('book/tag/'. $value['tag'].'/'.$value['id'], $value['tag'],'class="w3-tag  w3-large w3-orange w3-margin w3-padding"');
        endforeach; ?>
</div>

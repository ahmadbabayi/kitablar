<div class="w3-row" style="padding-top: 64px;">
    <div class="w3-container">
        <h1 class="w3-text-teal">Authors</h1>
        <p><?php echo $totalrows; ?> author</p>
    </div>

</div>

<div class="w3-container w3-bar">
    <?php
    foreach ($authorlist as $author):
        echo anchor('book/author/'. remove_bracket($author['author']).'/'.$author['id'], $author['author'],'class="w3-tag  w3-large w3-orange w3-margin w3-padding"');
        endforeach; ?>
</div>

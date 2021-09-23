
<div class="w3-container" style="padding-top: 90px;">
    <ul class="w3-ul w3-card-4">
        <?php
        foreach ($authorlist as $author):
            echo anchor('format/ext/' . $author['format'], '<li class="w3-hover-green">'.$author['format'].'</li>');
        endforeach;
        ?>
    </ul>
</div>

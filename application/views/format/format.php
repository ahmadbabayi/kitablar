
<div class="w3-container" style="padding-top: 90px;">
    <ul class="w3-ul w3-border">
        <?php
        foreach ($authorlist as $author):
            echo anchor('format/extension/' . $author['format'], '<li class="w3-hover-green">'.$author['format'].'</li>');
        endforeach;
        ?>
    </ul>
</div>

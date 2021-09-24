<div class="w3-container" style="padding-top: 90px;">
    <ul class="w3-ul w3-card-4">
        <?php
        foreach ($formatlist as $format):
            echo anchor('format/ext/' . $format['format'], '<li class="w3-hover-green">'.$format['format'].'</li>');
        endforeach;
        ?>
    </ul>
</div>

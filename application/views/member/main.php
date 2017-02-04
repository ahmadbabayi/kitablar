<div class="membermain">
    <h3>Member area </h3>
    <ul>
        <li><?php echo anchor('member/booklist', 'My E-book'); ?></li>
        <li><?php echo anchor('member/booklibrary', 'My library'); ?></li>
        <li><?php echo anchor('member/profile', 'Profile'); ?></li>
        <?php
        if (($_SESSION['is_admin'] === true)) {
            echo '<li>';
            echo anchor('admin', 'Admin menu');
            echo '</li>';
        }
        ?>
    </ul>
</div>


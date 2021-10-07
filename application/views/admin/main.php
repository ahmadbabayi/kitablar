<div class="w3-container w3-padding-64">
    <div>
        <h3>Member area </h3>
        <ul class="w3-ul">
            <li><?php echo anchor('member/addbook', 'Add new E-book'); ?></li>
            <li><?php echo anchor('member/booklist', 'My E-book'); ?></li>
            <li><?php echo anchor('member/profile', 'Profile'); ?></li>
            <li><?php echo anchor('admin', 'Admin menu'); ?></li>
        </ul>
    </div>
    <div>
        <h3>Admin Menu</h3>
        <ul class="w3-ul">
            <li><?php echo anchor('admin', 'All E-book list') ?></li>
            <li><?php echo anchor('admin/importbooks', 'Import E-book'); ?></li>
            <li><?php echo anchor('admin/verifybook', 'Verify book') ?></li>
            <li><?php echo anchor('admin/userlist', 'User list') ?></li>
            <li><?php echo anchor('admin/contacts', 'Contacts') ?></li>
            <li><?php echo anchor('admin/backup', 'Backup'); ?></li>
            <li><?php echo anchor('admin/restore', 'Restore'); ?></li>
        </ul>
    </div>
</div>
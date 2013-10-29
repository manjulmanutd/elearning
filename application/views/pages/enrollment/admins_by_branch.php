<?php if(!empty($adminsByBranch)) { ?>
    <?php foreach($adminsByBranch as $admin):?>
	<option value="<?php echo $admin->admin_id;?>">
		<?php echo $admin->admin_fullname;?>
	</option>
        <?php endforeach;?>
<?php } else { ?>
	<option>No Admins Found. Choose Another Branch</option>
<?php } ?>
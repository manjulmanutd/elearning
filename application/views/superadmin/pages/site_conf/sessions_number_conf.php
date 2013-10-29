<div class="h_left"><h2>Configuration</h2></div>
<div class="seperator"></div>
<ul class="cates">
<h3>Manage Number of Sessions</h3>
<form method="post" action="<?php echo base_url()?>superadmin/updateSessionNumber">
    <input type="text" name="number_session" value="<?php echo $sessionNumber->number_session;?>"/>
    <input type="submit" value="Update"/>
</form>
</ul>
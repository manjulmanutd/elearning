<div class="h_left"><h2>Configuration</h2></div>
<div class="seperator"></div>
<ul class="cates">
<h3>Manage Page Title</h3>
<form method="post" action="<?php echo base_url()?>superadmin/updatePageTitle">
    <input type="text" name="page_title" value="<?php echo $pageTitle->page_title;?>"/>
    <input type="submit" value="Update"/>
</form>
</ul>
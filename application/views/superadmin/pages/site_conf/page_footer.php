<div class="h_left"><h2>Configuration</h2></div>
<div class="seperator"></div>
<ul class="cates">
<h3>Manage Page Footer</h3>
<form method="post" action="<?php echo base_url()?>superadmin/updatePageFooter">
    <label>Site Title:</label>
    <input type="text" name="footer_title" value="<?php echo $pageFooter->footer_title;?>"/>
     <label>CopyRight of:</label>
    <input type="text" name="footer_copyright" value="<?php echo $pageFooter->footer_copyright;?>"/>
     <label>CopyRight Link:</label>
    http://<input type="text" name="footer_link" value="<?php echo $pageFooter->footer_link;?>"/><br/>
    <input type="submit" value="Update"/>
</form>
</ul>
<style type="text/css">
object, #mediaplayer_wrapper
{
	  width: 0px !important;
      height: 0px !important
}
</style>
<?php
require 'includes/header.php';
?>

<div class="admin_wrapper">
 <?php require 'includes/left_enrollment.php';?>
 <div class="option_content floatLeft">
<?php		
	if(isset($pages))
	$this->load->view($pages);
?>
</div>
    
<div class="clear"></div>
 </div><!--admin-wrapper-->
<div class="clear" style="width:100%; clear:both;"></div>

<?php
require 'includes/footer.php';
?>
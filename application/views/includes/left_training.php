<div class="options floatLeft">
<?php
$configuration=$this->dashboard_model->getConfiguration();
if($configuration)
{
		$conf=mysql_fetch_assoc($configuration);	
?>
<div class="logo"><a href="<?php echo base_url();?>dashboard/welcome"><img src="<?php echo base_url();?>images/admin/<?php echo $conf['site_logo'];?>" alt="" /></a></div>
<?php } 
else
{
?>
	<div class="logo"><a href="<?php echo base_url();?>dashboard/welcome"><img src="<?php echo base_url();?>images/logo.png" alt="" /></a></div>
    <?php } ?>
  <ul>
     <li><a href="<?php echo base_url();?>trainee/trainee_dashboard"><i class="icon-leaf" ></i><span class="menutext">Elearning Dashboard</span></a></li>
     <li><a href="<?php echo base_url();?>enroll/getPaymentHistory"><i class="icon-eye-open" ></i><span class="menutext">My Payment History</span></a></li>
     <li><a href="<?php echo base_url();?>trainee/viewAnnouncements"><i class="icon-star" ></i><span class="menutext">Announcements</span></a></li>
     <!--li><a href="<?php echo base_url();?>trainee/view_documents"><i class="icon-cog" ></i><span class="menutext">Resources</span></a></li-->
     <!--li><a href="<?php echo base_url();?>trainee/view_assignments"><i class="icon-question-sign" ></i><span class="menutext">Assignments</span></a></li-->
     <li><a href="<?php echo base_url();?>dashboard/account_settings"><i class="icon-cog" ></i><span class="menutext">Update Profile</span></a></li>
     <li><a href="<?php echo base_url();?>trainee/livechat"><i class="icon-user" ></i><span class="menutext">Live Chat</span></a></li>
     <li><a href="<?php echo base_url();?>login/logout" <?php if($this->uri->segment(2) == 'logout'){echo 'class="active"';}?>><i class="icon-off"></i><span class="menutext">Log Out</span></a></li>

  </ul>
</div>
<!--options-->
<script language="javascript">
$(function(){
		   
		   $("#sel_cours").click(function(){
										  $.ajax({
												 url: "<?php echo base_url();?>destroy/user",
												 success:function(){
													 window.location = "<?php echo base_url();?>dashboard/select_courses"; 
													 }
												 });
										  });
		   
		   });
</script>
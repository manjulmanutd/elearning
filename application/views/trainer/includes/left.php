<div class="options floatLeft">
<?php
$configuration=$this->dashboard_model->getConfiguration();
if($configuration)
{
		$conf=mysql_fetch_assoc($configuration);	
?>
<div class="logo"><img src="<?php echo base_url();?>images/admin/<?php echo $conf['site_logo'];?>" alt="" /></div>
<?php } 
else
{
?>

	<div class="logo"><img src="<?php echo base_url();?>images/logo.png" alt="" /></div>
    <?php } ?>
 
  <ul>
      <li><a href="<?php echo base_url();?>trainer/dashboard" <?php if($this->uri->segment(1) == 'schedules'){echo 'class="active"';}?>><i class="icon-file" ></i><span class="menutext">Trainer Dashboard</span></a></li>
    <li><a href="<?php echo base_url();?>schedules/list_courses" <?php if($this->uri->segment(1) == 'schedules'){echo 'class="active"';}?>><i class="icon-leaf" ></i><span class="menutext">Schedule(s)</span></a></li>
    <!--<li><a href="<?php// echo base_url();?>quiz" <?php// if($this->uri->segment(1) == 'select_quizes'){echo 'class="active"';}?>><i class="icon-question-sign"></i><span class="menutext">Select Quizes</span></a></li>-->
     <li><a href="<?php echo base_url();?>documentation" <?php if($this->uri->segment(1) == 'documentation'){echo 'class="active"';}?>><i class="icon-eye-open"></i><span class="menutext">Document(s)</span></a></li>
     <li><a href="<?php echo base_url();?>assignment" <?php if($this->uri->segment(1) == 'assignment'){echo 'class="active"';}?>><i class="icon-question-sign"></i><span class="menutext">Assignment(s)</span></a></li>
     <li>
        <a href="<?php echo base_url();?>trainer/viewAnnouncements" <?php if($this->uri->segment(1) == 'messages'){echo 'class="active"';}?>><i class="icon-star"></i>
        Announcements
        </a>
    </li>
     <li>
        <a href="<?php echo base_url();?>trainer/liveChat" <?php if($this->uri->segment(1) == 'liveChat'){echo 'class="active"';}?>><i class="icon-user"></i>
        Live Chat
        </a>
    </li>
   <li><a href="<?php echo base_url();?>trainer/account_settings" <?php if($this->uri->segment(2) == 'account_settings'){echo 'class="active"';}?>><i class="icon-cog"></i><span class="menutext">Update Profile</span></a></li>
   <li><a href="<?php echo base_url();?>login/logout" <?php if($this->uri->segment(2) == 'logout'){echo 'class="active"';}?>><i class="icon-off"></i><span class="menutext">Log Out</span></a></li>
  </ul>
</div>
<!--options-->

<script type="text/javascript">
function show_confirm()
{
return confirm("Are you sure you want to remove the session?");	
}
</script>
<div class="h_left"><h2>Course Session Management </h2></div>
<div class="seperator"></div>
<div class="add_new"><form action="<?php echo base_url();?>session/add_session" method="post"><input type="submit" value="Add new" name="add" class="btn btn-inverse"></form></div>

<?php if(!empty($allSessions)){?> 
<div id="tableList">
 
<table width="80%">
<tr>
<th>S/N</th>
<th>Name</th>
<!--th>Title</th-->
<th>Course</th>
<th>Trainer</th>
<th>Action</th>
</tr>



<?php
if($allSessions)
{
	$i = 0;
	foreach($allSessions as $session):
		$i++;
	?>
		<tr>
			<td><?php echo $i;?></td>
                        <td><?php echo $session->session_name;?></td>
			<td class='c_right'><?php echo $this->session_model->getCourseNameById($session->course_id)->course_name;?></td>
			<td class='c_right'>
                            <?php $trainer = $this->session_model->getTrainerNameByCourse($session->course_id);
                            if(!empty($trainer)){
                                   echo $trainer->firstname." ".$trainer->lastname;
                            }else { ?>
                                <a href ="<?php echo base_url();?>course/assign_trainer" class='btn btn-info'>Assign Trainer</a>
                         <?php  }
                         ?></td>
			<td class='action'>
					<a href="<?php echo base_url();?>session/remove/<?php echo $session->session_id;?>" onclick='return show_confirm()' class='btn btn-danger'>Remove</a> 
                                       
					<a href ="<?php echo base_url();?>session/edit_session/<?php echo $session->session_id;?>" class='btn btn-info'>Edit</a>
			</td>
		</tr>
	<?php
		endforeach;
}
?>

</table>
</div>
<?php echo $this->pagination->create_links(); ?>
<?php } else {?>
<h3>No sessions Found</h3>
<?php } ?>
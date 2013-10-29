<script type="text/javascript">
function show_confirm()
{
return confirm("Are you sure you want to remove the trainer?");	
}
</script>
<div class="h_left"><h2>Trainer Manager</h2></div>
<div class="seperator"></div>
<div class="add_new"><a href="<?php echo base_url();?>trainers/add_trainer" class="btn btn-inverse">Add New</a></div>
<div class="seperator"></div>
<div class="add_new"><a href="<?php echo base_url();?>course/assign_trainer" class="btn btn-info">Assign Courses</a>
<a href="<?php echo base_url(); ?>trainers/messageTrainers" class="btn btn-inverse">Message All Trainers</a></div>
<div class="seperator"></div>
<?php
if($trainer)
{ ?>
<table width="60%">
<tr>
<th>S/N</th>
<th>Trainer Name</th>
<th>Username</th>

<th>Action</th>
</tr>

<?php
if($trainer)
{
	$i = 0;
	 foreach($trainer as $train) :
		$i++;
              // $course = $this->trainer_model($train->trainer_id);
		echo "<tr>
		<td class='c_left'>".$i."</td>
                <td class='c_right'>".$train->firstname." ".$train->lastname."</td>
		<td class='c_right'>".$train->username."</td>
                
		<td class='action'>
		<a href= '".base_url()."trainers/delete_trainer/' onclick='return show_confirm();' class='btn btn-danger'>Remove</a>
		<a href = '".base_url()."trainers/edit_trainer/".$train->trainer_id."' class='btn btn-info'>Edit</a>
                <a href = '".base_url()."trainers/message_trainer/".$train->trainer_id."' class='btn btn-inverse'>Message</a>
                </td></tr>";
           endforeach;
	
}
?>
</table>
<?php } else { ?>
<h3>No Trainers Found</h3>
<?php } ?>

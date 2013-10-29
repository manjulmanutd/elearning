<script type="text/javascript">
function show_confirm()
{
return confirm("Are you sure you want to remove the feedback?");	
}

</script>
<?php if(!empty($allFeedbacks)){?>
<table width="80%">
<tr>
<th>S/N</th>
<th>User</th>
<th>Feedback</th>
<th>Course</th>
<th>Action</th>
</tr>



<?php
if($allFeedbacks)
{
	$i = 0;
	foreach($allFeedbacks as $feedback):
		$i++;
	?>
		<tr>
			<td><?php echo $i;?></td>
			<td class='c_right'><?php $user = $this->trainer_model->getTraineeNameById($feedback->user_id);
                                                    echo $user->first_name." ".$user->last_name?></td>
			<td class='c_right'><?php echo $feedback->course_feedback;?></td>
                        <td class='c_right'><?php echo $this->trainer_model->getCourseNameByTrainingId($feedback->training_id)->course_name;?></td>
			<td class='action'>
					<a href="<?php echo base_url();?>trainer/remove_feedback/<?php echo $feedback->feedback_id;?>" onclick='return show_confirm()' class='btn btn-danger'>Remove</a> 
					
			</td>
		</tr>
	<?php
		endforeach;
}
?>

</table>
<?php } else { ?>
<h2>No Feedbacks yet</h2>
<?php } ?>

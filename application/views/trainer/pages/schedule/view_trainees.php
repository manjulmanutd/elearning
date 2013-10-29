<div class="h_left"><h2>Trainee List </h2></div>
<div class="seperator"></div>
<?php if(!empty($allTrainees)){?>
<table width="90%">
<tr>
<th>S/N</th>
<th>Trainee Name</th>
<th>Course</th>
<th>Marks(in 10)</th>
<th>Attendance</th>
<th>Action</th>
</tr>



<?php
if($allTrainees)
{
	$i = 0;
	foreach($allTrainees as $trainee):
		$i++;
	?>
		<tr>
                    <?php $scheduleId = $this->uri->segment('3');
                        $this->load->model('trainer/schedule_model');
                        $feedback =  $this->schedule_model->getAssignmentMarks($scheduleId,$trainee->user_id);;
                    ?>
			<td><?php echo $i;?></td>
                        <td class='c_right'><?php echo $trainee->first_name." ".$trainee->last_name;?></td>
			<td class='c_right'><?php echo $this->schedule_model->getCourseNameById($trainee->course_id)->course_name;?></td>
                        <td class='c_right'><?php if(!empty ($feedback)) { echo $feedback->assignment_marks;} else { echo "0";}?></td>
                        <td class='c_right'><?php if(!empty ($feedback)) { echo ($feedback->attendance==0)? "Present": "Absent";} else { echo "Absent";}?></td>
                        <td class='action'>
				<a href ="<?php echo base_url();?>assignment/view_assignments_by_trainee/<?php echo $trainee->user_id;?>/<?php echo $trainee->training_id?>" class='btn btn-info'>View Assignments</a>
                                <a href ="<?php echo base_url();?>assignment/provide_feedback/<?php echo $trainee->user_id;?>/<?php echo $trainee->training_id?>" class='btn btn-danger'>Feedback</a>
                                <a href ="<?php echo base_url();?>trainer/sendMessageUser/<?php echo $trainee->user_id;?>" class='btn btn-success'>Message</a>
			</td>
                       
		</tr>
	<?php
		endforeach;
}
?>

</table>
<?php } else {?>
<h3> No Trainees found</h3>
<?php } ?>

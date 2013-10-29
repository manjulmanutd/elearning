<script type="text/javascript">
function show_confirm()
{
return confirm("Are you sure you want to complete the course?");	
}
</script>
<div class="h_left"><h2>Upcoming Sessions</h2></div>
<div class="seperator"></div>
<a href ="<?php echo base_url();?>schedules/view_completed_schedules" class='btn btn-info'>View Completed Sessions</a>
<div class="seperator"></div>
<?php if(!empty($allCourses)){?>
<table width="90%">
<tr>
<th>S/N</th>
<th>Lesson</th>
<th>Course</th>
<th>Start Date</th>
<th>Time</th>
<th>No. Of Trainees</th>
<th>Action</th>
</tr>



<?php
if($allCourses)
{
	$i = 0;
	foreach($allCourses as $course):
		$i++;
	?>
		<tr>
			<td><?php echo $i;?></td>
                       <td class='c_right'><?php echo $this->schedule_model->getLessonNameById($course->lesson_id)->lesson_name;?></td>
						<td class='c_right'><?php echo $this->schedule_model->getCourseNameById($course->course_id)->course_name;?></td>
                        <td class='c_right'><?php echo $course->training_date?></td>
                       <td class='c_right'><?php echo $this->schedule_model->getTrainingNameById($course->timeslot)->start_time." to ".
                                                               $this->schedule_model->getTrainingNameById($course->timeslot)->end_time;?></td>
                        <td class='c_right'><?php echo $TraineeCount = count($this->schedule_model->getTraineeCount($course->training_id)); ?></td>
                        <td class='action'>
				<a href ="<?php echo base_url();?>schedules/view_trainees/<?php echo $course->training_id;?>" class='btn btn-success'>Trainees</a>
                                <a href ="<?php echo base_url();?>schedules/view_feedbacks/<?php echo $course->training_id;?>" class='btn btn-primary'>Feedbacks</a>
                               <?php if($TraineeCount>0){?>
                                <a href ="<?php echo base_url();?>schedules/complete_session/<?php echo $course->training_id;?>" class='btn btn-inverse' onclick='return show_confirm()'>Complete Session</a>
                                 <?php }?>
<!--a href ="<?php echo base_url();?>trainer/view_feedback/<?php echo $course->course_id;?>" class='btn btn-info'>View Feedback</a-->
			</td>
                       
		</tr>
	<?php
		endforeach;
}
?>

</table>
<?php } else {?>
<h3> No Assigned Courses found</h3>
<?php } ?>

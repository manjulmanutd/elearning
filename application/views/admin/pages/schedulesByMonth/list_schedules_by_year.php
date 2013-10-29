<div class="h_left"><h2>Schedule Manager</h2></div>
<div class="seperator"></div>
<div class="add_new">
 <!--a href="<?php echo base_url()?>session/list_sessions" class="btn btn-inverse">Manage Sessions</a>
<a href="<?php echo base_url()?>schedule/list_timeslots" class="btn btn-info">Manage TimeSlots</a-->
</div>
<div class="seperator"></div>
 <?php if(!empty($allSchedules)){?> 
<div id="tableList">
 
<table width="100%">
<tr>
<th>S/N</th>
<th>Training Date</th>
<th>Time</th>
<!--th>Title</th-->
<th>Course</th>
<th>Lesson</th>
<th>Trainer</th>
<th>Action</th>
</tr>



<?php
if($allSchedules)
{
	$i = 0;
	foreach($allSchedules as $schedule):
		$i++;
	?>
		<tr>
			<td><?php echo $i;?></td>
			<td class='c_right'><?php echo $schedule->training_date;?></td>
                       	<td class='c_right'><?php echo $this->schedule_model->getTrainingTimeById($schedule->timeslot)->start_time." to 
                                ".$this->schedule_model->getTrainingTimeById($schedule->timeslot)->end_time;?></td>
                        <td class='c_right'><?php if($this->schedule_model->getCourseNameById($schedule->course_id))echo $this->schedule_model->getCourseNameById($schedule->course_id)->course_name;?></td>
			<td class='c_right'><?php if($this->schedule_model->getLessonNameById($schedule->lesson_id))echo $this->schedule_model->getLessonNameById($schedule->lesson_id)->lesson_name;?></td>
			<td class='c_right'>
                            <?php if($this->schedule_model->getTrainerNameById($schedule->trainer_id))echo $this->schedule_model->getTrainerNameById($schedule->trainer_id)->firstname." ".$this->schedule_model->getTrainerNameById($schedule->trainer_id)->lastname;?></td>
			<td class='action'>
					<!--a href="<?php echo base_url();?>schedule/remove_schedule/<?php echo $schedule->trainer_id;?>" onclick='return show_confirm()' class='btn btn-danger'>Remove</a--> 
                                        <?php  $actualDate = strtotime($schedule->training_date);
        $day = date('D', $actualDate);
        ?>
					<!--a href ="<?php echo base_url();?>schedule/edit_schedule_year/<?php echo $schedule->training_date; ?>/<?php echo $day;?>/<?php echo $schedule->training_id;?>" class='btn btn-info'>Edit</a-->
					<a href ="<?php echo base_url();?>schedule/view_trainees/<?php echo $schedule->training_id;?>" class='btn btn-info'>View Trainees</a>
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
<h3>No Schedules Found</h3>
<?php } ?>



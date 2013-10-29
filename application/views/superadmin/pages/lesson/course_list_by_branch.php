<option value="-1">Select Course First</option>
<?php if(!empty($allCourses)) { ?>
	<?php foreach($allCourses as $course):?>
           	<option value="<?php echo $course->course_id;?>"><?php echo $course->course_name;?></option>
	<?php endforeach;?>
<?php } else { ?>
	<option value="-1">No Courses Found. Add Courses</option>
<?php } ?>

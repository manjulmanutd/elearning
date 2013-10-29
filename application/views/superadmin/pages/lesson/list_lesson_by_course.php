<script type="text/javascript">
function show_confirm()
{
return confirm("Are you sure you want to remove the lesson?");	
}

</script>
<?php if($lessonsByCourse)
{ ?>
<div class="add_new"><form action="<?php echo base_url(); ?>superadmin/add_lesson/<?php echo $courseId;?>" method="post"><input type="submit" value="Add new" name="add" class="btn btn-inverse"></form></div>
<br/>
<table width="50%">
<tr>
<th>S/N</th>
<th>Lesson</th>
<th>Course</th>
<th>Action</th>
</tr>



<?php

if($lessonsByCourse)
{
	$i = 0;
	foreach($lessonsByCourse as $lesson):
		$i++;
	?>
		<tr>
			<td><?php echo $i;?></td>
			<td class='c_right'><?php echo $lesson->lesson_name;?></td>
			<td class='c_right'><?php echo $this->super_site_conf_model->getCourseName($lesson->course_id)->course_name;?></td>
			<td class='action'>
					<a href="<?php echo base_url();?>superadmin/remove/<?php echo $lesson->lesson_id;?>" onclick='return show_confirm()' class='btn btn-danger'>Remove</a> 
					<a href ="<?php echo base_url();?>superadmin/edit_lesson/<?php echo $lesson->lesson_id;?>/<?php echo $courseId;?>" class='btn btn-info'>Edit</a>
			</td>
		</tr>
	<?php
		endforeach;
}
?>

</table>
<?php } else {?>
<div class="add_new"><form action="<?php echo base_url(); ?>superadmin/add_lesson/<?php echo $courseId;?>" method="post"><input type="submit" value="Add new" name="add" class="btn btn-inverse"></form></div>
<h3>No lessons found</h3>
<?php } ?>

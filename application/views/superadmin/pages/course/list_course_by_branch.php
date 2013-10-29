<script type="text/javascript">
function show_confirm()
{
return confirm("Are you sure you want to remove the course?");	
}

</script>

<table width="50%">
<tr>
<th>S/N</th>
<th>Course</th>
<th>Course Fee ($)</th>
<th>Action</th>
</tr>



<?php
if($coursesByBranch)
{
	$i = 0;
	foreach($coursesByBranch as $course):
		$i++;
	?>
		<tr>
			<td><?php echo $i;?></td>
			<td class='c_right'><?php echo $course->course_name;?></td>
			<td class='c_right'><?php echo $course->course_fee;?></td>
                        <td class='action'>
					<a href="<?php echo base_url();?>superadmin/removeCourse/<?php echo $course->course_id;?>" onclick='return show_confirm()' class='btn btn-danger'>Remove</a> 
					<a href ="<?php echo base_url();?>superadmin/edit_course/<?php echo $course->course_id;?>" class='btn btn-info'>Edit</a>
			</td>
		</tr>
	<?php
		endforeach;
}
?>

</table>
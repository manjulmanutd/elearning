<script type="text/javascript">
function show_confirm()
{
return confirm("Are you sure you want to remove the batch?");	
}
</script>
<div class="h_left"><h2>Course History</h2></div>
<div class="seperator"></div>



<?php if(!empty($allCourses)){?> 
<div id="tableList">
 
<table width="80%">
<tr>
<th>S/N</th>
<th>Course</th>
<th>Branch</th>
<th>Status</th>
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
                        <td><?php echo $this->user_model->getCourseNameById($course->course_id)->course_name;?></td>
			<td><?php echo $this->user_model->getBranchNameByCourse($course->course_id)->branch_name;?></td>
			<td class='action'>
                            <?php if($course->course_status==2){?>
                            <input type="button" class="btn btn-info" value="Completed" />
                            
                            <?php } else if($course->course_status==0 || $course->course_status==1)  {?>
                            <input type="button" class="btn btn-danger" value="In Progress" />
                            <?php } ?>
                        </td>
		</tr>
	<?php
		endforeach;
}
?>

</table>
</div>

<?php } else { ?>
<h2>No Payment History Found</h2>
<?php } ?>

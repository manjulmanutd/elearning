<div class="h_left"><h2>View Feedbacks</h2></div>
<div class="seperator"></div>
<?php if(!empty($allFeedbacks)){?>
<table width="90%">
<tr>
<th>S/N</th>
<th>Trainee Name</th>
<th>Remarks</th>
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
                        <?php $user = $this->schedule_model->getTraineeNameById($feedback->user_id);?>
                        <td class='c_right'><?php echo $user->first_name." ".$user->last_name;?></td>
			<td class='c_right'><?php echo $feedback->remarks;?></td>
                        
                       
		</tr>
	<?php
		endforeach;
}
?>

</table>
<?php } else {?>
<h3> No Feedbacks found</h3>
<?php } ?>

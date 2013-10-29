<div class="h_left"><h2>Add Feedback</h2></div>
<div class="seperator"></div>

<?php $user_id = $this->uri->segment('3');
        $training_id = $this->uri->segment('4');?>
<form action="<?php echo base_url();?>assignment/provideFeedback/<?php echo $training_id?>/<?php echo $user_id?>" method="post">
<h3>Assignment Marks (Total 10):</h3>
<input type="text" name="assignment_marks" class="required" value="<?php if($feedbackByLesson){ echo $feedbackByLesson->assignment_marks;}?>"/>
<?php if($feedbackByLesson){
    if($feedbackByLesson->attendance==1){
        $checked = "checked";
}else {
    $checked = "";
}

} else {$checked = "";}?>
<div>Absent (Default Present): <input type="checkbox" name="attendance" <?php echo $checked;?>/></div>
<h3>Remarks</h3>
<textarea name="remarks"><?php if($feedbackByLesson){ echo $feedbackByLesson->remarks;}?></textarea>
<div class="seperator"></div>
<input type="submit" value=" Update Feedback " class="btn btn-primary">
</form>
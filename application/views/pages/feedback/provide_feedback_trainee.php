<div class="h_left"><h2>Provide Feedback</h2></div>
<div class="seperator"></div>

<?php $training_id = $this->uri->segment('3');?>
<form action="<?php echo base_url();?>trainee/provideFeedbackSession/<?php echo $training_id?>" method="post">

<h3>Remarks</h3>
<textarea name="remarks"><?php if($feedbackByLesson){ echo $feedbackByLesson->remarks;}?></textarea>
<div class="seperator"></div>
<input type="submit" value=" Update Feedback " class="btn btn-primary">
</form>
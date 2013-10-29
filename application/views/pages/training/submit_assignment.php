<div class="h_left"><h2>Submit Assignment</h2></div>
<div class="seperator"></div>
<form action="<?php echo base_url();?>trainee/submit_assignment" method="post" enctype="multipart/form-data" id="lesson">

<h3 id="fyl">File:</h3>
<input type="file" name="file" id="file"/>

<h3>For Schedule:</h3>
<select name="schedule_id">
     <option value="<?php echo $schedule->schedule_id;?>"><?php echo $this->trainee_model->getLessonNameById($schedule->lesson_id)->lesson_name;?></option>
   
</select>

<div class="seperator"></div>
<input type="submit" value=" Submit " class="btn btn-primary">
</form>
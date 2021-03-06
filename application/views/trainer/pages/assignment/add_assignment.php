<div class="h_left"><h2>Add new Assignment</h2></div>
<div class="seperator"></div>
<form action="<?php echo base_url();?>assignment/add_assignment" method="post" enctype="multipart/form-data" id="upload">
<h3>Title&nbsp;<font color="red">*</font>:</h3>
<input type="text" name="title" class="required">
<h3>Description:</h3>
<textarea name="desc"></textarea>
<h3 id="fyl">File:</h3>
<input type="file" name="file" id="file"/>

<h3>For Schedule:</h3>
<select name="schedule_id">
    <?php foreach($allSchedules as $schedule) :?>
     <option value="<?php echo $schedule->training_id; ?>"><?php echo $this->assignment_model->getCourseNameById($schedule->course_id)->course_name." ".$this->assignment_model->getLessonNameById($schedule->lesson_id)->lesson_name." ( ".date('d M Y',strtotime($schedule->training_date)).")"; ?></option>
    <?php endforeach; ?>
</select>

<div id="down">Is Downloadable : <input type="checkbox" name="download"></div>
<div>Is Active : <input type="checkbox" name="active"></div>
<div class="seperator"></div>
<input type="submit" value=" Add " class="btn btn-primary">
</form>
<script type="text/javascript">
$().ready(function() {		
        $("#upload").validate({
         
         rules: {
			title: "required",
                        file: "required",
                        schedule_id: "required"
			                       
            },
		messages: {
			
			title: "Title is required",
                        file: "Please select a file",
                        schedule_id: "Please select a schedule"
                }
        });
			
    });
</script>
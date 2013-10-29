<script language="javascript">
    
   	
    function getTrainer(){

        var selectedCourse = $("#selectCourse").find(':selected').attr('value');
	 
        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>schedule/getTrainerByCourse/"+selectedCourse,
            data: "",
            success: function(msg){
                $("#trainerList").html(msg);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $("#trainerList").html(xhr.responseText);
                alert(thrownError);
            }


        });
    }

    
    function getLessonsEdit(){
        var selectedCourse = $("#selectCourse").find(':selected').attr('value');
        var lessonId=$('#IdLesson').attr('value');
      
        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>schedule/getEditLessonsByCourse/"+selectedCourse+"/"+lessonId,
            data: "",
            success: function(msg){
                $("#lessonsList").html(msg);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $("#lessonsList").html(xhr.responseText);
                alert(thrownError);
            }


        });
    }
    
    function getLessons(){

        var selectedCourse = $("#selectCourse").find(':selected').attr('value');
	 
        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>schedule/getLessonsByCourse/"+selectedCourse,
            data: "",
            success: function(msg){
                $("#lessonsList").html(msg);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $("#lessonsList").html(xhr.responseText);
                alert(thrownError);
            }


        });
        
       
    }
     $(function() {
                            new JsDatePick({
                                useMode:2,
                                target:"datepicker",
                                dateFormat:"%Y-%m-%d"
                                
                            });
                        });
</script>

<!--script language="javascript">
$(document).ready(function () {
    $('#other').click(function (){
                $('#in').show();
                $('#in').attr('name','time');
    });
    
    $('.tym').click(function (){
                $('#in').hide();
                $('#in').removeAttr('name','time');
    });
        
        $('#otloc').click(function (){
                $('#txtloc').show();
                $('#txtloc').attr('name','location');
    });
        $('.loc').click(function (){
                $('#txtloc').hide();
                $('#txtloc').removeAttr('name','location');
    });
});

</script-->
<body onload="getTrainer();getLessonsEdit();">

    <div class="h_left"><h2>Edit Schedule</h2></div>
    <div class="seperator"></div>
    <form action="<?php echo base_url(); ?>schedule/update_schedule/<?php echo $this->uri->segment('3')?>/<?php echo $allTrainings->schedule_id;?>" method="post" id="schedule_form">
       
        <h3>Course:</h3>
        <select id="selectCourse" name="course_id" onchange="getTrainer();getLessons();">
            <option value="">Select a course</option>
            <?php
            foreach ($allCourses as $course) :
                if ($course->course_id == $allTrainings->course_id) {
                    $selected = "selected";
                } else {
                    $selected = "";
                }
                ?>

                <option value="<?php echo $course->course_id; ?>" <?php echo $selected; ?>><?php echo $course->course_name; ?></option>
            <?php endforeach; ?>
        </select>

        <h3>Lessons</h3>
        <input type="hidden" id="IdLesson" value="<?php echo $allTrainings->lesson_id; ?>"/>
        <select name="lesson_id" id="lessonsList">
            <option value=""><font color="red">Please select any course first</font></option>
        </select>
        <h3>Trainer:</h3>
        <select name="trainer_id" id="trainerList">

        </select>
        
        <h3>Session Name</h3>
        <input type="text" name="session_name" value="<?php echo $allTrainings->session_name;?>"/>


        <h3>Training Date:</h3>
        <input type="text" size="12" id="datepicker" name="date" value="<?php echo $this->uri->segment('3'); ?>"/>
        <!--<input type="text" name="date" id="date">--> 

                 
         <h3>Time Slot:</h3>
        <select id="" name="timeslot">
            
            <?php
            foreach ($timeSlots as $timeslot) :
                if ($timeslot->id == $allTrainings->timeslot) {
                    $selected = "selected";
                } else {
                    $selected = "";
                }
                ?>

                <option value="<?php echo $timeslot->id; ?>" <?php echo $selected; ?>><?php echo $this->schedule_model->getTrainingTimeById($timeslot->id)->start_time." to 
                                ".$this->schedule_model->getTrainingTimeById($timeslot->id)->end_time;?></option>
            <?php endforeach; ?>
        </select>
        
        <div>Is Active : <input type="checkbox" name="active" <?php if($allTrainings->status == 1){ echo "checked = 'checked'";}?>></div>
    <!--<input type="text" name="time">-->
        <div class="seperator"></div>
        <input type="submit" value=" Update " class="btn btn-primary">
    </form>
</body>
<script type="text/javascript">
$().ready(function() {		
        $("#schedule_form").validate({
         
         rules: {
			course_id: "required",
                        lesson_id: "required",
                        trainer_id: "required",
                        session_name: "required",
                        timeslot :"required"
			
                        
            },
		messages: {
			course_id: "Select a Course",
                        lesson_id: "Select a Lesson",
                        trainer_id: "Select a Trainer",
                        session_name: "Session Name is required",
                        timeslot :"Time Slot is required "
                }
        });
			
    });
</script>
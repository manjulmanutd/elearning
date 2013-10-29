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
    
    function getSessions(){

        var selectedCourse = $("#selectCourse").find(':selected').attr('value');
	 
        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>schedule/getSessionsByCourse/"+selectedCourse,
            data: "",
            success: function(msg){
                $("#sessionsList").html(msg);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $("#sessionsList").html(xhr.responseText);
                alert(thrownError);
            }


        });
    }
     
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


<div class="h_left"><h2>Add New Schedule</h2></div>
<div class="seperator"></div>
<form action="<?php echo base_url(); ?>schedule/add_schedule/<?php echo $this->uri->segment('3'); ?>" method="post" id="schedule_form">
   
    <h3>Course:</h3>
    <select id="selectCourse" name="course_id" onchange="getTrainer();getLessons();getSessions();">
        <option value="">Select a course</option>
        <?php foreach ($allCourses as $course) : ?>
            <option value="<?php echo $course->course_id; ?>"><?php echo $course->course_name; ?></option>
        <?php endforeach; ?>
    </select>
     <!--h3>Sessions</h3-->
   
    <!--select name="session_id" id="sessionsList">
        <option value="0"><font color="red">Please select any course first</font></option>
    </select-->
  
    <h3>Lessons</h3>
   
    <select name="lesson_id" id="lessonsList">
        <option value=""><font color="red">Please select any course first</font></option>
    </select>
    <h3>Trainer:</h3>
    <select name="trainer_id" id="trainerList">

    </select>

    <h3>Session Name</h3>
    <input type="text" name="session_name"/>

    <h3>Training Date:</h3>
    <input type="text" size="12" id="inputField" disabled value="<?php echo $this->uri->segment('3'); ?>"/>
    <input type="hidden" size="12" id="inputField" name="date" value="<?php echo $this->uri->segment('3'); ?>"/>
    <!--<input type="text" name="date" id="date">--> 

    <h3>Training TimeSlot:</h3>
     <?php if(!empty($timeSlots)){?>
    <select name="timeslot">
      
        <?php foreach($timeSlots as $timeslot):?>
        <option value="<?php echo $timeslot->id?>"><?php echo $timeslot->start_time." to ".$timeslot->end_time;?></option>
        <?php endforeach;?>
       
    </select>    
    <!--?php } else {?>
    <h4>No Time Slots Avaliable. Manage Time Slots</h4>
    <div class="add_new"><a href="<?php echo base_url()?>schedule/list_timeslots" class="btn btn-info">Manage TimeSlots</a></div-->
        <?php }?>

    <!--h3>Time Slot (eg. 10:00 AM to 12:00 PM)</h3>
    <input type="text" name="timeslot"/-->

    <div>Is Active: <input type="checkbox" name="active"></div>
<!--<input type="text" name="time">-->
    <div class="seperator"></div>
    <input type="submit" value=" Add " class="btn btn-primary">
</form>
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

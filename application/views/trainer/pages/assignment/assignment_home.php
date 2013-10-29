<script type="text/javascript">
    function show_confirm()
    {
        return confirm("Are you sure you want to remove the document?");	
    }
    
    function selectSchedule(){
    
 
        var selectedSchedule = $("#selectSchedule").find(':selected').attr('value');
    
        $.ajax({
            type: "GET",
            url: "getAssignmentBySchedule/"+selectedSchedule,
            data: "",
            success: function(msg){
                $("#tableList").html(msg);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $("#tableList").html(xhr.responseText);
                alert(thrownError);
            }


        });
    
    }
</script>
<div class="h_left"><h2>Assignment Management </h2></div>
<div class="seperator"></div>
<div class="add_new"><form action="<?php echo base_url(); ?>assignment/add" method="post"><input type="submit" value="Add new" name="add" class="btn btn-inverse"></form></div>
<div class="add_new">
    <label>Select Schedule to proceed:</label><select name="schedule_id" id="selectSchedule" onchange="selectSchedule()">
       <option value="0">Select a schedule to proceed</option>
        
        <?php foreach ($allSchedules as $schedule): ?>
             <option value="<?php echo $schedule->training_id; ?>"><?php echo $this->assignment_model->getCourseNameById($schedule->course_id)->course_name." ".$this->assignment_model->getLessonNameById($schedule->lesson_id)->lesson_name." ( ".date('d M Y',strtotime($schedule->training_date)).")"; ?></option>
        <?php endforeach; ?>
    </select></div>

<div id="tableList">
   
</div>
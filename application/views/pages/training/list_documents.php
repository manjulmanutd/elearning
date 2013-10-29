<script type="text/javascript">
  
  function selectSchedule(){
    
 
        var selectedSchedule = $("#selectSchedule").find(':selected').attr('value');
    
        $.ajax({
            type: "GET",
            url: "view_documents_by_schedule/"+selectedSchedule,
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
<div class="h_left"><h2>Documents/Resources</h2></div>
<div class="seperator"></div>
<div class="add_new">
    <label>Select Schedule to proceed:</label><select name="schedule_id" id="selectSchedule" onchange="selectSchedule()">
       <option value="0">Select a schedule to proceed</option>
        
        <?php foreach ($allSchedules as $schedule): ?>
            <option value="<?php echo $schedule->training_id; ?>"><?php echo $this->trainee_model->getLessonNameById($schedule->lesson_id)->lesson_name; ?></option>
        <?php endforeach; ?>
    </select></div>

<div id="tableList">
   
</div>
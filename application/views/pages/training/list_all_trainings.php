<script>
            
 
    function selectLesson(){
        
        var selectedLesson = $('#selectLesson').find(':selected').attr('value');
        //alert(selectedLesson);
         
        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>trainee/getTrainingsByLesson/"+selectedLesson,
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
     
    $(function() {
        new JsDatePick({
            useMode:2,
            target:"datepicker",
            dateFormat:"%Y-%m-%d"
                                
        });
    });
                    
</script>

<div class="h_left"><h2>Book Work Experience Sessions</h2></div>
<div class="add_new">
    <label>Select Lesson to proceed:</label>
    <select name="lesson_id" id="selectLesson">
        <option value="0">Select a lesson to proceed</option>
        <?php foreach ($allLessons as $lesson): ?>
            <option value="<?php echo $lesson->lesson_id; ?>"><?php echo $this->trainee_model->getLessonNameById($lesson->lesson_id)->lesson_name; ?></option>
        <?php endforeach; ?>
    </select>

<h3>Select Date</h3>
<input  id="datepicker" class="floatLeft" type="text" name="booking_date"/>

</div>


<div id="tableList">

</div>








<link href="<?php echo base_url(); ?>js/jsDatePick_ltr.min.css" type="text/css" rel="stylesheet"/>
<script src='<?php echo base_url(); ?>js/jsDatePick.jquery.min.1.3.js' type="text/javascript"></script>
<script>
    $(function() {
        g_calendarObject = new JsDatePick({
            useMode:2,
            target:"datepicker",
            dateFormat:"%Y-%m-%d"
                                
        });
        
        g_calendarObject.setOnSelectedDelegate(function(){
            var obj = g_calendarObject.getSelectedDay();
            var date = obj.year + "-" + obj.month + "-" + obj.day;
            $('#datepicker').val(date);
            
            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>trainee/checkValidDate/"+date,
                data: "",
                success: function(msg){
                    
                    if(msg==0){
                        $("#submitBtn").attr('disabled',true);
                    }else{
                        
                        $("#submitBtn").attr('disabled',false);
                         $.ajax({
                            type: "GET",
                            url: "<?php echo base_url(); ?>trainee/checkDateBookings/"+date,
                            data: "",
                            success: function(msg){
                    
                                $('#bookingsAvailable').html(msg+" Seats Remaining");   
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                $("#tableList").html(xhr.responseText);
                                alert(thrownError);
                            }


                        });
                    }
                                  
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $("#tableList").html(xhr.responseText);
                    alert(thrownError);
                }


            });
            
           
            
        });
    });        
 
 
    
    $().ready(function() {		
        $("#session_form").validate({
         
            rules: {
                lesson_id: "required",
                booking_date: "required",
                timeslot: "required"
            },
            messages: {
                lesson_id: "Please Select a lesson",
                booking_date: "Please Select a date",
                timeslot: "Please select a timeslot"
            }
        });
			
    });
     
     
                    
</script>

<div class="h_left"><h2>Book Work Experience Sessions</h2></div>
<div class="add_new">
    <form action="<?php echo base_url(); ?>trainee/bookUserSession" method="post" id="session_form">
        <label>Select Lesson to proceed:</label>
        <select name="lesson_id" id="selectLesson">
            <option value="">Select a lesson to proceed</option>
            <?php foreach ($allLessons as $lesson): ?>
                <option value="<?php echo $lesson->lesson_id; ?>"><?php echo $this->trainee_model->getLessonNameById($lesson->lesson_id)->lesson_name; ?></option>
            <?php endforeach; ?>
        </select>

        <h3>Select Date</h3>
        <input id="datepicker" class="floatLeft" type="text" name="booking_date" />&nbsp; &nbsp; &nbsp; &nbsp;

        <span id="bookingsAvailable" style="font-size: large; color: red"></span><br/><br/>

        <h3>Training TimeSlot:</h3>

        <select name="timeslot" id="checkTimeslot" onchange="checkValidSession()">
            <?php if (!empty($timeSlots)) { ?>
                <option value="">Select a timeslot</option>
                <?php foreach ($timeSlots as $timeslot): ?>

                    <option value="<?php echo $timeslot->id ?>"><?php echo $timeslot->start_time . " to " . $timeslot->end_time; ?></option>
                <?php endforeach; ?>
            <?php } else { ?>
                <option value="">No Time Slots Found</option>
            <?php } ?>
        </select>  <br/><br/>

        <input type="submit" id="submitBtn" value="Book Session" disabled class="btn btn-success"/>
    </form>
</div>

<script type="text/javascript">

</script>
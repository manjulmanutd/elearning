<div class="h_left"><h2>View Schedules</h2></div>
<div class="seperator"></div>
<form action="<?php echo base_url(); ?>schedule/listSchedulesByYear" method="get" id="schedule_form">
<h3>Course Name:</h3>
    <select name="course_id">
        <option value="">Select a Course</option>

        <?php foreach ($allCourses as $course): ?>
            <option value="<?php echo $course->course_id; ?>"><?php echo $course->course_name; ?></option>
        <?php endforeach; ?>
</select>
<h3>Year</h3>
<?php $i = 2013;?>
<select name="year_id">
    <option value="">Select Year</option>
    <?php for($i=2013;$i<=2050;$i++){?>
    <option value="<?php echo $i; ?>"><?php echo $i;?></option>
    <?php }?>
</select>
<h3>Month</h3>
<select name="month_id">
    <option value="">Select a Month</option>
    <option value="01">January</option>
    <option value="02">February</option>
    <option value="03">March</option>
    <option value="04">April</option>
    <option value="05">May</option>
    <option value="6">June</option>
    <option value="07">July</option>
    <option value="08">August</option>
    <option value="09">September</option>
    <option value="10">October</option>
    <option value="11">November</option>
    <option value="12">December</option>
</select>
<br/>

 <input type="submit" value=" View Lessons " class="btn btn-primary">
</form>
<script type="text/javascript">
    $().ready(function() {      
        $("#schedule_form").validate({
         
            rules: {
                course_id: "required",
                year_id: "required",
                month_id: "required"                
                        
            },
            messages: {
                course_id: "Please Select a Course",
                year_id: "Please Select an Year",
                month_id: "Please Select a Month"   
            }
        });
            
    });
</script>
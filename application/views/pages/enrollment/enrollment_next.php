<h2>Enroll to Another Course</h2>
<form action="<?php echo base_url();?>trainee/enroll_another" id="enrollment" method="post">
<h3>Course</h3>
<select name="course_id" id="course_id">
    <option value="">Select A new Course</option>
     <?php if(!empty($allCourses)){?>
     <?php foreach($allCourses as $course){?>
    <option value="<?php echo $course->course_id;?>"><?php echo $course->course_name;?></option>
    <?php }}else {?>
    <option value="">No Courses Found</option>
    <?php }?>
    
</select><br/>
<input type="submit" class="btn btn-inverse" value="Select Course" />
</form>

<script type="text/javascript">
$().ready(function() {		
        $("#enrollment").validate({
         
         rules: {
			course_id: "required"
			
                        
            },
		messages: {
			course_id: "Course is required"
                }
        });
			
    });
</script>

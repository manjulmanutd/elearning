<div class="h_left"><h2>Add new Course</h2></div>
<div class="seperator"></div>
<form action="<?php echo base_url();?>course/add" method="post" id="course_form">
<h3>Course Name:</h3>
<input type="text" name="course_name">
<h3>Course Description:</h3>
<textarea name="course_desc"></textarea>
<h3>Course Fee (£):</h3>
<input type="text" name="course_fee"/>
<div>Is Active : <input type="checkbox" name="active"></div>
<div class="seperator"></div>
<input type="submit" value=" Add " class="btn btn-primary">
</form>
<script type="text/javascript">
$().ready(function() {		
        $("#course_form").validate({
         
         rules: {
			course_name: "required",
			course_desc: {
                            required: true                       
                        },
                        course_fee:{
                            number: true
                           
                        }
                        
            },
		messages: {
			course_name: "Course Name is required",
			course_desc: {
                            required: "Course Description is required"
                            
                        },
                        course_fee:{
                            number: "Fee must be a number"
                           
                        }
                }
        });
			
    });
</script>

<div class="h_left"><h2>Add new Lesson</h2></div>
<div class="seperator"></div>
<form action="<?php echo base_url(); ?>superadmin/addLesson" method="post" id="lesson_form">
    <h3>Lesson Name:</h3>
    <input type="text" name="lesson_name">
    <h3>Lesson Description:</h3>
    <textarea name="lesson_desc"></textarea>
    <h3>Course Name:</h3>
    <select name="course_id">
        
            <option value="<?php echo $courseId; ?>"><?php echo $this->super_site_conf_model->getCourseNameById($courseId)->course_name; ?></option>
        
    </select>
    <div><input type="hidden" name="1"></div>
    <div class="seperator"></div>
    <input type="submit" value=" Add " class="btn btn-primary">
</form>
<script type="text/javascript">
    $().ready(function() {		
        $("#lesson_form").validate({
         
            rules: {
                lesson_name: "required",
                lesson_desc: {
                    required: true                       
                },
                course_id:{
                    required: true
                }
                        
            },
            messages: {
                lesson_name: "Lesson Name is required",
                lesson_desc: {
                    required: "Lesson Description is required"
                            
                },
                course_id:{
                    required: "Please select a course"
                          
                }
            }
        });
			
    });
</script>
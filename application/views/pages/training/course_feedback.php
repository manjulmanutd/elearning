<div class="h_left"><h2>Provide a Feedback to the course</h2></div>

<div class="seperator"></div>


<form action="<?php echo base_url(); ?>trainee/feedback/<?php echo $courseStatus->course_id; ?>/<?php echo $courseStatus->user_id; ?>" method="post">
        <h3>Course Name:</h3>
        <input type="text" disabled name="course_name" value="<?php echo $this->trainee_model->getCourseNameById($courseStatus->course_id)->course_name; ?>"/>
        <h3>Course Feedback:</h3>
        <textarea name="course_feedback"></textarea>
        <br/>
        <input type="submit" value=" Submit Feedback and Complete Course " class="btn btn-primary"/>
</form>



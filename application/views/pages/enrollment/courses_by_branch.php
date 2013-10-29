<?php if(!empty($allCourses)){?>    
<?php foreach ($allCourses as $course): ?>
        <option value="<?php echo $course->course_id; ?>"><?php echo $course->course_name; ?></option>
    <?php endforeach; ?>
<?php } else { ?>
        <option>No Courses Available</option>
<?php } ?>



<?php
if ($sessionById) {
    ?>
    <div class="h_left"><h2>Edit Session</h2></div>
    <div class="seperator"></div>
    <form action="<?php echo base_url(); ?>session/edit/<?php echo $sessionById->session_id; ?>" method="post">

        <h3>Course Name:</h3>
        <select name='course_id'>

            <?php
            foreach ($allCourses as $course):
                if ($course->course_id == $sessionById->course_id) {
                    $selected = "selected";
                } else {
                    $selected = "";
                }
                ?>

                <option value="<?php echo $course->course_id; ?>" <?php echo $selected; ?>><?php echo $course->course_name; ?></option>
    <?php endforeach; ?>


        </select>
        <h3>Session Name:</h3>
        <input type="text" name="session_name" value = "<?php echo $sessionById->session_name; ?>">
        <h3>Session Description:</h3>
        <textarea name="session_desc"><?php echo $sessionById->session_desc; ?></textarea>

        <div>Is Active : <input type="checkbox" name="active" <?php
    if ($sessionById->status == 1) {
        echo "checked = 'checked'";
    }
    ?>></div>
        <div class="seperator"></div>
        <input type="submit" value=" Save Changes" class="btn btn-primary">

    </form>
    <?php
}
?>
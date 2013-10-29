<div class="dashboard">

    <h2><center>Welcome to the Dashboard</center></h2>

    <a href="<?php echo base_url();?>trainer/message_admin" class="btn btn-success">Send Message to Admin</a>  
    <h3>Assigned Courses</h3>
    <?php if (!empty($courses)) { ?>
        <table width="60%">
            <tr>
                <th>S.No</th> 
                <th>Course</th>
            </tr>
            <?php
            if ($courses) {
                $i = 0;
                foreach ($courses as $course):
                    $i++;
                    ?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $this->trainer_model->getCourseNameById($course->course_id)->course_name;?></td>
            </tr>
                <?php endforeach; ?>
            <?php } ?>

        </table>
    <?php }else { ?>
        <h3>No Courses Assigned Yet</h3>
    <?php } ?>

        
</div>
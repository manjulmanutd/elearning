<div class="h_left"><h2>Feedbacks </h2></div>

<div class="seperator"></div>
<?php
if (!empty($allFeedbacks)) {
    ?>
    <table width="90%">
        <tr>
            <th>S/N</th>
            <th>Lesson</th>
            <th>Feedback by Trainer</th>
            <th>Attendance</th>
            <th>Remarks</th>
            <th>Action</th>
        </tr>



        <?php
        if ($allFeedbacks) {
            $i = 0;
            foreach ($allFeedbacks as $feedback):
                $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td class='c_right'><?php echo $this->trainee_model->getLessonNameById($feedback->lesson_id)->lesson_name; ?></td>
                    <td class='c_right'><?php echo $feedback->assignment_marks."/10"; ?></td>
                    <td class='c_right'><?php echo ($feedback->attendance==0)? "Present" : "Absent"; ?></td>
                    <td class='c_right'><?php echo $feedback->remarks;?></td>
                    <td class='action'>
                                    <!--a href="<?php echo base_url(); ?>course/remove/<?php echo $course->course_id; ?>" onclick='return show_confirm()' class='btn btn-danger'>Remove</a> 
                                    <a href ="<?php echo base_url(); ?>course/edit_course/<?php echo $course->course_id; ?>" class='btn btn-info'>Edit</a-->
                       
                                                   
                    <a href ="<?php echo base_url(); ?>trainee/feedback_lesson/<?php echo $feedback->training_id ?>" class='btn btn-info'>Provide Feedback on Lesson</a>
                        

                    </td>
                </tr>
                <?php
            endforeach;
        }
        ?>

    </table>
<?php } else { ?>
    <h3>No Feedbacks found</h3>
<?php } ?>



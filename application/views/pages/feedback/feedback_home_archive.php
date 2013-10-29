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
                    
                </tr>
                <?php
            endforeach;
        }
        ?>

    </table>
<?php } else { ?>
    <h3>No Feedbacks found</h3>
<?php } ?>



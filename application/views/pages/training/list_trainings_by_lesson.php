<?php
if (!empty($trainingsByLesson)) {
    ?>
    <table width="70%">
        <tr>
            <th>S/N</th>
            <th>Session</th>
            <th>Lesson</th>
            <th>Start Date</th>
            <th>Time</th>
            <th>Course</th>
            <th>Action</th>
        </tr>



        <?php
        if ($trainingsByLesson) {
            $i = 0;
            foreach ($trainingsByLesson as $training):
                $i++;
                $actualDate = strtotime($training->training_start_date);
                $dateString = "%Y-%m-%d";
                $time = time();


                $today = strtotime(mdate($dateString, $time));

                $hourdiff = ($actualDate - $today) / 3600;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td class='c_right'><?php echo $training->session_name; ?></td>
                    <td class='c_right'><?php echo $this->trainee_model->getLessonNameById($training->lesson_id)->lesson_name; ?></td>
                    <td class='c_right'><?php echo $training->training_start_date; ?></td>
                    <td class='c_right'><?php echo $this->trainee_model->getTrainingNameById($training->timeslot)->start_time." to ".
                                                               $this->trainee_model->getTrainingNameById($training->timeslot)->end_time;?></td>
                    <td class='c_right'><?php echo $this->trainee_model->getCourseNameById($training->course_id)->course_name; ?></td>

                    <td class='action'>
                                    <!--a href="<?php echo base_url(); ?>course/remove/<?php echo $course->course_id; ?>" onclick='return show_confirm()' class='btn btn-danger'>Remove</a> 
                                    <a href ="<?php echo base_url(); ?>course/edit_course/<?php echo $course->course_id; ?>" class='btn btn-info'>Edit</a-->
                        <?php if($hourdiff<0){ ?>
                        <a href ="#" class='btn btn-danger' disabled>Already Started</a>
                        <?php } else {?>
                        <a href ="<?php echo base_url(); ?>trainee/bookTraining/<?php echo $training->schedule_id ?>" class='btn btn-info'>Book Training</a>
                        <?php } ?>
                        
                    </td>
                </tr>
                <?php
            endforeach;
        }
        ?>

    </table>
<?php } else { ?>
    <h3>No training found for this lesson</h3>
<?php } ?>

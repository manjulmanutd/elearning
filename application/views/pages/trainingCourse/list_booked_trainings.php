<script type="text/javascript">
    function show_confirm()
    {
        return confirm("Are you sure you want to cancel the session?");	
    }
</script>
<div class="h_left"><h2>Booked Sessions for <?php echo $this->trainee_model->getCourseNameById($activeCourse)->course_name; ?></h2></div>
<div class="add_new"><form action="<?php echo base_url(); ?>trainee/list_unbooked_lessons" method="post"><input type="submit" value="Book Sessions" name="add" class="btn btn-inverse"></form> </div>
<div class="seperator"></div>
<?php
if (!empty($trainingsByLesson)) {
    ?>
    <table width="90%">
        <tr>
            <th>S/N</th>
            <th>Lesson</th>
            <th>Start Date</th>
            <th>Time</th>
            <th>Action</th>
        </tr>



        <?php
        if ($trainingsByLesson) {
            $i = 0;
            foreach ($trainingsByLesson as $training):
                $i++;
                ?>
                <?php
                $actualDate = strtotime($training->training_date);
                $dateString = "%Y-%m-%d";
                $time = time();


                $today = strtotime(mdate($dateString, $time));
                
                $hourdiff = ($actualDate - $today) / 3600;
                // echo $hourdiff;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td class='c_right'><?php echo $this->trainee_model->getLessonNameById($training->lesson_id)->lesson_name; ?></td>
                    <td class='c_right'><?php echo $training->training_date; ?></td>
                    <td class='c_right'><?php echo $this->trainee_model->getTrainingNameById($training->timeslot)->start_time." to ".
                                                               $this->trainee_model->getTrainingNameById($training->timeslot)->end_time;?></td>
                    <td class='action'>
                                    <!--a href="<?php echo base_url(); ?>course/remove/<?php echo $course->course_id; ?>" onclick='return show_confirm()' class='btn btn-danger'>Remove</a> 
                                    <a href ="<?php echo base_url(); ?>course/edit_course/<?php echo $course->course_id; ?>" class='btn btn-info'>Edit</a-->
                        <?php if ($hourdiff > 48) { ?>
                            <a href ="<?php echo base_url(); ?>trainee/cancelBooking/<?php echo $training->booking_id ?>" class='btn btn-danger' onclick='return show_confirm()'>Cancel Booking</a>
                        <?php } else if ($hourdiff <= 0) { ?>
                            <?php if($training->training_status==1){?>
                            <a href ="#" class='btn btn-success' disabled >Session Completed</a>
                            <?php } else {?>
                            <a href ="#" class='btn btn-primary' disabled >Session In Progress</a>
                            <?php }?>
                        <?php } else if ($hourdiff > 0) { ?>
                            <a href ="#" class='btn btn-success' disabled>Due to Start</a>
                <?php } ?>
                    </td>
                </tr>
                <?php
            endforeach;
        }
        ?>

    </table>
<?php } else { ?>
    <h3>No Booked Sessions Found</h3>
<?php } ?>







<script>
            
 
     function selectLesson(){
        
         var selectedLesson = $('#selectLesson').find(':selected').attr('value');
         //alert(selectedLesson);
         
          $.ajax({
            type: "GET",
            url: "<?php echo base_url();?>trainee/getTrainingsByLesson/"+selectedLesson,
            data: "",
            success: function(msg){
                $("#tableList").html(msg);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $("#tableList").html(xhr.responseText);
                alert(thrownError);
            }


        });
         
     }
</script>

<div class="h_left"><h2>Avaliable Work Experience Sessions</h2></div>
<div class="add_new">
    <label>Select Lesson to proceed:</label>
    <select name="lesson_id" id="selectLesson" onchange="selectLesson()">
        <option value="0">Select a lesson to proceed</option>
         <?php foreach ($allLessons as $lesson): ?>
            <option value="<?php echo $lesson->lesson_id; ?>"><?php echo $this->trainee_model->getLessonNameById($lesson->lesson_id)->lesson_name; ?></option>
        <?php endforeach; ?>
    </select></div>

<div id="tableList">

</div>

<?php if (!empty($allTrainings)) { ?>
    <div class="h_left"><h2>Avaliable Work Experience Sessions</h2></div>
    <div class="seperator"></div>

    <table width="100%">
        <tr>
            <th>S/N</th>
            <th>Course</th>
            <th>Session</th>
            <th>Start Date</th>
            <th>Trainer</th>
            <th>Action</th>
        </tr>



    <?php
    if ($allTrainings) {
        $i = 0;
        foreach ($allTrainings as $training):
            $i++;
            ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td class='c_right'><?php echo $this->trainee_model->getCourseNameById($training->course_id)->course_name; ?></td>
                                            <td class='c_right'><?php echo $training->session_name; ?></td>
                                            <td class='c_right'>
            <?php
            $trainingDate = $this->trainee_model->getStartDate($training->session_id)->training_date;
            $dateString = "%Y-%m-%d";
            $time = time();
            $today = mdate($dateString, $time);

            if (strtotime($trainingDate) < strtotime($today)) {
                $trainingStatus = 0;
            } else {
                $trainingStatus = 1;
            }
            ?>
                                            </td>
                                            <td class='c_right'><?php echo $this->trainee_model->getTrainerNameByCourse($training->course_id)->firstname . " " . $this->trainee_model->getTrainerNameByCourse($training->course_id)->lastname; ?></td>
            <?php $completeStatus = $this->trainee_model->isTrainingComplete($training->training_id); ?>



                                            <td class='action'>
            <?php if ($trainingStatus == 1) { ?>
                <?php if (!empty($completeStatus)) { ?>
                    <?php if ($completeStatus->course_status == 3) { ?>
                                                                                                <input disabled class='btn btn-danger' value="Course Completed"/>
                    <?php } else { ?>
                        <!--button id="send">Send E-mail</button-->
                        <a href ="<?php echo base_url(); ?>trainee/startTraining/<?php echo $training->training_id ?>" class='btn btn-info'>Start Training</a>


                    <?php }
                } else { ?>

                    <a href ="<?php echo base_url(); ?>trainee/startTraining/<?php echo $training->training_id ?>" class='btn btn-info'>Start Training</a>


                <? } ?>
            <?php } else if ($trainingStatus == 0) { ?>
                <input disabled class='btn btn-info' value="Session Already Started"/>
            <?php } else if ($training->status == 2) { ?>
                <a href ="<?php echo base_url(); ?>course/edit_course/<?php echo $training->session_id; ?>" class='btn btn-info'>Go To Class Archive</a>
            <?php } ?>

            </td>
            </tr>
            <?php
        endforeach;
    }
    ?>

    </table>
<?php } else { ?>
    <h2>No upcoming Sessions. Stay on touch. We will release the course schedule soon.</h2>
<?php } ?>






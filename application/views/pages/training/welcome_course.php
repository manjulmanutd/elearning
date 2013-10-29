<script type="text/javascript">
    
    $(function() {
        
        var progress = $("#course_progress").attr('value');
        $( "#progressbar" ).progressbar({
            value: +progress
        });
    });
  
    function show_confirm()
    {
        return confirm("Are you sure you want to complete the course? Please complete all the assignments before completing the course");	
    }

</script>
<style>
    .ui-progressbar{
        height: 5em !important;
    }
    .ui-widget-header{
        background-color:  #3F3 !important;
    }
    
    #progressbar {width: 807px}
</style>
<div class="h_left"><h2>Welcome to the Course</h2></div>
<h4>Please use the left panel to start your training</h4>
<div class="seperator"></div>
<h2>Overall Course Progress</h2><br/>
<div id="progressbar"></div>
<p style="font-size: 40px; float: right; margin-top: -47px;margin-right: 110px"><?php echo $courseProgress."%";?></p> <br/>
<div class="seperator"></div><br/><br/>
<input type="hidden" name="course_progress" value="<?php echo $courseProgress?>" id="course_progress"/>
<table width="80%">
    <tr>
        <th>S/N</th>
        <th>Lesson</th>
        <th>Course</th>
        <th>Trainer</th>
        <th>Status</th>
        <th>Action</th>
    </tr>



    <?php
    if ($courseStatus) {
        ?>
        <tr>
            <td><?php echo 1; ?></td>
            <td class='c_right'><?php echo $this->trainee_model->getLessonNameByTraining($courseStatus->training_id)->lesson_name; ?></td>
            <td class='c_right'><?php echo $this->trainee_model->getCourseNameById($courseStatus->course_id)->course_name; ?></td>
            <td class='c_right'><?php $trainer = $this->trainee_model->getTrainerNameByCourse($courseStatus->course_id);
    echo $trainer->firstname . " " . $trainer->lastname; ?></td>
            <td><?php
            $trainingDate = $this->trainee_model->getTrainingDate($courseStatus->training_id)->training_start_date;
            // echo $trainingDate;
            $dateString = "%Y-%m-%d";
            $time = time();
            $today = mdate($dateString, $time);

            if (strtotime($trainingDate) > strtotime($today)) {
                $trainingStatus = 0;
            } else {
                $trainingStatus = 1;
            }

            if ($trainingStatus == 0) {
                echo "Training yet to start";
            } else if ($courseStatus->lesson_status == 1) {
                echo "In Progress";
            } else if ($courseStatus->lesson_status == 2) {
                echo "Completed";
            };
        ?>
            </td>
            <td>
                <?php if ($trainingStatus == 1) {
                    if ($courseStatus->lesson_status == 1) { ?>
                        <!--?php if ($paymentStatus->status == 2) { ?-->
                            <!--a href="<?php echo base_url(); ?>enroll/getPaymentHistory" class='btn btn-danger'>Clear Payments and Complete Course</a--> 
                        <!--?php } else { ?-->
                        <a href="<?php echo base_url(); ?>trainee/markLessonComplete/<?php echo $courseStatus->training_id; ?>" onclick='return show_confirm()' class='btn btn-danger'>Complete Lesson</a> 
            <?php } ?>
                </td>
            </tr>

    <?php }
} ?>

</table>


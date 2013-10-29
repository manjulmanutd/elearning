<script type="text/javascript">
    
    $(function() {
        
        var count = $("#count").attr('value');
       
      
        for(var j = 1; j<=count;j++){
            
            $( "#progressbar_"+j ).progressbar({
            value: +$("#course_progress_"+j).attr('value')
        });
        }
        
    });
  
</script>
<style>
    .ui-progressbar{
        height: 1em !important;
    }
    .ui-widget-header{
        background-color:  #3F3 !important;
    }
    
    .progress {width: 300px; margin-top: 20px}

   .comment {
   border: 1px solid #999;
   background-color: #d8d8f4;
   margin: 1em 40px;
   padding: 40px;
   width:675px;
   height: 25px;
   -moz-border-radius-topleft: 15px;
   -webkit-border-top-left-radius: 15px;   
   -moz-border-radius-topright: 15px;
   -webkit-border-top-right-radius: 8px;    
   -moz-border-radius-bottomleft: 15px;
   -webkit-border-bottom-left-radius: 15px; }

   #course_name {font-size: 20px; margin-top: -25px}
   #course_button {float: right; margin-top: -40px}
</style>
<div class="h_left"><h2>Welcome to the Training Dashboard</h2></div>

<div class="seperator"></div>
<a href="<?php echo base_url();?>trainee/message_admin" class="btn btn-success">Message Branch Admin</a>
<div class="seperator"></div>
<?php $count = count($allCourses);
$i = 0;?>

<input type="hidden" id="count" name="count" value="<?php echo $count;?>">

<?php foreach($allCourses as $course) {
    $i++ ;
  $courseProgress = $this->trainee_model->getCourseProgress($course->course_id);
  ?>
<div class="comment">
    <div id="course_name"><?php echo $this->trainee_model->getCourseNameById($course->course_id)->course_name;?></div>
    <div id="progressbar_<?php echo $i?>" class = "progress"></div>
    <div id="course_button">
        <?php if($course->course_status == 0 || $course->course_status == 1) {?>
        <a href="<?php echo base_url();?>trainee/course_dashboard/<?php echo $course->course_id?>" class="btn btn-info">Go To Class</a>
        <a href="<?php echo base_url();?>trainee/message_trainer/<?php echo $course->course_id?>" class="btn btn-primary">Message Trainer</a>
        <?php } else if($course->course_status == 2){?>
           <a href="<?php echo base_url();?>trainee/archive_dashboard/<?php echo $course->course_id;?>" class="btn btn-danger">Go To Archive</a>
           <a href="<?php echo base_url();?>trainee/enrollSelectBranch" class="btn btn-info">Other Courses</a>
           <a href="<?php echo base_url();?>trainee/message_trainer/<?php echo $course->course_id?>" class="btn btn-primary">Message Trainer</a>
        <?php } ?>
    </div>
    <div id=""><?php if($courseProgress==100) {
        $totalMarks = $this->trainee_model->getTotalMarks($course->course_id);
        echo "Course Completed."." You Scored ".$totalMarks."%." ;}?></div>
</div>
<div class="seperator"></div>
<!--p style="font-size: 40px; float: right; margin-top: -47px;margin-right: 110px"><?php echo $courseProgress."%";?></p> <br/-->
<input type="hidden" name="course_progress" value="<?php echo $courseProgress;?>" id="course_progress_<?php echo $i;?>">
<?php }?>







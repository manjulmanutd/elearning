<script type="text/javascript">
    
    $(function() {
        
        var marks = $("#course_marks").attr('value');
        $( "#progressbar" ).progressbar({
            value: +marks
        });
    });
  

</script>
<style>
    .ui-progressbar{
        height: 5em !important;
    }
    .ui-widget-header{
        background-color:  #00F !important;
    }
    
    #progressbar {width: 807px}
</style>


<div class="h_left"><h2>You have successfully completed the Course</h2></div>

<input type="hidden" name="course_marks" value="<?php echo $totalMarks?>" id="course_marks"/>

<h2>Your score for this course is:</h2><br/><br/>
<div id="progressbar"></div>
<p style="font-size: 40px; float: right; margin-top: -47px;margin-right: 110px"><?php echo $totalMarks."%";?></p> <br/>

<div class="seperator"></div>
<h3> Please keep visiting. We will introduce new courses soon for this branch.</h3>


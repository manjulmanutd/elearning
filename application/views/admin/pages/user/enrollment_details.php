<head>
<link href="<?php echo base_url();?>css/enrollment-style.css" type="text/css" rel="stylesheet">

</head>
<h2 style="text-align: center">Enrollment Details for <?php echo $enrollment->first_name." ".$enrollment->last_name; ?></h2>
<br/> <br/> <br/> <br/>
<a href="<?php echo base_url();?>user/mpdf/<?php echo $enrollment->user_id;?>" class="btn btn-info">Download Enrollment Details Form</a>
<br/><br/>
<div id="form-outer-wrapper">
<div id="form-wrapper">

    <div id="form-top" class="g10">
        <div class="g2"><img src="<?php echo base_url();?>images/logo1.png" height="50" width="70"/></div>
        <div class="g6 top-title">UK Practical Work Experience in <br /><br/>Accountancy Training</div>

    </div><!--  form-top -->
    
    <div class="clear"></div>
    
   

    
    <div class="form-container g10">
    
        <div class="form-content" class="g10">
            <div class="form-content-head g10">PERSONAL</div>
            <div class="form-element-wrap g10">
                
                <div class="g4">
                    <label>Surname:</label><?php echo $enrollment->last_name;?>
                </div>
                
                <div class="g4">
                    <label>Firstname:</label><?php echo $enrollment->first_name;?>
                </div>
                
                <div class="g2 nobb">
                    <label>Gender: M/F</label><?php echo $enrollment->gender ?>
                </div>
                
                <div class="clear"></div>
                
                <div class="g3">
                    <label>Post Code:</label><?php echo $enrollment->post_code ?>
                </div>
                
                <div class="clear"></div>
                
                <div class="g10">
                    <label>Address:</label><?php echo $enrollment->address ?>
                </div>
                
                <div class="clear"></div>
                
                <div class="g5 nobb">
                    <label>Date of Birth:</label>
                    <span class="brace">[<?php echo $enrollment->dob ?></span> 
                  
                    <span class="brace"> ]</span>    
                </div>
                
                <div class="g5 nobb">
                    <label>NI No.</label>
                    <?php echo $enrollment->ni_number ?>    
                        
                </div>
                
                <div class="clear"></div>
                
                <div class="g5">
                    <label>Mobile Tel:</label><?php echo $enrollment->contact_number ?>
                </div>
                
                <div class="g5">
                    <label>Alternate Tel:</label><?php echo $enrollment->alt_number ?>
                </div>
                
                <div class="clear"></div>
                
                <div class="g5">
                    <label>Emergency contact person - Name:</label><?php echo $enrollment->emergency_contact_name;?>
                </div>
                
                <div class="g5">
                    <label>Tel:</label><?php echo $enrollment->emergency_contact_no ?>
                </div>
                
                <p>&nbsp;</p>
                
            </div><!-- form-element-wrap -->
        </div><!-- form-content -->

        <div class="clear"></div>
        
        <div class="form-content" class="g10">
            <div class="form-content-head g10">ABOUT THE WORK EXPERIENCE</div>
            <div class="form-element-wrap g10">
            
                <div class="g10 nobb">
                    <label>When would you like to start:</label>
                    <span class="brace">[<?php echo $enrollment->pref_start_date ?></span> 
                 
                    <span class="brace">]</span>
                </div>
                
                                
               <div class="g10 nobb">Work Area Experience </div>
                <?php foreach($allCourses as $course) {
                    if($enrollment->course_id==$course->course_id) { $selected = "checked";} else {$selected = "";}
                   ?>

                <div class="g10 nobb">
                    <input type="checkbox" class="form-check-box" disabled <?php echo $selected;?>/> &nbsp;
                    <strong><?php echo $course->course_name;?> </strong>
                </div>
                <?php }?>               
                <p>&nbsp;</p>
                
            </div><!-- form-element-wrap -->
        </div><!-- form-content -->
        
        <div class="clear"></div>
        
        <div class="form-content" class="g10">
            <div class="form-content-head g10">CAREER PROGRESSION & RECRUITMENT WITH TD&A</div>
            <div class="form-element-wrap g10">
            
                <div class="g10 nobb">
                    As a TD&A trainee, you are entitled to a free CV Session, Job interview tips and listing on our financial recruitment
database. Here are some few things we would to know from you in advance:
                </div>
                
                <p>&nbsp;</p>
            
             <div class="g10">
                    <label>* What is your ideal accountancy job?</label>
                    <?php echo $enrollment->q1_ideal_accnt ?>
                </div>
                
                <div class="g10">
                    <label>* Which industry would you like to work in?</label>
                    <?php echo $enrollment->q2_industry ?>
                </div>
                
                <div class="g10">
                    <label>* What is your ideal salary requirement?</label>
                    <?php echo $enrollment->q3_salary ?>
                </div>
                
                <div class="g10">
                    <label>* How many jobs have you applied for in the past month?</label>
                    <?php echo $enrollment->q4_jobs_applied ?>
                </div>
                
                <div class="g10">
                    <label>* What Job are you doing at the moment?</label>
                    <?php echo $enrollment->q5_doing_what ?>
                </div>
            </div><!-- form-element-wrap -->
        </div><!-- form-content -->
    
    </div><!-- form-container -->

  
    
        
</div><!-- form-wrapper -->
</div><!-- form-outer-wrapper -->


</body>

</html>





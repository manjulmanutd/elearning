<!doctype html>
<html lang="en">
    <head>

	<title>
		<?php
			$title=$this->site_conf_model->getPageTitle();
			echo $title->page_title;
		?>
	</title>
        <link href="<?php echo base_url(); ?>js/jsDatePick_ltr.min.css" type="text/css" rel="stylesheet"/>
        <link href="<?php echo base_url(); ?>css/style.css" type="text/css" rel="stylesheet"/>
        <link href="<?php echo base_url(); ?>css/dashboard.css" type="text/css" rel="stylesheet"/>
        <link href="<?php echo base_url(); ?>css/landing.css" type="text/css" rel="stylesheet"/>
        <link href="<?php echo base_url(); ?>css/bootstrap.css" type="text/css" rel="stylesheet"/>
        <link href="<?php echo base_url(); ?>css/enrollment-form-dn.css" type="text/css" rel="stylesheet"/>
        <script src='<?php echo base_url(); ?>js/jsDatePick.jquery.min.1.3.js' type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>jquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.validate.js"></script>
        <style>
            #enrollment { width:100%;}/*  border: solid 1px; text-align: center */
            #popup_box{border-radius:10px; -moz-border-radius:10px; -webkit-border-radius:10px; padding:20px}
        </style>
        <script>
            function showTerms(){
                loadPopupBox();
    
                $('#popupBoxClose').click( function() {            
                    unloadPopupBox();
                });
        
                $('#container').click( function() {
                    unloadPopupBox();
                });

                function unloadPopupBox() {    // TO Unload the Popupbox
                	
                    $('#popup_box').fadeOut("slow");
                    $("#container").css({ // this is just for style        
                        "opacity": "1"  
                    }); 
                }    
        
                function loadPopupBox() {    // To Load the Popupbox
                	
                    $('#popup_box').fadeIn("slow");
                    $("#container").css({ // this is just for style
                        "opacity": "0.3"  
                    });         
                }        
            }
            
            $(function() {
                new JsDatePick({
                    useMode:2,
                    target:"datepicker",
                    dateFormat:"%Y-%m-%d"
                                
                });
            });
        </script>
    </head>

    <body>
    
    <div id="enrollment">

    <form action="<?php echo base_url(); ?>trainee/enroll_now/<?php echo $trainee->user_id ?>" method="post" id="enrollment">

        <div id="form-wrapper">

            
            
            <div class="g10" style="border-bottom:2px solid #000">
                <h2 style="text-align: center">Welcome to TD&A Online Training. Please Enroll Now to proceed</h2>
            </div>
            <br/> <br/><div class="clear"></div>

        <div class="form-container g10">
    
        <div class="form-content" class="g10">
            <div class="form-content-head g10">PERSONAL INFORMATION</div>
            <div class="form-element-wrap g10">
                
                <div class="g4">
                    <label>Surname:</label>
                    <input class="input-normal seven8" type="text" value="<?php echo $trainee->last_name; ?> "disabled/>
                    <input class="" type="hidden" name="last_name" value="<?php echo $trainee->last_name; ?> "/>
                </div>
                
                <div class="g4">
                    <label>Firstname:</label>
                    <input class="input-normal seven8" type="text" value="<?php echo $trainee->first_name; ?>" disabled/>
                    <input class="" type="hidden" name="first_name" value="<?php echo $trainee->first_name; ?>" />
                </div>
                
                <div class="g2 nobb">
                    <input type="radio" class="form-check-box" name="gender" value="male" /><label> &nbsp; Male: </label>
                    <input type="radio" class="form-check-box" name="gender" value="female"/><label> &nbsp; Female: </label>
                 </div>
                
                <div class="clear"></div>

                <div class="g7">
                    <label>Address:</label><input type="text" class="input-normal seven8" name="address" />
                </div>

                <div class="g3">
                    <label>Post Code:</label><input type="text" class="form-input seven8" style="width:55%" name="post_code" />
                </div>
                
                <div class="clear"></div>
                
                <!--
                <div class="g7">
                    <label>Email:</label><input type="text" class="form-input seven8" />
                </div>
                
                <div class="clear"></div>-->
                
                <div class="g5 nobb">
                    <label>Date of Birth:</label>
                    <span class="brace">[</span> 
                    <input type="text" class="form-input-date" placeholder="YYYY-MM-DD" name="dob" /> 
                    <span class="brace">]</span>    
                </div>
                
                <div class="g5">
                    <label>NI No.</label>
                    <!--
                        <input type="text" class="form-input-sq-box" /> 
                        <input type="text" class="form-input-sq-box" />
                        <input type="text" class="form-input-rt-box" />
                        <input type="text" class="form-input-sq-box" />
                        name="ni_number" -->
                        <input type="text" class="form-input seven8" name="ni_number" /> 
                </div>
                
                <div class="clear"></div>
                
                <div class="g5">
                    <label>Mobile Number:</label>
                    <input type="text" class="input-normal seven8" value="<?php echo $trainee->contact_number; ?>" disabled/>
                    <input type="hidden" name="contact_number" class="" value="<?php echo $trainee->contact_number; ?>" />
                </div>

                <div class="g5">
                    <label>Alternate Number:</label><input type="text" class="form-input seven8" name="alt_number"  />
                </div>
                
                <div class="clear"></div>

                <div class="form-content-head g10" style="border-bottom:none; font-weight:normal; text-transform:capitalize">Emergency Contact Person</div>
                
                <div class="g5">
                    <label>Name:</label><input type="text" class="form-input seven8" name="emergency_contact_name" />
                </div>
                
                <div class="g5">
                    <label>Telephone</label><input type="text" class="form-input seven8" name="emergency_contact_no" />
                </div>
                
            </div><!-- form-element-wrap -->
        </div><!-- form-content -->


        <div class="clear"></div>
        
        <div class="form-content" class="g10">
            <div class="form-content-head g10">ABOUT WORK EXPERIENCE</div>
            <div class="form-element-wrap g10">
            
                <div class="g10 nobb">
                    <label>When would you like to start:</label>
                    <span class="brace">[</span> 
                    <input id="datepicker" type="text" name="pref_start_date" class="form-input-date" />
                    <span class="brace">]</span>
                </div>
                
                <div class="g10 nobb">Which area(s) would you like to gain work experience in? </div>

                <?php foreach ($allCourses as $course): ?>
                <div class="g10 nobb">
                    <input type="radio" name="course_id" value="<?php echo $course->course_id; ?>" class="form-check-box" /> 
                    &nbsp;&nbsp;&nbsp;
                    <?php echo "<strong>".$course->course_name . "</strong> - ( £" . $course->course_fee . " )"; ?>
                </div>
                <?php endforeach; ?>
                
            </div><!-- form-element-wrap -->
        </div><!-- form-content -->
        


        <div class="form-content" class="g10">
            <div class="form-content-head g10">CAREER PROGRESSION & RECRUITMENT WITH TD&A</div>
            <div class="form-element-wrap g10">
            
                <div class="g10 nobb">
                    As a TD&A trainee, you are entitled to a free CV Session, Job interview tips and listing on our financial recruitment 
                    database. Here are some few things we would to know from you in advance:
                </div>
                
                <p>&nbsp;</p>
            
                <div class="g10">
                    <label>What is your ideal accountancy job?</label>
                    <input class="form-input six6" type="text" name="q1_ideal_accnt" />
                </div>
                
                <div class="g10">
                    <label>Which industry would you like to work in?</label>
                    <input type="text" class="form-input six6" name="q2_industry"  />
                </div>
                
                <div class="g10">
                    <label>What is your ideal salary requirement?</label>
                    <input type="text" class="form-input six6" name="q3_salary"  />
                </div>
                
                <div class="g10">
                    <label>How many jobs have you applied for in the past month?</label>
                    <input type="text" class="form-input six6" name="q4_jobs_applied"  />
                </div>
                
                <div class="g10">
                    <label>What Job are you doing at the moment?</label>
                    <input type="text" class="form-input six6" name="q5_doing_what"  />
                </div>
            
            </div><!-- form-element-wrap -->
        </div><!-- form-content -->

        <div class="form-content">
            <div class="form-element-wrap g10">
                <div class="g10 nobb">
                    <label>
                        I have read, understood and agree to the <a href="#" id="click" class="btn btn-danger" onclick="showTerms()">Terms and
                        Conditions </a> set out on this form. 
                    </label>
                </div>

                <div class="g10 nobb">
                    <input type="checkbox" name="active" class="form-check-box" /> &nbsp;&nbsp;&nbsp;Agree Terms and Conditions
                </div>
            </div>
        </div>
        
        
            <div class="g10">
                <input type="submit" value="Enroll Now" class="btn btn-info"/>
            </div>
            

    


                <!--tr>
                    <td style="text-align: center" colspan="3"><a href ="<?php echo base_url(); ?>enroll/payFullFee/<?php // echo $training->training_id                   ?>" class='btn btn-info'>Pay 100% Now</a>
                        <a href ="<?php echo base_url(); ?>enroll/payHalfFee/<?php // echo $training->training_id                   ?>" class='btn btn-info'>Pay 50% Now</a>
                        <a href="<?php echo base_url(); ?>appointment/enroll/<?php // echo $training->training_id                   ?>" class="btn btn-primary">Book an Appointment</a>
                        </h4>
                        <h4></h4>
                </tr-->    

                <!--button id="send">Send E-mail</button-->

    </div>
    
    </form>
       
    
    </div><!-- wrapper-dn-dn -->

<!-- basic fancybox setup -->

<script type="text/javascript">
    $().ready(function() {
                   
            
        $("#enrollment").validate({
         
            rules: {
                last_name: "required",
                first_name: "required",
                gender: "required",
                address: "required",
                post_code: "required",
                dob: "required",
                    
                ni_number:{
                    required: true
                },
                contact_number:{
                    required: true,
                    number: true
                },
                emergency_contact_name:{
                    required: true                            
                },
                emergency_contact_no:{
                    required: true,
                    number: true
                },
                course_id: "required",
                active: "required"
             
                        
            },
            messages: {
                last_name: "Sur Name is required",
                first_name: "First Name is required",
                gender: "Gender is required",
                address: "Address is required",
                post_code: "Post Code is required",
                dob: "Date of Birth is required",
                    
                ni_number:{
                    required: "NI number is required"
                },
                contact_number:{
                    required: "Contact Number is required",
                    number: "Should be a number"
                },
                emergency_contact_name:{
                    required: "Emergency contact Name is required"                            
                },
                emergency_contact_no:{
                    required: "Contact Number is required",
                    number: "Should be a number"
                },
                course_id: "Please select a course Id",
                active: "Please Agree Terms and Conditions"
            }
        });
            
    });
</script>


  <div id="popup_box" style="overflow:auto; z-index:100;">
            <?php echo $terms->terms;?>
        <a id="popupBoxClose">Close</a>
    </div>
    
    
</body>

 
      
    
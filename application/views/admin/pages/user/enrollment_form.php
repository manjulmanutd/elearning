<!doctype html>
<html lang="en">
    <head>


        <link href="<?php echo base_url(); ?>js/jsDatePick_ltr.min.css" type="text/css" rel="stylesheet"/>
        <link href="<?php echo base_url(); ?>css/style.css" type="text/css" rel="stylesheet"/>
        <link href="<?php echo base_url(); ?>css/dashboard.css" type="text/css" rel="stylesheet"/>
        <link href="<?php echo base_url(); ?>css/landing.css" type="text/css" rel="stylesheet"/>
        <link href="<?php echo base_url(); ?>css/bootstrap.css" type="text/css" rel="stylesheet"/>
        <script src='<?php echo base_url(); ?>js/jsDatePick.jquery.min.1.3.js' type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>jquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.validate.js"></script>
        <style>
            #enrollment { width:100%; border: solid 1px; text-align: center}
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

        <h2 style="text-align: center">Welcome to TD&A Online Training. Please Enroll Now to proceed</h2>
        <br/> <br/> <br/> <br/>

        <div id="enrollment_form">

            <form action="<?php echo base_url(); ?>user/enroll_now/<?php echo $trainee->user_id ?>" method="post" id="enrollment">

                <h4>Sur Name</h4>
                <input class="input-normal" type="text" value="<?php echo $trainee->last_name; ?> "disabled/>
                <input class="input-normal" type="hidden" name="last_name" value="<?php echo $trainee->last_name; ?> "/>
                <br/>


                <h4>First Name</h4>
                <input class="input-normal" type="text" value="<?php echo $trainee->first_name; ?>" disabled/>
                <input class="input-normal" type="hidden" name="first_name" value="<?php echo $trainee->first_name; ?>" />
                <br/>

                <h4>Gender</h4>
                Male: <input type="radio" class="input-normal" name="gender" value="male" />&nbsp;&nbsp;&nbsp;&nbsp;Female: <input type="radio" class="input-normal" name="gender" value="female"/><br/>

                <h4>Address</h4>
                <input type="text" class="input-normal" name="address" /><br/>

                <h4>Post Code</h4>
                <input type="text" class="input-normal" name="post_code" /><br/>

                <h4>Date of Birth (YYYY-MM-DD)</h4>
                <input type="text" class="input-normal" name="dob" /><br/>

                <h4>NI Number</h4>
                <input type="text" class="input-normal" name="ni_number" /><br/>


                <h4>Mobile Number</h4>
                <input type="text" class="input-normal" value="<?php echo $trainee->contact_number; ?>" disabled/>
                <input type="hidden" name="contact_number" class="input-normal" value="<?php echo $trainee->contact_number; ?>" />
                <br/>


                <h4>Alternate Number</h4>
                <input type="text"  class="input-normal" name="alt_number" /><br/><br/><br/>

                <h3>Emergency Contact Person</h3>

                <h4>Name</h4>
                <input class="input-normal" type="text" name="emergency_contact_name" /><br/>

                <h4>Telephone</h4>
                <input class="input-normal" type="text" name="emergency_contact_no" /><br/><br/><br/>

                <h2>ABOUT WORK EXPERIENCE</h2> <br/> <br/>

                <h4>When would you like to start:</h4>
                <input id="datepicker" type="text" name="pref_start_date" /><br/>



                <h3>Which area would you like to gain work experience in?</h3>

                <?php foreach ($allCourses as $course): ?>
                    <input type="radio" name="course_id" value="<?php echo $course->course_id; ?>"/> <?php echo $course->course_name . " - ( £" . $course->course_fee . " )"; ?> <br/>
                <?php endforeach; ?>
                <!--input type="radio" name="experience" />  Accounts Assistant/Bookkeeper/ Accounts payable & receivable clerk - {for 1-2 Months} £ 600 <br />
                <input type="radio" name="experience" />  Sage Line 50 Training – { for 3 days } £300 <br />
                <input type="radio" name="experience" />  Financial Accountant: Financial Accounting & Payroll Accounting together – {for 2 - 4 Months} £1,200 <br />
                <input type="radio" name="experience" />  Professional Accountant: Financial, Management, Payroll & Tax Accounting – {for 3-6 Months} £ 2,200 <br />
                <input type="radio" name="experience" />  Management Accountant: Budgeting, Corporate Reporting, Breakeven analysis - {for 1 Month} £ 960 <br />
                <input type="radio" name="experience" />  Tax Accountant – Tax returns, Capital Allowances, UK VAT accounting, - {for 1 Month} £500 <br />
                <input type="radio" name="experience" />  Payroll Accounting - {for 1 Month} £ 600 <br />
                <input type="radio" name="experience" />  Using Excel competently (Specific for Accountants) – {for 4 days} £ 480 -->
                <br/><br/>

                <h2>CAREER PROGRESSION & RECRUITMENT WITH TD&A</h2>

                <label>As a TD&A trainee, you are entitled to a free CV Session, Job interview tips and listing on our financial recruitment 
                    database. Here are some few things we would to know from you in advance:</label>

                <h4>What is your ideal accountancy job?</h4>
                <input class="input-answer" type="text" name="q1_ideal_accnt" /><br/>


                <h4> Which industry would you like to work in?</h4>
                <input class="input-answer" type="text" name="q2_industry" /><br/>

                <h4>What is your ideal salary requirement?</h4>
                <input class="input-answer" type="text" name="q3_salary" /><br/>

                <h4>How many jobs have you applied for in the past month?</h4>
                <input  class="input-answer" type="text" name="q4_jobs_applied" /><br/>

                <h4>What job are you doing at the moment?</h4>
                <input class="input-answer" type="text" name="q5_doing_what" /><br/>

                <div>I have read, understood and agree to the <a href="#" id="click" class="btn btn-danger" onclick="showTerms()">Terms and
                        Conditions </a> set out on this form. <br/>
                    Agree Terms and Conditions &nbsp;&nbsp;<input type="checkbox" name="active"/></div>
                <div class="seperator"></div>
                <div>
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




            </form>

        </div>
    

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
<div id="popup_box" style="overflow:auto;">
    <?php echo $terms->terms;?>




    <a id="popupBoxClose">Close</a>






</div>

</body>



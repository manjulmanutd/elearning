<!doctype html>
<html lang="en">
    <head>


        <link href="<?php echo base_url(); ?>js/jsDatePick_ltr.min.css" type="text/css" rel="stylesheet"/>
        <link href="<?php echo base_url(); ?>css/style.css" type="text/css" rel="stylesheet"/>
        <link href="<?php echo base_url(); ?>css/enrollment-style.css" type="text/css" rel="stylesheet"/>
        <link href="<?php echo base_url(); ?>css/dashboard.css" type="text/css" rel="stylesheet"/>
        <link href="<?php echo base_url(); ?>css/landing.css" type="text/css" rel="stylesheet"/>
        <link href="<?php echo base_url(); ?>css/bootstrap.css" type="text/css" rel="stylesheet"/>
        <script src='<?php echo base_url(); ?>js/jsDatePick.jquery.min.1.3.js' type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>jquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.validate.js"></script>

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

        <div id="form-outer-wrapper">
            <div id="form-wrapper">

                <div id="form-top" class="g10">
                    <div class="g2"><img src="" /></div>
                    <div class="g6 top-title">UK Practical Work Experience in <br />Accountancy Training</div>
                    <div class="g2"><strong><i>Booking Form</i></strong></div>
                </div><!--  form-top -->

                <div class="clear"></div>

                <div class="g10"><div class="g10">Thanks for choosing TD&A Accountancy & Financial Services as the place to gain your practical work experience
                        in Accountancy, please fully complete this form to let us know which work experience you would like to gain:</div></div>


                <div class="form-container g10">

                    <div class="form-content" class="g10">
                        <div class="form-content-head g10">PERSONAL</div>
                        <div class="form-element-wrap g10">

                            <div class="g4">
                                <label>Surname:</label><input type="text" class="form-input" />
                            </div>

                            <div class="g4">
                                <label>Firstname(s):</label><input type="text" class="form-input" />
                            </div>

                            <div class="g2 nobb">
                                <label>Gender: M/F</label><input type="text" class="form-input-sq-box" />
                            </div>

                            <div class="clear"></div>

                            <div class="g7">
                                <label>Emai:</label><input type="text" class="form-input" />
                            </div>

                            <div class="g3">
                                <label>Post Code:</label><input type="text" class="form-input" style="width:55%" />
                            </div>

                            <div class="clear"></div>

                            <div class="g10">
                                <label>Address:</label><input type="text" class="form-input" />
                            </div>

                            <div class="clear"></div>

                            <div class="g5 nobb">
                                <label>Date of Birth:</label>
                                <span class="brace">[</span> 
                                <input type="text" class="form-input-date" placeholder="dd / mm / yyyy" /> 
                                <span class="brace">]</span>	
                            </div>

                            <div class="g5 nobb">
                                <label>NI No.</label>
                                <input type="text" class="form-input-sq-box" />	
                                <input type="text" class="form-input-sq-box" />
                                <input type="text" class="form-input-rt-box" />
                                <input type="text" class="form-input-sq-box" />
                            </div>

                            <div class="clear"></div>

                            <div class="g5">
                                <label>Mobile Tel:</label><input type="text" class="form-input" />
                            </div>

                            <div class="g5">
                                <label>Alternate Tel:</label><input type="text" class="form-input" />
                            </div>

                            <div class="clear"></div>

                            <div class="g5">
                                <label>Emergency contact person - Name:</label><input type="text" class="form-input" />
                            </div>

                            <div class="g5">
                                <label>Tel:</label><input type="text" class="form-input" />
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
                                <span class="brace">[</span> 
                                <input type="text" class="form-input-date" placeholder="dd / mm / yyyy" /> 
                                <span class="brace">]</span>
                            </div>

                            <div class="g10 nobb">Which area(s) would you like to gain work experience in? </div>

                            <div class="g10 nobb">
                                <input type="checkbox" class="form-check-box" />
                                <strong>Accounts Assistant/Bookkeeper/ Accounts payable & receivable clerk -</strong> {for 1-2 Months} £ 600
                            </div>

                            <div class="g10 nobb">
                                <input type="checkbox" class="form-check-box" />
                                <strong>Sage Line 50 Training –</strong> { for 3 days } £300
                            </div>

                            <div class="g10 nobb">
                                <input type="checkbox" class="form-check-box" />
                                <strong>Financial Accountant:</strong> Financial Accounting & Payroll Accounting together – {for 2 - 4 Months} £1,200
                            </div>

                            <div class="g10 nobb">
                                <input type="checkbox" class="form-check-box" />
                                <strong>Professional Accountant:</strong> Financial, Management, Payroll & Tax Accounting – {for 3-6 Months} £ 2,200
                            </div>

                            <div class="g10 nobb">
                                <input type="checkbox" class="form-check-box" />
                                <strong>Management Accountant:</strong> Budgeting, Corporate Reporting, Breakeven analysis - {for 1 Month} £ 960
                            </div>

                            <div class="g10 nobb">
                                <input type="checkbox" class="form-check-box" />
                                <strong>Tax Accountant – </strong>Tax returns, Capital Allowances, UK VAT accounting, - {for 1 Month} £500
                            </div>

                            <div class="g10 nobb">
                                <input type="checkbox" class="form-check-box" />
                                <strong>Payroll Accounting -</strong> {for 1 Month} £ 600
                            </div>

                            <div class="g10 nobb">
                                <input type="checkbox" class="form-check-box" />
                                <strong>Using Excel competently (Specific for Accountants) –</strong> {for 4 days} £ 480
                            </div>

                            <div class="g10 nobb">
                                <label>How would you like to pay:</label>
                                Cash <input type="radio" class="form-radio" />
                                Card <input type="radio" class="form-radio" />
                            </div>

                            <div class="form-bottom-right-info nobb">
                                <strong>FREE</strong> Sage Line 50 software for Financial & Professional accounting trainees
                            </div>

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
                                <input type="text" class="form-input" />
                            </div>

                            <div class="g10">
                                <label>* Which industry would you like to work in?</label>
                                <input type="text" class="form-input" />
                            </div>

                            <div class="g10">
                                <label>* What is your ideal salary requirement?</label>
                                <input type="text" class="form-input" />
                            </div>

                            <div class="g10">
                                <label>* How many jobs have you applied for in the past month?</label>
                                <input type="text" class="form-input" />
                            </div>

                            <div class="g10">
                                <label>* What Job are you doing at the moment?</label>
                                <input type="text" class="form-input" />
                            </div>

                        </div><!-- form-element-wrap -->
                    </div><!-- form-content -->

                </div><!-- form-container -->

                <div class="form-content-head g10">Work Experience Training Terms and Conditions</div>

                <div class="g10 condition">

                    <ol>
                        <li>Definitions
                            <ol>
                                <li>TD&A & TD&A Accountancy & Financial Services is a trading name of TD&A Ltd, registered office Level 33, 25
                                    Canada Square, London, E14 5LQ</li>
                                <li>The trainee (s) means the person (s) attending the work experience.</li>
                                <li>The work experience means one or a specific series of training courses as defined in the training brochure or proposal.</li>
                            </ol>
                        </li>

                        <li>Bookings
                            <ol>
                                <li>
                                    No booking will be confirmed as accepted until such time as TD&A is in receipt of a fully completed booking
                                    form.
                                </li>
                                <li>Except where the TD&A exercises its discretion to do
                                    otherwise no trainee will be accepted onto any work
                                    experience until TD&A is in receipt of payment, in full, of
                                    the work experience fee.
                                </li>
                            </ol>
                        </li>

                        <li>Payment: Only Card & Cash payment accepted.</li>

                        <li>Cancellation
                            <ol>
                                <li>By the TD&A
                                    TD&A may cancel any training at any time but will
                                    endeavour to provide the trainee with at least 7 days
                                    notice of cancellation. Any fees paid will be refunded in
                                    full to the trainee. The extent of liability for cancellation of
                                    work experience is specifically limited to any training fee
                                    paid.
                                </li>

                                <li>By the Trainee
                                    <ol>
                                        <li> All cancellations must be notified to TD&A in writing.</li>
                                        <li>
                                            Where the trainee cancels a booking TD&A reserves
                                            the right to impose cancellation fees as follows:
                                            20% of the training fee for cancellations made (1) one
                                            calendar week prior to the training start date. For
                                            cancellations less than one (1) calendar week the full
                                            course fee (notified on time of booking) will be charged
                                            unless otherwise agreed. There is an administration
                                            charge of £100 should the trainee cancel at any time after
                                            the enrolment has been confirmed to the trainee by TD&A
                                            either by phone, post or email.
                                        </li>
                                    </ol>
                                </li>
                            </ol>
                        </li>

                        <li>
                            Non completion of training & Long absence If a trainee decides not to complete any wok experience booked and a session attended, the full fee must be paid
                            within (1) one calendar week if the installment option of fee payment was agreed at the time of booking. TD&A will
                            assume that a decision by the trainee has been made not to complete the training if a trainee does not show up for
                            training for (4) four consecutive sessions with no prior notice to TD&A in writing either by email or post.
                            If a trainee does not attend the work experience for a month (30 Calendar days) from date of latest
                            attendance, then your work experience will be automatically cancelled and there will be no refund ofany fees paid.
                        </li>

                        <li>Quality
                            TD&A will provide suitably qualified and experienced
                            personnel with regard to the work experience training
                            and will take all reasonable care to ensure that the
                            presentation and content of the work experience
                            training is made in a professional and competent
                            manner and to a standard appropriate to the course.
                        </li>

                        <li>Materials and Equipment
                            All facilities, training materials and equipment will be
                            provided for use by trainees for the duration of the
                            work experience unless otherwise specified. TD&A will
                            not be liable for any materials or equipment brought
                            onto the premises by a trainee.
                        </li>

                        <li>Copyright of work experience material
                            Ownership of and copyright in all training material and
                            documents shall remain with TD&A. Trainees may use
                            such material and documents only for their personal
                            use and such material and documents shall not be
                            copied, given, sold assigned or otherwise transferred in
                            whole or in part to any third party without the express
                            written consent of the TD&A
                        </li>

                        <li>Trainee’s Liability
                            The trainee accepts responsibility in full for their
                            conduct whilst on TD&A premises and undertakes to
                            indemnify TD&A against material damage and/or
                            personal injury to TD&A, its servants, agents or
                            property as a result of actions or defaults whilst
                            attending the work experience.
                        </li>

                        <li>Limit of Liability
                            Other than liability in respect of death or personal
                            injury , the extent of TD&A’s liability for any failure to
                            meet its obligation shall be limited to the costs of the
                            work experience fee only.</li>

                        <li>Interpretation
                            12.1 This agreement shall be governed by and
                            construed in accordance with the laws of England and
                            the parties hereby submit to the exclusive jurisdiction
                            of the English Courts.
                            12.2 This agreement is subject to the special conditions
                            (if any) contained in the schedule hereto. In the event
                            of any inconsistency between such special conditions
                            and the other terms of agreement such special
                            conditions shall prevail.</li>

                        <li>Force Majeure
                            TD&A shall not be liable to refund of fees or for any
                            other penalty should work experience training be
                            cancelled due to war, fire, strike, lock-out, industrial
                            action, tempest, accident, civil disturbance or any other
                            cause whatsoever beyond their control.</li>

                    </ol>

                </div><!-- TERMS -->

                <div class="10">
                    Please return your completed booking form together with your payment to TD&A , Level 33, 25 Canada Square
                    canary Wharf, London E14 5LQ. Telephone: 020 7038 8046. Cash payments can only be made at TD&A’s
                    reception. Please do not send cash on post with your completed form.
                </div>

                <div class="g10">
                    <div class="g6">
                        <p>a.I confirm that the information I have provided in this form is true and correct to the best of my knowledge and</p>
                        <p>b.I have read, understood and agree to the terms and conditions set out on this form.</p>
                    </div>

                    <div class="g4">

                        <div class="g10">
                            <label>Signature:</label>
                        </div>

                        <p>&nbsp;</p>

                        <div class="form-element-wrap g10" style="border:none !important">
                            <label>Date:</label>
                            <span class="brace">[</span> 
                            <input type="text" class="form-input-date" placeholder="dd / mm / yyyy" /> 
                            <span class="brace">]</span>
                        </div>
                    </div>	

                </div>


            </div><!-- form-wrapper -->
        </div><!-- form-outer-wrapper -->

        <div>

            <form action="<?php echo base_url(); ?>trainee/enroll_now/<?php echo $trainee->user_id ?>" method="post" id="enrollment">

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
                    <td style="text-align: center" colspan="3"><a href ="<?php echo base_url(); ?>enroll/payFullFee/<?php // echo $training->training_id                    ?>" class='btn btn-info'>Pay 100% Now</a>
                        <a href ="<?php echo base_url(); ?>enroll/payHalfFee/<?php // echo $training->training_id                    ?>" class='btn btn-info'>Pay 50% Now</a>
                        <a href="<?php echo base_url(); ?>appointment/enroll/<?php // echo $training->training_id                    ?>" class="btn btn-primary">Book an Appointment</a>
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
            <h3>TERMS AND CONDITIONS</h3>
            <li><strong>1. Definitions</strong></li>

            <li type="square">1.1 TD&A & TD&A Accountancy & Financial Services is a
                trading name of TD&A Ltd, registered office Level 33, 25
                Canada Square, London, E14 5LQ
            </li>
            <li type="square">1.2 The trainee (s) means the person (s) attending the
                work experience.</li>

            <li type="square">1.3 The work experience means one or a specific series
                of training courses as defined in the training brochure or
                proposal. </li> <br/>

            <li><strong>2. Bookings</strong></li>

            <li type="square"> 2.1 No booking will be confirmed as accepted until such
                time as TD&A is in receipt of a fully completed booking
                form.</li>

            <li type="square"> 2.2 Except where the TD&A exercises its discretion to do
                otherwise no trainee will be accepted onto any work
                experience until TD&A is in receipt of payment, in full, of
                the work experience fee.</li> <br/>

            <li><strong>3.Payment: Only Card & Cash payment accepted.</strong></li><br/>
            <li><strong>4. Cancellation</strong></li>

            <li type="square">4.1 By the TD&A
                TD&A may cancel any training at any time but will
                endeavour to provide the trainee with at least 7 days
                notice of cancellation. Any fees paid will be refunded in
                full to the trainee. The extent of liability for cancellation of
                work experience is specifically limited to any training fee
                paid.</li>
            <li type="square"> 4.2 By the Trainee</li>
            <p> 4.2.1 All cancellations must be notified to TD&A in writing.</p>
            <p> 4.2.2 Where the trainee cancels a booking TD&A reserves
                the right to impose cancellation fees as follows:
                20% of the training fee for cancellations made (1) one
                calendar week prior to the training start date. For
                cancellations less than one (1) calendar week the full
                course fee (notified on time of booking) will be charged
                unless otherwise agreed. There is an administration
                charge of £100 should the trainee cancel at any time after
                the enrolment has been confirmed to the trainee by TD&A
                either by phone, post or email.
                5. Non completion of training & Long absence
                If a trainee decides not to complete any wok experience
                booked and a session attended, the full fee must be paid
                within (1) one calendar week if the installment option of
                fee payment was agreed at the time of booking. TD&A will
                assume that a decision by the trainee has been made not
                to complete the training if a trainee does not show up for
                training for (4) four consecutive sessions with no prior
                notice to TD&A in writing either by email or post.
                If a trainee does not attend the work experience for a
                month (30 Calendar days) from date of latest
                attendance, then your work experience will be
                automatically cancelled and there will be no refund of
                any fees paid.</p><br/>

            <li><strong>5. Non completion of training & Long absence</strong></li>
            <p>If a trainee decides not to complete any wok experience
                booked and a session attended, the full fee must be paid
                within (1) one calendar week if the installment option of
                fee payment was agreed at the time of booking. TD&A will
                assume that a decision by the trainee has been made not
                to complete the training if a trainee does not show up for
                training for (4) four consecutive sessions with no prior
                notice to TD&A in writing either by email or post.
                If a trainee does not attend the work experience for a
                month (30 Calendar days) from date of latest
                attendance, then your work experience will be
                automatically cancelled and there will be no refund of
                any fees paid.</p><br/>

            <li><strong>6. Quality</strong></li>
            <p> TD&A will provide suitably qualified and experienced
                personnel with regard to the work experience training
                and will take all reasonable care to ensure that the
                presentation and content of the work experience
                training is made in a professional and competent
                manner and to a standard appropriate to the course.</p><br/>

            <li><strong>7. Materials and Equipment</strong></li>
            <p> All facilities, training materials and equipment will be
                provided for use by trainees for the duration of the
                work experience unless otherwise specified. TD&A will
                not be liable for any materials or equipment brought
                onto the premises by a trainee.</p><br/>

            <li><strong>8. Copyright of work experience material</strong></li>
            <p> Ownership of and copyright in all training material and
                documents shall remain with TD&A. Trainees may use
                such material and documents only for their personal
                use and such material and documents shall not be
                copied, given, sold assigned or otherwise transferred in
                whole or in part to any third party without the express
                written consent of the TD&A</p><br/>

            <li><strong> 9. Trainee’s Liability</strong></li>
            <p> The trainee accepts responsibility in full for their
                conduct whilst on TD&A premises and undertakes to
                indemnify TD&A against material damage and/or
                personal injury to TD&A, its servants, agents or
                property as a result of actions or defaults whilst
                attending the work experience.</p><br/>

            <li><strong>10. Limit of Liability</strong></li>
            <p>Other than liability in respect of death or personal
                injury , the extent of TD&A’s liability for any failure to
                meet its obligation shall be limited to the costs of the
                work experience fee only.</p>

            <li><strong>11. Interpretation</strong></li>
            <li type="square">11.1 This agreement shall be governed by and
                construed in accordance with the laws of England and
                the parties hereby submit to the exclusive jurisdiction
                of the English Courts.</li>
            <li type="square">11.2 This agreement is subject to the special conditions
                (if any) contained in the schedule hereto. In the event
                of any inconsistency between such special conditions
                and the other terms of agreement such special
                conditions shall prevail.</li><br/>

            <li><strong> 12. Force Majeure</strong></li>
            <p>TD&A shall not be liable to refund of fees or for any
                other penalty should work experience training be
                cancelled due to war, fire, strike, lock-out, industrial
                action, tempest, accident, civil disturbance or any other
                cause whatsoever beyond their control.</p>




            <a id="popupBoxClose">Close</a>






        </div>

    </body>



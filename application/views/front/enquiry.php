<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>
            <?php
            $title = $this->site_conf_model->getPageTitle();
            echo $title->page_title;
            ?></title>

        <link href="<?php echo base_url(); ?>css/bootstrap.css" type="text/css" rel="stylesheet">
            <link href="<?php echo base_url(); ?>css/landing.css" type="text/css" rel="stylesheet">
                <link href="<?php echo base_url(); ?>js/jsDatePick_ltr.min.css" type="text/css" rel="stylesheet"/>
                <link href='http://fonts.googleapis.com/css?family=Tenor+Sans' rel='stylesheet' type='text/css'>
                    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
                    <script src='<?php echo base_url(); ?>jquery.js' type="text/javascript"></script>

                    <script language="javascript" src="<?php echo base_url(); ?>js/jquery.validate.js"></script>

                    </head>
                    <body>

                        <div class="header">
                        </div><!--header-->
                        <div class="seperator"></div>
                        <div class="wrapper">
                            <div class="loginWrap">

                                <div class=" floatLeft texts">

                                </div>      





                                <!--textss-->

                                <div class="form">
                                    <div class="loginForm appointmentForm " id="loginDivForm">


                                        <form action= "<?php echo base_url(); ?>enquiry/makeEnquiry" method="post" id="appointment_form">
                                            <h1>Thank for your interest </h1>
                                            <h3>Please make an enquiry about anything related to us, we will contact you very soon. </h3>
                                            <ul>
                                                <hr/>

                                                <li>
                                                    <span class ="floatLeft">Your Name:</span><input type="text" name="fullname" class="floatLeft"/>
                                                    <div class="clear"></div>
                                                </li>

                                                <li>
                                                    <span class="floatLeft">Email Address:</span><input type="text" name="email" class="floatLeft"/>
                                                    <div class="clear"></div>
                                                </li>
                                                <li>
                                                    <span class="floatLeft">Branch:</span>
                                                    <select name='branch_id' class="floatLeft" id="select_branch" onchange="getTimeSlots();">
                                                        <option value="">Select a Branch</option>
                                                        <?php foreach ($allBranches as $branch): ?>
                                                            <option value="<?php echo $branch->branch_id; ?>"><?php echo $branch->branch_name; ?></option>
                                                        <?php endforeach; ?>


                                                    </select>
                                                    <div class="clear"></div>
                                                </li>


                                                <li>
                                                    <span class="floatLeft">Message:</span> <textarea  class="floatLeft" name="enquiry_message"></textarea> 
                                                    <div class="clear"></div>
                                                </li>

                                                <li>
                                                    <hr />
                                                    <input type="submit" value="Submit" class="btn btn-success" style="margin-right:20px;"/>
                                                    <a href="<?php echo base_url(); ?>/login" class="btn btn-primary">Login (if you are already an member)</a> 
                                                    <br />
                                                    <hr />


                                                </li>
                                            </ul>
                                        </form>


                                    </div>


                                </div>
                                <!--
                                
                                <div class="appointment_today texts" align="center"> 
                                    <div id="main_appnt_btn">
                                        <input type='button' id="appnt_btn" name='submit' value="Book An Appointment Today" class="btn btn-primary" onclick="$('#collapse_appnt').show();"/>
                                        <br/><br/>
                                        <div id="collapse_appnt" style="display: none;">

                                        <input type='button' name='submit' value="Book Appointment Now" class="btn btn-success"/>
                                        <p style="font-family: sans-serif;font-size: xx-small">(If you are new to us Please book an appointment's to see one of our experienced Work Experience consultant today)</p>
                                        <br/>

                                        <a href="#loginDivForm"><input type='button' name='submit' value="If you are already an member click to log in" class="btn btn-inverse"/></a>
                                        <br/><br/>  <br/><br/>
                                    </div>

                                </div>  
                                <div class="clear"></div>
                            </div><!--loginWrap-->

                            </div><!--wrapper-->


                            <div class="footer">
                                <?php $footer = $this->site_conf_model->getPageFooter(); ?>    
                                <?php echo $footer->footer_title ?> - Copyright © 
                                <a href="http://<?php echo $footer->footer_link; ?>"><?php echo $footer->footer_copyright; ?></a> 
                            </div>

                    </body>
                    </html>

                    <script type="text/javascript">
                                                                            $().ready(function() {
                                                                                $("#appointment_form").validate({
                                                                                    rules: {
                                                                                        fullname: "required",
                                                                                        email: "required",
                                                                                        branch_id: "required",
                                                                                        enquiry_message: "required"
                                                                                    },
                                                                                    messages: {
                                                                                        fullname: "Your Name is required",
                                                                                        email: "Email is required",
                                                                                        branch_id: "Branch is required",
                                                                                        enquiry_message: " Timeslot is required"
                                                                                    }
                                                                                });

                                                                            });
                    </script>

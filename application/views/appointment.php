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
                    <script src='<?php echo base_url(); ?>js/jsDatePick.jquery.min.1.3.js' type="text/javascript"></script>
                    <script language="javascript" src="<?php echo base_url(); ?>js/jquery.validate.js"></script>
                    <script language='javascript'>
                        $(document).ready(function() {
                            new JsDatePick({
                                useMode: 2,
                                target: "datepicker",
                                dateFormat: "%Y-%m-%d"

                            });

                        });

                        function getTimeSlots() {


                            var selectedBranch = $("#select_branch").find(':selected').attr('value');
                            var selectedDate = $("#datepicker").attr('value');
                            $.ajax({
                                type: "GET",
                                url: "<?php echo base_url(); ?>appointment/getTimeSlots/" + selectedBranch + "/" + selectedDate,
                                data: "",
                                success: function(msg) {

                                    $('#timeslot_list').html(msg);
                                }

                            });

                        }

                        function getBranchAdmins() {

                            var selectedBranch = $("#select_branch").find(":selected").attr('value');
                            $.ajax({
                                type: "GET",
                                url: "<?php echo base_url(); ?>appointment/getBranchAdmins/" + selectedBranch,
                                data: "",
                                success: function(msg) {

                                    $('#admin_list').html(msg);
                                }

                            });
                        }
                    </script>

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


                                        <form action= "<?php echo base_url(); ?>appointment/register" method="post" id="appointment_form">
                                            <h1>Thank for your interest in one of our Work Experience Courses </h1>
                                            <h3>Please book your appointment with one of your consultant who would be happy to give you more details. </h3>
                                            <ul>
                                                <hr/>

                                                <li>
                                                    <span class ="floatLeft">First Name:</span><input type="text" name="firstname" class="floatLeft"/>
                                                    <div class="clear"></div>
                                                </li>

                                                <li>
                                                    <span class="floatLeft">Sur Name:</span><input type="text" name="lastname" class="floatLeft"/>
                                                    <div class="clear"></div>
                                                </li>
                                                <li>
                                                    <span class="floatLeft">Phone No:</span><input type="text" name="phoneno" class="floatLeft"/>
                                                    <div class="clear"></div>
                                                </li>
                                                <li>
                                                    <span class="floatLeft">Email Address:</span><input type="text" name="email" class="floatLeft"/>
                                                    <div class="clear"></div>
                                                </li>
                                                <li>
                                                    <li>
                                                        <span class="floatLeft">Choose Appointment Date:</span><input  id="datepicker" class="floatLeft" type="text" name="appointment_date"/>
                                                        <div class="clear"></div>
                                                    </li>
                                                    <span class="floatLeft">Branch:</span>
                                                    <select name='branch_id' class="floatLeft" id="select_branch" onchange="getTimeSlots();getBranchAdmins();">
                                                        <option value="">Select a Branch</option>
                                                        <?php foreach ($allBranches as $branch): ?>
                                                            <option value="<?php echo $branch->branch_id; ?>"><?php echo $branch->branch_name; ?></option>
                                                        <?php endforeach; ?>


                                                    </select>
                                                    <div class="clear"></div>
                                                </li>

                                                <li>
                                                    <span class="floatLeft">Choose Avaliable Time Slot:</span>
                                                    <select name='timeslot_id' class="floatLeft" id="timeslot_list">
                                                        <option value="">Select Branch and Date First</option>


                                                    </select>
                                                    <div class="clear"></div>
                                                </li>

                                                <li>
                                                    <span>Choose Avaliable Admins:</span>
                                                    <select name='admin_id' id="admin_list">
                                                        <option value="">Select Branch First</option>


                                                    </select>
                                                    <div class="clear"></div>
                                                </li>
                                                <li>
                                                    <span class="floatLeft">Any Specific Requirements:</span> <textarea  class="floatLeft" name="specific_requirements"></textarea> 
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
                                    firstname: "required",
                                    lastname: "required",
                                    phone: "required",
                                    email: "required",
                                    appointment_date: "required",
                                    branch_id: "required",
                                    timeslot_id: "required"
                                },
                                messages: {
                                    firstname: "First Name is required",
                                    lastname: "Sur Name is required",
                                    phone: "Phone Number is required",
                                    email: "Email is required",
                                    appointment_date: "Date is equired",
                                    branch_id: "Branch is required",
                                    timeslot_id: " Timeslot is required"
                                }
                            });

                        });
                    </script>

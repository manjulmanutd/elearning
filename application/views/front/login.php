<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Training Management System</title>

        <link href="<?php echo base_url(); ?>css/bootstrap.css" type="text/css" rel="stylesheet">
            <link href="<?php echo base_url(); ?>css/landing.css" type="text/css" rel="stylesheet">
                <link href='http://fonts.googleapis.com/css?family=Tenor+Sans' rel='stylesheet' type='text/css'>
                    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
                    <script src='<?php echo base_url(); ?>jquery.js' type="text/javascript"></script>
                    <script language="javascript" src="<?php echo base_url(); ?>js/jquery.validate.js"></script>

                    <script type="text/javascript">

                        /*** 
                         Simple jQuery Slideshow Script
                         Released by Jon Raasch (jonraasch.com) under FreeBSD license: free to use or modify, not responsible for anything, etc.  Please link out to me if you like it :)
                         ***/

                        function slideSwitch() {
                            var $active = $('#slideshow IMG.active');

                            if ($active.length == 0)
                                $active = $('#slideshow IMG:last');

                            // use this to pull the images in the order they appear in the markup
                            var $next = $active.next().length ? $active.next()
                                    : $('#slideshow IMG:first');

                            // uncomment the 3 lines below to pull the images in random order

                            // var $sibs  = $active.siblings();
                            // var rndNum = Math.floor(Math.random() * $sibs.length );
                            // var $next  = $( $sibs[ rndNum ] );


                            $active.addClass('last-active');

                            $next.css({opacity: 0.0})
                                    .addClass('active')
                                    .animate({opacity: 1.0}, 1000, function() {
                                $active.removeClass('active last-active');
                            });
                        }

                        $(function() {
                            setInterval("slideSwitch()", 5000);
                        });

                    </script>

                    <style type="text/css">

                        /*** set the width and height to match your images **/

                        #slideshow {
                            position:relative;
                            height:300px;
                        }

                        #slideshow IMG {
                            position:absolute;
                            top:0;
                            left:0;
                            z-index:8;
                            opacity:0.0;
                        }

                        #slideshow IMG.active {
                            z-index:10;
                            opacity:1.0;
                        }

                        #slideshow IMG.last-active {
                            z-index:9;
                        }

                    </style>
                    <script language='javascript'>
                        $(document).ready(function() {
                            $("#register").validate();
                            $('#appnt_btn').click(function() {
                                $('#collapse_appnt').show();
                            });
                        });





                    </script>
                    </head>
                    <body>

                        <div class="header">
                            <div class="loginWrap">
                                <div class="logo">
                                    <?php
                                    $configuration = $this->dashboard_model->getConfiguration();
                                    if ($configuration) {
                                        $conf = mysql_fetch_assoc($configuration);
                                        ?>
                                        <div class="logo"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>images/admin/<?php echo $conf['site_logo']; ?>" alt="" /></a></div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="logo"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>images/logo.png" alt="" /></a></div>
                                    <?php } ?>
                                </div>
                                <!--logo-->
                            </div><!--wrapper-->
                        </div><!--header-->
                        <div class="seperator"></div>
                        <div class="wrapper">
                            <div class="loginWrap">

                                <div class=" floatLeft texts">
                                    <?php
                                    if (isset($home_content) && ($home_content) != NULL) {
                                        $hc = mysql_fetch_assoc($home_content);
                                        echo "<h1>" . $hc['staticpage_title'] . "</h1>";
                                        echo $hc['staticpage_content'];
                                    }
                                    ?>

                                </div>      





                                <!--textss-->

                                <div class="floatRight form">
                                    <?php
                                    if (isset($page)) {
                                        echo "<div class='loginForm'>";
                                        $this->load->view($page);
                                        echo "</div>";
                                    } else {
                                        ?>
                                        <div class="loginForm " id="loginDivForm">
                                            <?php
                                            if (isset($forgot_invalid)) {
                                                echo $forgot_invalid;
                                                ?>
                                                <br /><br /><a href="javascript:history.go(-1)" class="btn btn-primary">Go Back</a>
                                                <?php
                                            } else if (isset($email_error)) {
                                                echo $email_error;
                                                ?>
                                                <br /><br /><a href="javascript:history.go(-1)" class="btn btn-primary" >Go Back</a>
                                                <?php
                                            } else if (isset($forgot_login)) {
                                                $this->load->view($forgot_login);
                                            } else {
                                                ?>
                                                <?php
                                                if (isset($error)) {
                                                    echo "<center><font color='red'>" . $error . "</font></center>";
                                                }
                                                ?>

                                                <form action= "<?php echo base_url(); ?>login/verify" method="post">
                                                    <input type="hidden" name="c" value="<?php echo current_url(); ?>"/>
                                                    <input type="hidden" name="b" value="<?php echo base_url(); ?>trainee/trainee_dashboard"/>
                                                    <h1>Start Here</h1>
                                                    <ul>

                                                        <li>
                                                            <span class="floatLeft">Username</span><input type="text" name="un" class="floatLeft">
                                                                <div class="clear"></div>
                                                        </li>

                                                        <li>
                                                            <span class="floatLeft">Password</span><input type="password" name="pw" class="floatLeft">
                                                                <div class="clear"></div>
                                                        </li>

                                                        <li>
                                                            <span class="floatLeft">Login As</span>
                                                            <select name="as" class="floatLeft">
                                                                <option value="admin">Administrator</option>
                                                                <option value="trainer">Trainer</option>
                                                                <option value="user" selected="selected">User</option>
                                                            </select>
                                                            <div class="clear"></div>
                                                        </li>
                                                        <li>
                                                            <hr />
                                                            <input type="submit" value="Login" class="btn btn-success" style="margin-right:20px;"/>
                                                            <a href="<?php echo site_url('appointment'); ?>" class="btn btn-primary">Book An Appointment</a>
                                                            <a href="<?php echo site_url('enquiry'); ?>" class="btn btn-inverse">Make an Enquiry</a>  <br />
                                                            <hr />
                                                            <a href="<?php echo base_url(); ?>login/forgot_login">Lost Your Password?</a> | <a href="<?php echo base_url(); ?>login/signup">Register</a>

                                                        </li>

                                                    </ul>
                                                </form>

                                            <?php } ?>
                                        </div>

                                        <div class="images loginForm">
                                            <div id="slideshow">
                                                <?php foreach ($allImages as $image) { ?>
                                                    <img src="<?php echo base_url(); ?>slider/<?php echo $image->image_name; ?>"/>
                                                <?php } ?>

                                            </div>
                                        </div>
                                    <?php } ?>
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


                        </div><!--wrapper-->

                        <div class="footer">
                            <?php $footer = $this->site_conf_model->getPageFooter(); ?>    
                            <?php echo $footer->footer_title ?> - Copyright © 
                            <a href="http://<?php echo $footer->footer_link; ?>"><?php echo $footer->footer_copyright; ?></a> 
                        </div>

                    </body>
                    </html>


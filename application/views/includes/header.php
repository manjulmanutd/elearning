<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
<?php
$title=$this->site_conf_model->getPageTitle();
echo $title->page_title;
?></title>

<link href="<?php echo base_url(); ?>css/style.css" type="text/css" rel="stylesheet"/>
<link href="<?php echo base_url();?>css/dashboard.css" type="text/css" rel="stylesheet">
<link href="<?php echo base_url();?>css/bootstrap.css" type="text/css" rel="stylesheet"/>
<link href="<?php echo base_url();?>css/chat.css" type="text/css" rel="stylesheet"/>
 <link href="<?php echo base_url();?>css/screen.css" type="text/css" rel="stylesheet"/>
    <!--link href="<?php echo base_url();?>css/screen_ie.css" type="text/css" rel="stylesheet"/-->
<link href="<?php echo base_url();?>css/jquery-ui.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
<script src='<?php echo base_url();?>js/jquery.js' type="text/javascript"></script>
<script src="<?php echo base_url();?>js/jquery-ui.js"></script>
<script language="javascript" src="<?php echo base_url();?>js/jquery.validate.js"></script>
<script language="javascript" src="<?php echo base_url();?>js/chat.js"></script>
<script language="javascript" src="<?php echo base_url();?>js/check_browser_close.js"></script>

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
            </script>
<style type="text/css">
.error
{
	color:red;
}
</style>
</head>
<body>

<div class="wrapper">
<div class="header">
<h1><?php echo "Welcome To Training Management System ".$this->session->userdata('user'); ?></h1>

</div><!--loginHeader-->
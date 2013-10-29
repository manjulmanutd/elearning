<?php echo "<font color='red'>" . validation_errors() . "</font>"; ?>
<h2>Message Admin</h2>
<div class="seperator"></div>
<form action="<?php echo base_url(); ?>trainee/send_message" method="post" enctype="multipart/form-data" id="trainer_form">

    <h3>Subject</h3>
    <input type='text' name='subject' class="required" />
   
    <h3>Message:</h3>
    <textarea name='message' cols="100"></textarea><br/>
   
    <input type='submit' name='submit' value="Send Email" class="btn btn-primary"/>
</form>
<script type="text/javascript">
    $().ready(function() {		
        $("#trainer_form").validate({
         
            rules: {
                trainee_name: "required",
                email: "required",
                subject: "required",             
                message: "required"
                        
            },
            messages: {
                 trainee_name: "Trainee Name is required",
                email: "Trainer Email is required",
                subject: "Subject is required",             
                message: "Message is required"
            }
        });
			
    });
</script>
<?php echo "<font color='red'>" . validation_errors() . "</font>"; ?>
<h2>Add new trainer</h2>
<div class="seperator"></div>
<form action="<?php echo base_url(); ?>trainers/send_message/<?php echo $trainerDet->trainer_id;?>" method="post" enctype="multipart/form-data" id="trainer_form">

    <h3>Trainer Name</h3>
    <input type='text' name='trainer_name' class="required" disabled value="<?php echo $trainerDet->firstname." ".$trainerDet->lastname;?>"/>

    <h3>Email To:</h3>
    <input type='text' name='email' disabled value="<?php echo $trainerDet->email?>"/>

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
                trainer_name: "required",
                email: "required",
                subject: "required",             
                message: "required"
                        
            },
            messages: {
                 trainer_name: "Trainer Name is required",
                email: "Trainer Email is required",
                subject: "Subject is required",             
                message: "Message is required"
            }
        });
			
    });
</script>
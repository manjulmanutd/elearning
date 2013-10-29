<h2>Message Users</h2>

<div class="seperator"></div>
<form action="<?php echo base_url(); ?>user/send_message_users" method="post" enctype="multipart/form-data" id="trainer_form">

    <h3>Message:</h3>
    <textarea name='message' cols="100"></textarea><br/>
   
    <input type='submit' name='submit' value="Send Message" class="btn btn-primary"/>
</form>
<script type="text/javascript">
    $().ready(function() {		
        $("#trainer_form").validate({
         
            rules: {
                    
                message: "required"
                        
            },
            messages: {
                      
                message: "Message is required"
            }
        });
			
    });
</script>
<a href="<?php echo base_url(); ?>user/viewUserMessages" class="btn btn-inverse">View Messages</a></div>
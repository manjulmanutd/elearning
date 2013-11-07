<div class="h_left"><h2>Add Appointment Remarks (More than 160 words)</h2></div>
<div class="seperator"></div>
<form action="<?php echo base_url(); ?>appointment/completeRemarks/<?php echo $appointment_id;?>" method="post" id="holiday_form">
   
    <h3>Remarks:</h3>
    <textarea name="remarks"></textarea>
    <div class="seperator"></div>
    <input type="submit" value=" Add " class="btn btn-primary">
</form>

<script type="text/javascript">
$().ready(function() {		
        $("#holiday_form").validate({
         
         rules: {
			remarks: {
                            required:true,
                            minlength: 160
                        }
                        
                        
            },
		messages: {
			remarks: {
                            required: "Remarks is required",
                            minlength: "Must be greated than 160 characters"
                        } 
                }
        });
			
    });
</script>

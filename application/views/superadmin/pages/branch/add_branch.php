<div class="h_left"><h2>Add new Branch</h2></div>
<div class="seperator"></div>

<form action="<?php echo base_url();?>branch/add" method="post" id="branch_form">
<h3>Branch Name:</h3>
<input type="text" name="branch_name" id="branchname" />
<h3>Branch Description:</h3>
<textarea name="branch_desc" id="branch_desc" ></textarea>
<h3>Trainer Details:</h3>
<textarea name="trainer_details"></textarea>
<div>Is Active : <input type="checkbox" name="active"></div>
<div class="seperator"></div>
<input type="submit" value=" Add " class="btn btn-primary">
</form>
<script type="text/javascript">
$().ready(function() {		
        $("#branch_form").validate({
         
         rules: {
			branch_name: "required",
			branch_desc: "required"
            },
		messages: {
			branch_name: "Please enter your Branch Name",
			branch_desc: "Please enter your Branch Description"
                }
        });
			
    });
</script>
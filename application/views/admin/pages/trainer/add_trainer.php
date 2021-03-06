<?php echo "<font color='red'>".validation_errors()."</font>"; ?>
<h2>Add new trainer</h2>
<div class="seperator"></div>
<form action="<?php echo base_url();?>trainers/add" method="post" enctype="multipart/form-data" id="trainer_form">
  
  <h3>First Name</h3>
  <input type='text' name='first' class="required"/>
  <h3>Last Name</h3>
  <input type='text' name='last' />
  
  <h3>Username</h3>
  <input type='text' name='user' class="required" />
      <h3>Password<font color="red">*&nbsp;</font></h3>


<input type="password" name="pass" class="required" id="pass"/>
   
      <h3>Confirm Password<font color="red">*&nbsp;</font></h3>
      <input type="password" name="confpass" class="required" id="confpass" />
      <h3>Contact Number</h3>
<input type='text' name='contact'/>
      <h3>Email<font color="red">*&nbsp;</font></h3>
      <input type='text' name='email' class="required" />
      <h3>isActive</h3>
<input type='checkbox' name='active'/>

<div class="seperator"></div>
<input type='submit' name='submit' value="Add" class="btn btn-primary"/>
</form>
<script type="text/javascript">
$().ready(function() {		
        $("#trainer_form").validate({
         
         rules: {
			first: "required",
			last: "required",
                        user:{
                            required: true,
                            minlength: 5
                        },
                        pass: {
                            required: true,
                            minlength: 5
                        },
                        confpass: {
                            required: true,
                            minlength: 5,
                            equalTo: "#pass"
                        },
                        contact: {
                            required: true,
                            minlength: 10
                        },
                        email: {
                            required: true,
                            email: true
                        }
                        
            },
		messages: {
			first: "First Name is Required",
			last: "Last Name is Required",
                        user:{
                            required: "Username is required",
                            minlength: "Minimum length is 5"
                        },
                        pass: {
                            required: "Password is required",
                            minlength: "Minimum length is 5"
                        },
                        confpass: {
                            required: "Confirm Password is required",
                            minlength: "Minimum length is 5",
                            equalTo: "Password should match"
                        },
                        contact: {
                            required: "Contact is required",
                            minlenght: "Minimum length is 10"
                        },
                        email: {
                            required: "Email is required",
                            email: "Not a valid Email"
                        }
                }
        });
			
    });
</script>
<script type="text/javascript">
    function selectCourse(){

     
        var selectedBatch = $("#select_batch").find(':selected').attr('value');
        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>login/getCoursesByBatch/"+selectedBatch,
            data: "",
            success: function(msg){
                      
                $('#course_list').html(msg);
            }

        });
          
    }

    function selectTraining(){

     
        var selectedCourse = $("#course_list").find(':selected').attr('value');
        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>login/getTrainingsByCourse/"+selectedCourse,
            data: "",
            success: function(msg){
                      
                $('#training_list').html(msg);
            }

        });
          
    }

    $(function (){			
        $("#register").validate({
            rules: {
                confpass: {
                    required: true,
                    equalTo: "#pass"
                },
                user:
                    {
                    minlength:5
                }
            },
            messages: {
			
                confpass: {
                    required: "Please provide a password",
                    equalTo: "Please enter the same password as above"
			
                },
                user:
                    {
                    minlength:"Length must be atleast 5 character"
                }
            }
        });
			
    });

  
</script>
<div class="h_left"></div>
<h1><b>Register</b></h1>
<div class="seperator"></div>
<?php echo "<font color='red'>" . validation_errors() . "</font>"; ?>
<form action="<?php echo base_url(); ?>login/signup_verify" method="post" enctype="multipart/form-data" id="signup_form">
    <table>
        <tr><td>First Name<font color="red">*</font></td><td><input type='text' name='first' class="required" value="<?php
if (isset($first)) {
    echo $first;
}
?>"/></td></tr>
        <!--<tr><td>Middle Name</td><td><input type='text' name='middle'/></td></tr> -->
        <tr><td>Last Name</td><td><input type='text' name='last' value="<?php
if (isset($last)) {
    echo $last;
}
?>"/></td></tr>
       <!-- <tr><td>Image</td><td><input type='file' name='image'/></td></tr> 
        <tr><td>DOB</td><td class="dob"> 
        <?php
        $days = range(1, 31);
        $mm = array(
            'January' => 'Jan',
            'February' => 'Feb',
            'March' => 'Mar',
            'April' => 'Apr',
            'May' => 'May',
            'June' => 'Jun',
            'July' => 'Jul',
            'August' => 'Aug',
            'September' => 'Sep',
            'October' => 'Oct',
            'November' => 'Nov',
            'December' => 'Dec'
        );
        $years = range(1930, 2015);
        echo " <select name='dd' style='width:60px;'>";
        foreach ($days as $value) {
            if (isset($dob_day)) {
                if ($dob_day)
                    if ($value == $dob_day)
                        echo '<option value="' . $value . '" selected="selected">' . $value . '</option>\n';
            }
            else {
                echo '<option value="' . $value . '">' . $value . '</option>\n';
            }
        }
        echo '</select>';
        //For month
        echo " <select name='mm' style='width:60px;'>";
        foreach ($mm as $value) {
            if (isset($dob_month)) {
                if ($dob_month)
                    if ($value == $dob_month)
                        echo '<option value="' . $value . '" selected="selected">' . $value . '</option>\n';
            }
            else {
                echo '<option value="' . $value . '">' . $value . '</option>\n';
            }
        }
        echo '</select>';

        //For year 
        echo "<select name='yyyy' style='width:60px;'>";
        foreach ($years as $value) {
            if (isset($dob_year)) {
                if ($dob_year)
                    if ($value == $dob_year)
                        echo '<option value="' . $value . '" selected="selected">' . $value . '</option>\n';
            }
            else
                echo '<option value="' . $value . '">' . $value . '</option>\n';
        }
        echo '</select>';
        ?>
        </td></tr> -->
        <tr><td>Username<font color="red">*&nbsp;</font></td><td><input type='text' name='user' class="required" value="<?php
                                                                                if (isset($user)) {
                                                                                    echo $user;
                                                                                }
        ?>"/></td></tr>
        <tr><td>Password<font color="red">*&nbsp;</font></td><td><input type="password" name="pass" class="required" id="pass"  value="<?php
                if (isset($pass)) {
                    echo $pass;
                }
        ?>"/></td></tr>
        <tr><td>Confirm Password<font color="red">*&nbsp;</font></td><td><input type="password" name="confpass" class="required" id="confpass"  value="<?php
                    if (isset($pass)) {
                        echo $pass;
                    }
        ?>"/></td></tr>
        <!-- <tr><td>Gender</td><td><input type='radio' name='gender' value="male" class="required"/>&nbsp;Male&nbsp;<input type="radio" name="gender" value="female" class="required"/>&nbsp;Female</td></tr> -->
        <tr><td>Branch</td><td><select name='branch' id="select_batch">
                    <option value="">Select a Branch</option>
                    <?php foreach ($allBranches as $branch): ?>
                        <option value="<?php echo $branch->branch_id; ?>"><?php echo $branch->branch_name; ?></option>
<?php endforeach; ?>


                </select></td></tr>
        <tr><td>Course</td><td><select name='course' id="course_list">
                    <option value="">Select a Course</option>
<?php foreach ($allCourses as $course): ?>

                        <option value="<?php echo $course->course_id; ?>"><?php echo $course->course_name; ?></option>
<?php endforeach; ?>
                </select></td></tr>


        <tr><td>Contact Number</td><td><input type='text' name='contact' value="<?php
if (isset($contact)) {
    echo $contact;
}
?>"/></td></tr>
       <!-- <tr><td>City/Town</td><td><input type='text' name='city'/></td></tr> -->
        <!-- <tr><td>Province/State</td><td><input type='text' name='province'/></td></tr>
        <tr><td>Postal Code/Zip Code</td><td><input type='text' name='postal'/></td></tr>
        <tr><td>Country</td><td>
        <select name="country">
<?php
$country = $this->login_model->getCountry();
while ($co = mysql_fetch_assoc($country)) {
    $countries = $co['countryName'];
    echo "<option value='" . $countries . "'>" . $countries . "</option>";
}
?>
         </select>
        </td></tr> -->
        <tr><td>Email<font color="red">*&nbsp;</font></td><td><input type='text' name='email' class="required" value="<?php
if (isset($email)) {
    echo $email;
}
?>"/></td></tr>
    </table>
    <div class="seperator"></div>
    <input type='submit' name='submit' value="Sign Up" class="btn btn-primary"/>
</form>
<script type="text/javascript">
    $().ready(function() {		
        $("#signup_form").validate({
         
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
                branch:{
                    required: true
                },
                course: {
                    required: true
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
                branch:{
                    required: "Please Select a branch"
                },
                course: {
                    required: "Please select a course"
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
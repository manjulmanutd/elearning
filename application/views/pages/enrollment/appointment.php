<script src='<?php echo base_url(); ?>jquery.js' type="text/javascript"></script>
<script src='<?php echo base_url(); ?>js/jsDatePick.jquery.min.1.3.js' type="text/javascript"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.validate.js"></script>
<link href="<?php echo base_url(); ?>js/jsDatePick_ltr.min.css" type="text/css" rel="stylesheet"/>
<script language='javascript'>
    
    $(function() {
        new JsDatePick({
            useMode:2,
            target:"datepicker",
            dateFormat:"%Y-%m-%d"
                                
        });
    });
        
    function getTimeSlots(){

     
        var selectedBranch = $("#select_branch").find(':selected').attr('value');
        var selectedDate = $("#datepicker").attr('value');
        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>appointment/getTimeSlots/"+selectedBranch+"/"+selectedDate,
            data: "",
            success: function(msg){
                      
                $('#timeslot_list').html(msg);
            }

        });
          
    }
    
    function getBranchAdmins(){
        
        var selectedBranch = $("#select_branch").find(":selected").attr('value');
        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>appointment/getBranchAdmins/"+selectedBranch,
            data: "",
            success: function(msg){
                      
                $('#admin_list').html(msg);
            }

        });
    }
                        
        
        
       
</script>

<div class="h_left"><h2>Book An Appointment</h2></div>    
<div class="seperator"></div>

<form action= "<?php echo base_url(); ?>appointment/bookSession" method="post" id="appointment_form">
    <input type="hidden" value="<?php echo $user->user_id; ?>" name="user_id"/>
    <h4>First Name:</h4>
    <input type="text" value="<?php echo $user->first_name; ?>" disabled/>
    <input type="hidden" name="firstname" value="<?php echo $user->first_name; ?>"/>

    <h4>Sur Name:</h4>
    <input type="text"  value="<?php echo $user->last_name; ?>" disabled/>
    <input type="hidden" name="lastname" value="<?php echo $user->last_name; ?>"/>

    <h4>Phone No:</h4>
    <input type="text" value="<?php echo $user->contact_number; ?>" disabled/>
    <input type="hidden" name="contact" value="<?php echo $user->contact_number; ?>"/>

    <h4>Email Address:</h4>
    <input type="text"  value="<?php echo $user->email; ?>" disabled/>
    <input type="hidden" name="email" value="<?php echo $user->email; ?>"/>  

    <h4>Choose Appointment Date:</h4>
    <input id="datepicker" type="text" name="appointment_date"/>

    <h4>Branch:</h4>
    <select id="select_branch" name="branch_id" onchange="getTimeSlots();getBranchAdmins();">
        <option value=""> Select Branch</option>
        <?php foreach($allBranches as $branch):?>
        <option value="<?php echo $branch->branch_id; ?>"><?php echo $branch->branch_name; ?></option>
        <?php endforeach;?>
    </select>

    <input type="hidden" name="course_id" value="<?php echo $this->uri->segment('3'); ?>"/>



    <h4>Choose Avaliable Time Slot:</h4>
    <select name='timeslot_id' id="timeslot_list">
        <option value="">Select Date First</option>


    </select>
    
    
    <h4>Choose Avaliable Admins:</h4>
    <select name='admin_id' id="admin_list">
        <option value="">Select Branch First</option>


    </select>
    <div class="clear"></div>


    <h4>Any Specific Requirements:</h4>
    <textarea name="specific_requirements"></textarea> 


    <hr />
    <input type="submit" value="Submit" class="btn btn-success" style="margin-right:20px;"/>

    <br />
    <hr />




</form>

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
                timeslot_id: "required",
                admin_id:"admin_id"
            },
            messages: {
                firstname: "First Name is required",
                lastname: "Sur Name is required",
                phone: "Phone Number is required",
                email: "Email is required",
                appointment_date: "Date is equired",
                branch_id: "Branch is required",
                timeslot_id: " Timeslot is required",
                admin_id: " Admin is required"
            }
        });
            
    });
</script>

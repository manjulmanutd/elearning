 <link href="<?php echo base_url(); ?>js/jsDatePick_ltr.min.css" type="text/css" rel="stylesheet"/>
 <script src='<?php echo base_url(); ?>js/jsDatePick.jquery.min.1.3.js' type="text/javascript"></script>
 <script>
                        $(function() {
                            new JsDatePick({
                                useMode:2,
                                target:"datepicker",
                                dateFormat:"%Y-%m-%d"
                                
                            });
                        });
                    </script>
<div class="h_left"><h2>Add new Holiday (Non Working Day)</h2></div>
<div class="seperator"></div>
<form action="<?php echo base_url(); ?>appointment/insert_holiday" method="post" id="holiday_form">
    <h3>Choose Date:</h3>
    <input type="text" id="datepicker" name="holiday_date"/>
    <h3>Remarks:</h3>
    <textarea name="holiday_remarks"></textarea>
    <div class="seperator"></div>
    <input type="submit" value=" Add " class="btn btn-primary">
</form>

<script type="text/javascript">
$().ready(function() {		
        $("#holiday_form").validate({
         
         rules: {
			holiday_date: "required",
			holiday_remarks: "required"
                        
            },
		messages: {
			holiday_date: "Date is required",
			holiday_remarks: "Remarks is required"
                }
        });
			
    });
</script>

<script language="javascript" src="<?php echo base_url();?>js/jquery.validate.js"></script>
<div class="h_left">
    <h2>Partial Payment</h2>
    <?php
    $courseId = $this->uri->segment('3');
    $courseName = $this->paypal_model->getCourseNameById($courseId)->course_name;
    $dueAmount = $this->paypal_model->getDueFee($courseId);
    ?>
    <h3><?php echo $courseName; ?></h3>
    <h3>Due Fee: <?php echo $dueAmount . "£"; ?></h3>
</div>
<div class="seperator"></div>
<form action="<?php echo base_url(); ?>enroll/payPartialAmount/<?php echo $courseId;?>" method="post" id="course_form">

    <h3>Pay Now (£):</h3>
    <input type="text" name="payment_fee"/>
    <div class="seperator"></div>
    <input type="submit" value=" Pay Fee " class="btn btn-primary"/>
</form>
<script type="text/javascript">
    $().ready(function() {		
        $("#course_form").validate({
         
            rules: {
                payment_fee: {
                    required: true,
                    number: true
                }
              },
            messages: {
                payment_fee: {
                    required: "Payment Fee is Required" ,
                    number: "Must be a number"
                }
            }
        });
			
    });
</script>

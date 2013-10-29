<h2>You are now enrolled to <?php echo $this->trainee_model->getCourseDetailsById($courseId)->course_name;?></h2>
<h3>Course Fee: <?php echo '£'.$this->trainee_model->getCourseDetailsById($courseId)->course_fee;?></h3>

<a href ="<?php echo base_url(); ?>enroll/payFullFee/<?php echo $courseId; ?>" class='btn btn-info'>Pay 100% Now</a>
<a href ="<?php echo base_url(); ?>enroll/payHalfFee/<?php echo $courseId; ?>" class='btn btn-info'>Pay 50% Now</a> <br/>

Instead you can also book an appointment here:
<a href="<?php echo base_url(); ?>appointment/enroll/<?php echo $courseId; ?>" class="btn btn-primary">Book an Appointment</a>
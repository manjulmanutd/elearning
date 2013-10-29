<script type="text/javascript">
    function show_confirm()
    {
        return confirm("Are you sure you want to remove the user?");
    }
</script>
<div class="h_left"><h2>User Manager</h2></div>

<div class="seperator"></div>
<div class="add_new"><a href="<?php echo base_url(); ?>admin/view_logs" class="btn btn-inverse">View User Logs</a>
    <a href="<?php echo base_url(); ?>user/addUser" class="btn btn-info">Add Trainee</a>
    <a href="<?php echo base_url(); ?>user/messageUsers" class="btn btn-inverse">Message All Trainees</a></div>

<div class="seperator"></div>
<?php
if ($user) {
    ?>
    <table width="100%">
        <tr>
            <th>S/N</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Username</th>
            <th>Enrollment</th>
            <th>Action</th>
        </tr>
        <?php
        if ($user) {
            $i = 0;
            while ($c = mysql_fetch_assoc($user)) {
                $enrollment = $this->user_model->getUserEnrollmentStatus($c['user_id']);
                // print_r($enrollment);
                $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td class='c_right'> 
                        <a href = "<?php echo base_url(); ?>user/view_user/<?php echo $c['user_id']; ?>" class='btn btn-info'>
                            <?php echo $c['first_name'] . " " . $c['last_name']; ?>
                        </a>
                    </td>
                    <td class='c_right'><?php echo $c['email']; ?></td>
                    <td class='c_right'><?php echo $c['username']; ?></td>
                    <td class='c_right'>
                        <?php if (!empty($enrollment)) { ?>
                            <a href = "<?php echo base_url(); ?>user/view_enrollment/<?php echo $c['user_id']; ?>" class='btn btn-info'>Enrollment Details</a> 
                        <?php } else {
                            ?>
                            <a href="<?php echo base_url(); ?>user/enroll_user/<?php echo $c['user_id']; ?>" class="btn btn-success">Enroll Now</a>
                        <?php }
                        ?>
                    </td>
                    <td class='action'>
                        <a href= "<?php echo base_url(); ?>user/remove/<?php echo $c['user_id']; ?>" onclick='return show_confirm()' class='btn btn-danger'>Remove</a> 
                        <a href = "<?php echo base_url(); ?>user/course_history/<?php echo $c['user_id']; ?>" class='btn btn-info'>Course History</a> 
                        <a href = "<?php echo base_url(); ?>user/getPaymentHistory/<?php echo $c['user_id']; ?>" class='btn btn-inverse'>Payment History</a> 
                        <a href = "<?php echo base_url(); ?>user/message_user/<?php echo $c['user_id']; ?>" class='btn btn-inverse'>Message</a>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </table>
<?php } else { ?>
    <h2>No Trainees Found</h2>
<?php } ?>

<script type="text/javascript">
    function show_confirm()
    {
        return confirm("Are you sure you want to mark the Appointment as complete?");	
    }
</script>
<div class="h_left"><h2>Appointment Management </h2></div>
<div class="seperator"></div>
<div class="add_new">
    <a href="<?php echo base_url() ?>appointment/configure_working_days" class="btn btn-danger">Configure Week Days</a>
    <a href="<?php echo base_url() ?>appointment/configure_holidays" class="btn btn-info">Configure Holidays</a>
    <a href="<?php echo base_url(); ?>timeslot/list_appointment_timeslots" class="btn btn-inverse">Manage Time Slots</a>
    <a href="<?php echo base_url(); ?>appointment/view_appointment_history" class="btn btn-inverse">Appointment History</a>
    <!--a href="<?php echo base_url() ?>appointment/configure_working_days" class="btn btn-danger">Configure Working Days</a--></div>
<div class="seperator"></div>

<?php
if (!empty($allAppointments)) {
    ?>
    <table width="90%">
        <tr>
            <th>S/N</th>
            <th>Full Name</th>
            <th>Phone Number</th>
            <th>Email Address</th>
            <th>Selected Date</th>
            <th>Selected Time Slot</th>
            <th>Specific Requirements</th>
            <th>Action</th>
        </tr>


        <?php
        $i = 0;
        foreach ($allAppointments as $appointment):
            $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td class='c_right'><?php echo $appointment->firstname . " " . $appointment->lastname; ?></td>
                <td class='c_right'><?php echo $appointment->phoneno; ?></td>
                <td class='c_right'><?php echo $appointment->email; ?></td>
                <td class='c_right'><?php echo $appointment->appointment_date; ?></td>
                <td class='c_right'>
                    <?php if(!empty($appointment->timeslot_id)){echo $this->appointment_model->getTimeSlot($appointment->timeslot_id)->start_time . " to " . $this->appointment_model->getTimeSlot($appointment->timeslot_id)->end_time;} ?></td>
                <td class='c_right'><?php echo $appointment->requirements; ?></td>
                <td class='action'>
                    <?php if($appointment->status == 1){?>
                    <a href="<?php echo base_url(); ?>appointment/remove/<?php echo $appointment->appointment_id; ?>" onclick='return show_confirm()' class='btn btn-danger'>Mark Complete</a> 
                    <?php } else {?>
                    <a href="#" class='btn btn-info'>Completed</a> 
                    <?php } ?>
                </td>
            </tr>
            <?php
        endforeach;
        ?>
    </table>
    <?php echo $this->pagination->create_links(); ?>
    <?php
} else {
    ?>
    <h3>No Appointments found
    <?php } ?>



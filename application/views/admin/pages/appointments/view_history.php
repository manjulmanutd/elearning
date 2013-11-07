<script type="text/javascript">
    function show_confirm()
    {
        return confirm("Are you sure you want to mark the Appointment as complete?");	
    }
</script>
<div class="h_left"><h2>Appointment History </h2></div>
<div class="seperator"></div>


<?php
if (!empty($allAppointments)) {
    ?>
    <table width="100%">
        <tr>
            <th>S/N</th>
            <th>Full Name</th>
            <th>Phone Number</th>
            <th>Email Address</th>
            <th>Selected Date</th>
            <th>Selected Time Slot</th>
            <th>Specific Requirements</th>
            <th>Remarks</th>
            
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
                    <?php 
                    if(!empty($appointment->timeslot_id)){echo $this->appointment_model->getTimeSlot($appointment->timeslot_id)->start_time . " to " . $this->appointment_model->getTimeSlot($appointment->timeslot_id)->end_time; }?></td>
                <td class='c_right'><?php echo $appointment->requirements; ?></td>
                <td><?php echo $appointment->remarks; ?></td>
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



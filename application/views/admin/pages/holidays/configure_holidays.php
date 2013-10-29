<script type="text/javascript">
    function show_confirm()
    {
        return confirm("Are you sure you want to remove the non working day?");	
    }
</script>
<div class="h_left"><h2>Manage Holidays (Non-Working Days)</h2></div>
<div class="seperator"></div>
<div class="add_new"><form action="<?php echo base_url(); ?>schedule/add_holiday" method="post"><input type="submit" value="Add new" name="add" class="btn btn-inverse"></form></div>
<?php if(!empty($allHolidays)) {?>
<table width="80%">
    <tr>
        <th>S/N</th>
        <th>Date</th>
        <!--th>Title</th-->
        <th>Remarks</th>
        <th>Action</th>
    </tr>



    <?php
    if ($allHolidays) {
        $i = 0;
        foreach ($allHolidays as $holiday):
            $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td class='c_right'><?php echo $holiday->holiday_date; ?></td>
                <td class='c_right'><?php echo $holiday->holiday_remarks; ?></td>

                <td class='action'>
                    <a href="<?php echo base_url(); ?>schedule/remove_holiday/<?php echo $holiday->holiday_id; ?>" onclick='return show_confirm()' class='btn btn-danger'>Remove</a> 
                </td>
            </tr>
            <?php
        endforeach;
    }
    ?>

</table>
<?php } else {?>
<h2> No Holidays Found</h2>
<?php } ?>

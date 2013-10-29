<script type="text/javascript">
    function show_confirm()
    {
        return confirm("Are you sure you want to remove the message?");	
    }
</script>
<div class="h_left"><h2>Messages to Users</h2></div>

<div class="seperator"></div>
<div class="add_new">
    <a href="<?php echo base_url(); ?>user/messageUsers" class="btn btn-info">Send Message to User</a>
</div>
<div class="seperator"></div>
<?php
if($messages)
{ ?>
<table width="80%">
<tr>
<th>S/N</th>
<th>Message</th>
<th>Sent Date</th>
<th>Action</th>
</tr>



<?php
if($messages)
{
    $i = 0;
    foreach($messages as $message):
        $i++;
        echo "<tr><td>".$i."</td><td class='c_right'>".$message->message."</td><td class='c_right'>".$message->sent_date."</td><td class='action'><a href= '".base_url()."user/removeUsersMessage/".$message->ann_id."' onclick='return show_confirm()' class='btn btn-danger'>Remove</a> </td></tr>";
    endforeach;
}
?>

</table>
<?php } else {?>
<h3>No messagees</h3>
<?php } ?>
<div class="h_left"><h2>Announcements</h2></div>

<div class="seperator"></div>

<div class="seperator"></div>
<?php
if($messages)
{ ?>
<table width="80%">
<tr>
<th>S/N</th>
<th>Message</th>
<th>Sent Date/Time</th>

</tr>



<?php
if($messages)
{
    $i = 0;
    foreach($messages as $message):
        $i++;
        echo "<tr><td>".$i."</td><td class='c_right'>".$message->message."</td><td class='c_right'>".$message->sent_date."</td></tr>";
    endforeach;
}
?>

</table>
<?php } else {?>
<h3>No messagees</h3>
<?php } ?>
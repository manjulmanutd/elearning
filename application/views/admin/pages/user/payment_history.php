<script type="text/javascript">
function show_confirm()
{
return confirm("Are you sure you want to remove the batch?");	
}
</script>
<div class="h_left"><h2>Payment History</h2></div>
<div class="seperator"></div>



<?php if(!empty($allPayments)){?> 
<div id="tableList">
 
<table width="80%">
<tr>
<th>S/N</th>
<th>Course</th>
<!--th>Title</th-->
<th>Payment Fee</th>
<th>Due Fee</th>
<th>Status</th>
<th>Action</th>
</tr>



<?php
if($allPayments)
{
	$i = 0;
	foreach($allPayments as $payment):
		$i++;
	?>
		<tr>
			<td><?php echo $i;?></td>
                        <td><?php echo $this->user_model->getCourseNameById($payment->course_id)->course_name;?></td>
			
                        <td><?php echo '£ '.$payment->payment_fee;?></td>
                         <td><?php $courseAmount = $this->user_model->getCourseAmountById($payment->course_id)->course_fee;
                                echo '£ '.($courseAmount - $payment->payment_fee);
                        ?>
                           
                        </td>
                         <td><?php  if($payment->status==2) {
                           echo "50% Payment Completed";
                        }
                        else if($payment->status==1){
                            echo "Payment Completed";
                        }else if($payment->status==0){
                            echo "Not Paid";
                        };?></td>
			<td class='action'>
                            <?php if($payment->status==0 || $payment->status==2){?>
                            <a href ="<?php echo base_url();?>user/completePayment/<?php echo $payment->course_id;?>/<?php echo $payment->user_id;?>" class='btn btn-danger'>Complete Payment</a>
                            <a href ="<?php echo base_url();?>user/partialPayment/<?php echo $payment->course_id;?>/<?php echo $payment->user_id;?>" class='btn btn-success'>Partial Payment</a>
                            <?php } else if($payment->status==3) {?>
                            <a href ="<?php echo base_url();?>user/clearPayment/<?php echo $payment->course_id;?>/<?php echo $payment->user_id;?>" class='btn btn-info'>Clear Fees</a>
                            <?php } else {?>
                            <a href ="#" class='btn btn-info'>Payment Completed</a>
                            <?php } ?>
                        </td>
		</tr>
	<?php
		endforeach;
}
?>

</table>
</div>

<?php } else { ?>
<h2>No Payment History Found</h2>
<?php } ?>

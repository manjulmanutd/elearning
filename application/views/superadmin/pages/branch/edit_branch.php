<?php 
if($branchById)
{

?>
<div class="h_left"><h2>Edit Branch</h2></div>
<div class="seperator"></div>
<form action="<?php echo base_url();?>branch/edit/<?php echo $branchById->branch_id;?>" method="post" id="branch_form">

<h3>Branch Name:</h3>
<input type="text" name="branch_name" value ="<?php echo $branchById->branch_name;?>"/>
<h3>Description:</h3>
<textarea name="branch_desc"><?php echo $branchById->branch_desc;?></textarea>
<h3>Trainer Details:</h3>
<textarea name="trainer_details"><?php echo $branchById->trainer_details;?></textarea>
<div>Is Active : <input type="checkbox" name="active" <?php if($branchById->status == 1){ echo "checked = 'checked'";}?>></div>
<div class="seperator"></div>
<input type="submit" value=" Save Changes" class="btn btn-primary">

</form>
<?php 
}
?>
<script type="text/javascript">
$().ready(function() {		
        $("#branch_form").validate({
         
         rules: {
			branch_name: "required",
			branch_desc: "required"
            },
		messages: {
			branch_name: "Please enter your Branch Name",
			branch_desc: "Please enter your Branch Description"
                }
        });
			
    });
</script>
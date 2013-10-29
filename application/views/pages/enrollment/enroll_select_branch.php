

<form name="select_branch1" method="POST" action="<?php echo base_url()?>trainee/enrollAnother">
    <input type="hidden" name="branch_id" value="<?php echo $branchId;?>"/>
    <input type="submit" class="btn btn-info" value="Continue with the same branch"/>
</form>

OR

<form name="select_branch" method="POST" action="<?php echo base_url()?>trainee/enrollAnother">
<select name="branch_id">
    <option value="0">Select a branch to Proceed</option>
    <?php foreach($allBranches as $branch):?>
    <option value="<?php echo $branch->branch_id;?>"><?php echo $branch->branch_name;?></option>
    <?php endforeach;?>
</select>
<input type="submit" class="btn btn-info" value="Proceed with new branch"/>    
</form>
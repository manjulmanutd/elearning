<?php 
if($records)
{
$recs = mysql_fetch_assoc($records);
?>
<div class="h_left"><h2>Edit Course</h2></div>
<div class="seperator"></div>
<form action="<?php echo base_url();?>category/edit/<?php echo $recs['cat_id'];?>" method="post">

<h3>Title:</h3>
<input type="text" name="title" value = "<?php echo $recs['cat_title'];?>">
<h3>Description:</h3>
<textarea name="desc"><?php echo $recs['cat_description'];?></textarea>
<div>Is Active : <input type="checkbox" name="active" <?php if($recs['status'] == 1){ echo "checked = 'checked'";}?>></div>
<div class="seperator"></div>
<input type="submit" value=" Save Changes" class="btn btn-primary">

</form>
<?php 
}
?>
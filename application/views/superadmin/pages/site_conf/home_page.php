<div class="h_left"><h2>Manage Home Page</h2></div>
<div class="seperator"></div>

<form action="<?php echo base_url();?>superadmin/updateHomePage" method="post" id="branch_form">
<h3>Title:</h3>
<input type="text" name="staticpage_title" id="branchname" value="<?php echo $homePage->staticpage_title;?>" />
<h3>Content:</h3>

<textarea name="staticpage_content" rows="20" style="width: 800px !important" id="staticpage_content" ><?php echo $homePage->staticpage_content;?></textarea><br/>
<?php echo display_ckeditor($ckeditor);?>
<input type="submit" value=" Update " class="btn btn-primary"/>
</form>
<script type="text/javascript">
$().ready(function() {		
        $("#branch_form").validate({
         
         rules: {
			staticpage_title: "required",
			staticpage_content: "required"
            },
		messages: {
			staticpage_title: "Please enter Title",
			staticpage_content: "Please enter Content "
                }
        });
			
    });
</script>
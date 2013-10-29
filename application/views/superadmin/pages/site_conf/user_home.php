<div class="h_left"><h2>Manage What User Sees at home page</h2></div>
<div class="seperator"></div>

<form action="<?php echo base_url();?>superadmin/updateUserHome" method="post" id="branch_form">

<h3>User Home Content:</h3>
<textarea name="user_home" rows="20" style="width: 800px !important" id="branch_desc" ><?php if(!empty($userHome))echo $userHome->staticpage_content;?></textarea><br/>
<?php echo display_ckeditor($ckeditor);?>
<input type="submit" value=" Update " class="btn btn-primary">
</form>
<script type="text/javascript">
$().ready(function() {		
        $("#branch_form").validate({
         
         rules: {
			user_home: "required"
			
            },
		messages: {
			user_home: "Please enter contents on User Home"
			
                }
        });
			
    });
</script>
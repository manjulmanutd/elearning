<div class="h_left"><h2>Manage Terms and Conditions</h2></div>
<div class="seperator"></div>

<form action="<?php echo base_url();?>superadmin/updateTerms" method="post" id="branch_form">

<h3>Terms and Conditions:</h3>
<textarea name="terms" rows="20" style="width: 800px !important" id="branch_desc" ><?php if(!empty($terms))echo $terms->terms;?></textarea><br/>
<?php echo display_ckeditor($ckeditor);?>
<input type="submit" value=" Update " class="btn btn-primary">
</form>
<script type="text/javascript">
$().ready(function() {		
        $("#branch_form").validate({
         
         rules: {
			terms: "required"
			
            },
		messages: {
			terms: "Please enter Terms and Conditions"
			
                }
        });
			
    });
</script>
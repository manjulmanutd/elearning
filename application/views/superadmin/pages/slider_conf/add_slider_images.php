<div class="h_left"><h2>Add New Image</h2></div>
<div class="seperator"></div>

<form action="<?php echo base_url();?>superadmin/addSliderImage" method="post" id="branch_form" enctype="multipart/form-data">
<h3>Image (Best Resolution: 540*350):</h3>
<input type="file" name="image_name" id="branchname" />
<div class="seperator"></div>
<input type="submit" value=" Add " class="btn btn-primary">
</form>
<script type="text/javascript">
$().ready(function() {		
        $("#branch_form").validate({
         
         rules: {
			image_name:{
                            required: true,
                            accept:""
                        } 
                        
			
            },
		messages: {
			image_name:{
                            required: "Please Upload an Image",
                            accept:"Suppported Formats jpg,png,jpeg"
                        } 
			
                }
        });
			
    });
</script>
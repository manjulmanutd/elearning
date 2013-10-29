<script type="text/javascript">
    function show_confirm()
    {
        return confirm("Are you sure you want to remove the image?");	
    }
</script>
<div class="h_left"><h2>Slider Images Management </h2></div>
<div class="seperator"></div>
<div class="add_new"><form action="<?php echo base_url(); ?>superadmin/add_slider_images" method="post"><input type="submit" value="Add new" name="add" class="btn btn-inverse"></form></div>
<?php
if ($allImages) {
    ?>
    <table width="50%">
        <tr>
            <th>S/N</th>
            <th>Image</th>
            <th>Action</th>
        </tr>



        <?php
        if ($allImages) {
            $i = 0;
            foreach ($allImages as $image):
                $i++;
                ?>
                <tr><td><?php echo $i;?></td>
                    <td class='c_right'>
                        <img src="<?php echo base_url();?>slider/<?php echo $image->image_name?>" height="75" width="75"/></td>
                    <td class='action'>
                        <a href="<?php echo base_url();?>superAdmin/removeImage/<?php echo $image->image_id;?>" onclick='return show_confirm()' class='btn btn-danger'>Remove</a>
                    </td>
                </tr>
            <?php
            endforeach;
        }
        ?>

    </table>
<?php } else { ?>
    <h3>No Slider Images</h3>
<?php } ?>

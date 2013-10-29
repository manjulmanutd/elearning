<script language="javascript">
$(function(){
		   $('#lesson').validate();
		   });
	
</script>
<div class="h_left"><h2>Edit Document</h2></div>
<div class="seperator"></div>
<?php 
if($document)
{

?>
<form action="<?php echo base_url();?>document_manager/update_document/<?php echo $document->doc_id;?>" method="post" enctype="multipart/form-data" id="upload">

<h3>Title&nbsp;<font color="red">*</font>:</h3>
<input type="text" name="title" value="<?php echo $document->doc_title;?>" class="required">
<h3>Description:</h3>
<textarea name="desc"><?php echo $document->doc_desc;?></textarea>
<h3 id="fyl">File:</h3>
<input type="file" name="file" id="file"value="<?php echo $document->doc_file;?>"><br>
<?php 
if($document->doc_file!=NULL) 
{ 
	$path=base_url().'document_manager/view_document/'.$document->doc_id;?>
	<a href="<?php echo $path;?>" class="btn btn-info" id="view">View Now</a> 
<?php
}
else echo "<br><h3><b><font color='red'>The document does not have any files.</font></b></h3>";
?>
<h3>For Schedule:</h3>
<select name="schedule_id">
    <?php foreach($allSchedules as $schedule) :
       if($schedule->training_id == $document->schedule_id){
                     		$selected = "selected";
                     	}
                     	else {
                     		$selected = "";
                     	}  
        ?>
    
   <option <?php echo $selected;?> value="<?php echo $schedule->training_id; ?>"><?php echo $this->document_model->getCourseNameById($schedule->course_id)->course_name." ".$this->document_model->getLessonNameById($schedule->lesson_id)->lesson_name." ( ".date('d M Y',strtotime($schedule->training_date)).")";; ?></option>
    <?php endforeach; ?>
</select>
<div id="down">Is Downloadable : <input type="checkbox" name="download" <?php if($document->isDownloadable==1) {?> checked="checked" <?php } ?>></div>
<div>Is Active : <input type="checkbox" name="active" <?php if($document->status==1) {?> checked="checked" <?php } ?>></div>
<div class="seperator"></div>
<input type="submit" value=" Save Changes " class="btn btn-primary">
</form>
<?php 
}
?>
<script type="text/javascript">
$().ready(function() {		
        $("#upload").validate({
         
         rules: {
			title: "required",
                       // file: "required",
                        schedule_id: "required"
			                       
            },
		messages: {
			
			title: "Title is required",
                        //file: "Please select a file",
                        schedule_id: "Please select a schedule"
                }
        });
			
    });
</script>
<?php if (!empty($allDocs)) {
    
    $trainingDate = $this->trainee_model->getTrainingDate($this->uri->segment('3'))->training_start_date;
           // echo $trainingDate;
            $dateString = "%Y-%m-%d";
            $time = time();
            $today = mdate($dateString, $time);

            if (strtotime($trainingDate) > strtotime($today)) {
                $trainingStatus = 0;
            } else {
                $trainingStatus = 1;
            }
    if($trainingStatus != 0){
    ?>

<div class="seperator"></div>


    <table width="90%">
        <tr>
            <th>S/N</th>
            <th>Title</th>
            <th>Lesson</th>
            <th>Document Action</th>
      </tr>

        <?php
        if ($allDocs) {
            $i = 0;
            foreach ($allDocs as $document):
                $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td class='c_right'><?php echo $document->doc_title; ?></td>
                    <td class='c_right'><?php echo $this->trainee_model->getLessonNameById($document->lesson_id)->lesson_name; ?></td>
                    <td class='action'>
                       
                        <?php if ($document->doc_file != NULL) { ?>
                            <a href ="<?php echo base_url(); ?>trainee/view_docs/<?php echo $document->doc_id; ?>" class='btn btn-danger'>View File</a>
                        <?php } else { echo $document->doc_file;?>
                            <b> The document has no file</b>
                        <?php } ?>
                        <?php if ($document->doc_file != NULL && $document->isDownloadable == 1) { ?>
                            <a href ="<?php echo base_url(); ?>trainee/download/<?php echo $document->doc_id; ?>" class='btn btn-info'>Download File</a>
                        <?php } else { ?>
                            <b> The document has no file</b>
                        <?php } ?>
                            
                    </td>
                   
                </tr>
            <?php endforeach;
        } ?>

    </table>
<?php }
else { ?>
<h3>Lesson Not Started</h3>
<?php }
} else { ?>
    <h3> No Assignments found</h3>
<?php } ?>

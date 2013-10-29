<?php

class Document_model extends CI_Model {

    function getAllSchedules() {

       $trainer = $this->session->userdata('trainer');
        $result = $this->db->get_where('tbl_trainer', array('username' => $trainer))->row();
        $trainer_id = $result->trainer_id;
        
        $this->db->select('*');
        $this->db->from('tbl_training');
        //$this->db->join('tbl_training_bookings', 'tbl_training_bookings.training_id = tbl_training.training_id');
        $this->db->join('tbl_course_trainer', 'tbl_course_trainer.course_id = tbl_training.course_id');
        $this->db->join('tbl_course','tbl_course.course_id=tbl_training.course_id');
        $this->db->where('tbl_course_trainer.trainer_id',$trainer_id);
        $this->db->order_by('tbl_training.training_date');
        $this->db->order_by('tbl_training.course_id');
        //$this->db->where('tbl_training.training_status',0);
             
        return $this->db->get()->result();
    }

    function add_document() {
        $title = $_POST['title'];
        $desc = $_POST['desc'];
        if (isset($_POST['active'])) {
            $active = 1;
        }
        else
            $active = 0;
        if (isset($_POST['download'])) {
            $dl = 1;
        }
        else
            $dl = 0;

        $schedule_id = $this->input->post('schedule_id');
        $lessonId = $this->db->get_where('tbl_training', array('training_id' => $schedule_id))->row();

        $file_name = time() . "_" . rand("100000", "999999");
        $ext = end(explode('.', $_FILES['file']['name']));
        $complete = $file_name . "." . $ext;
        $path = str_replace('system/', '', BASEPATH) . '/docs/' . $complete;
        if (move_uploaded_file($_FILES['file']['tmp_name'], $path)) {
            $data = array('doc_title' => $title,
                'doc_desc' => $desc,
                'doc_file' => $complete,
                'isDownloadable' => $dl,
                'schedule_id' => $schedule_id,
                'lesson_id' => $lessonId->lesson_id,
                'doc_type' => 1,
                'status' => $active
            );

            $this->db->insert('tbl_doc', $data);
        } else {

            $data = array('doc_title' => $title,
                'doc_desc' => $desc,
                'doc_file' => '',
                'isDownloadable' => $dl,
                'schedule_id' => $schedule_id,
                'lesson_id' => $lessonId->lesson_id,
                'doc_type' => 1,
                'status' => $active
            );

            $this->db->insert('tbl_doc', $data);
        }

        $this->db->select('*');
        $this->db->from('tbl_users');
        $this->db->join('tbl_training_users', 'tbl_users.user_id=tbl_training_users.user_id');
        $this->db->where('tbl_training_users.training_id', $schedule_id);
        $trainee = $this->db->get()->result();

        if (!empty($trainee)) {
            foreach ($trainee as $traine) {

                $emailList[] = $traine->email;
            }
            $this->load->library('email');
            $email_config = Array(
                'mailtype' => 'html'
            );

            $this->email->initialize($email_config);
            $this->email->from('noreply@work-experience.tdanda.co.uk', 'Work Experience');
            $this->email->to($emailList);
            $this->email->subject("New Document Added");
            $this->email->message("Hi Trainee,<br><br>
            A new document has been uploaded for your training. <br><br><br>
                Thanks");
            $this->email->send();
        }
    }

    function edit() {
        $id = $this->uri->segment(3);

        return $this->db->get_where('tbl_doc', array('doc_id' => $id))->row();
    }

    function edit_document() {


        $id = $this->uri->segment(3);
        $title = $_POST['title'];
        $desc = $_POST['desc'];
        if (isset($_POST['active'])) {
            $active = 1;
        }
        else
            $active = 0;
        if (isset($_POST['download'])) {
            $dl = 1;
        }
        else
            $dl = 0;


        $schedule_id = $this->input->post('schedule_id');
        $lessonId = $this->db->get_where('tbl_training_schedule', array('schedule_id' => $schedule_id))->row();

        $ext = end(explode('.', $_FILES['file']['name']));
        if ($ext == '') {
            $q = "update tbl_doc
                set doc_title='$title',
                doc_desc='$desc',
                schedule_id = '$schedule_id',
                lesson_id = '$lessonId->lesson_id',
                isDownloadable='$dl',
                doc_type = '1',
                status='$active' where doc_id = '$id'";
            return $this->db->query($q);
        } else if ($ext != NULL) {

            $file = time() . "_" . rand("100000", "999999") . '.' . $ext;
            $path = str_replace('system/', '', BASEPATH);
            $path .= 'docs/' . $file;
            if (move_uploaded_file($_FILES['file']['tmp_name'], $path)) {
                $sql = mysql_query("SELECT doc_file FROM tbl_doc WHERE doc_id = '$id'");
                if (mysql_num_rows($sql) > 0) {
                    $row = mysql_fetch_row($sql);
                    unlink(str_replace('system/', '', BASEPATH) . 'docs/' . $row[0]);
                }
            }
            $q = "update tbl_doc
                set doc_title='$title',
                doc_desc='$desc',
				doc_file='$file',
                 schedule_id = '$schedule_id',
                lesson_id = '$lessonId->lesson_id',
                isDownloadable='$dl',
            doc_type = '1',
                status='$active' where doc_id = '$id'";
            return $this->db->query($q);
        }
    }

    function view_document() {
        $id = $this->uri->segment(3);
        $q = "select * from tbl_doc where doc_id = '$id'";
        $res = mysql_query($q);
        if (mysql_num_rows($res) > 0) {
            return $res;
        }
        else
            return NULL;
    }

    function delete_document() {
        $id = $this->uri->segment(3);
        $result = $this->db->get_where('tbl_doc', array('doc_id' => $id))->row();
        $path = str_replace('system/', '', BASEPATH) . '/docs/' . $result->doc_file;

        $q = "delete from tbl_doc where doc_id='$id'";

        mysql_query($q);
        unlink($path);
    }

    function getLessonNameById($id) {

        return $this->db->get_where('tbl_lesson', array('lesson_id' => $id))->row();
    }
    
    function getCourseNameById($id) {

        return $this->db->get_where('tbl_course', array('course_id' => $id))->row();
    }

}

?>
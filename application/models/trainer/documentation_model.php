<?php

class Documentation_model extends CI_model {

    function list_document() {
        $q = "select * from tbl_doc where status=1";
        $res = mysql_query($q);
        if (mysql_num_rows($res) > 0) {
            return $res;
        }
        else
            return NULL;
    }

    function view_document() {
        $id = $this->uri->segment(3);
        $q = "select * from tbl_doc where doc_id='$id' and status=1";
        $res = mysql_query($q);
        if (mysql_num_rows($res) > 0) {
            return $res;
        }
        else
            return NULL;
    }

    function view_docs() {
        $id = $this->uri->segment(3);
        $quer = "select * from tbl_doc where doc_id='$id'";
        $result = mysql_query($quer);
        if (mysql_num_rows($result) > 0) {
            return $result;
        }
        else
            return NULL;
    }

    function view_assignments() {
        $id = $this->uri->segment(3);
        $quer = "select * from tbl_assignment_users where assign_id='$id'";
        $result = mysql_query($quer);
        if (mysql_num_rows($result) > 0) {
            return $result;
        }
        else
            return NULL;
    }

    function download($id) {
        $q = "select doc_file from tbl_doc where doc_id='$id' and isDownloadable=1";
        $result = mysql_query($q);
        if (mysql_num_rows($result) > 0) {
            return $result;
        }
        else
            return NULL;
    }

    function download_assignment($id) {
        $q = "select doc_file from tbl_assignment_users where assign_id='$id'";
        $result = mysql_query($q);
        if (mysql_num_rows($result) > 0) {
            return $result;
        }
        else
            return NULL;
    }

    function getCourse($id) {
        $q = "select course_name from tbl_course where course_id='$id'";
        $res = mysql_query($q);
        if (mysql_num_rows($res) > 0) {
            $c = mysql_fetch_assoc($res);
            return $c['course_name'];
        }
    }

    function getCourseFile($id) {
        $q = "select course_file from tbl_course where course_id='$id'";
        $res = mysql_query($q);
        if (mysql_num_rows($res) > 0) {
            $c = mysql_fetch_assoc($res);
            return $c['course_file'];
        }
    }

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

    function getDocumentBySchedule($scheduleId) {

        if ($scheduleId != 0) {
            return $this->db->get_where('tbl_doc', array('schedule_id' => $scheduleId, 'doc_type' => 1))->result();
        } else {
            return NULL;
        }
    }

    function getTrainingNameById($id) {

        return $this->db->get_where('tbl_training', array('training_id' => $id))->row();
    }

    function getLessonNameById($id) {

        return $this->db->get_where('tbl_lesson', array('lesson_id' => $id))->row();
    }

    function getCourseNameById($id){
        return $this->db->get_where('tbl_course', array('course_id' => $id))->row();
    }
    
    function getSessionNameById($scheduleId){
        
        return $this->db->get_where('tbl_training_schedule',array('schedule_id'=>$scheduleId))->row();
        
    }

}

?>
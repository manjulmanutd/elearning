<?php

class Course_model extends CI_Model {

    function getAllCourses() {
        $uname = $this->session->userdata('admin');
        $result = $this->db->get_where('tbl_admin', array('admin_username' => $uname))->row();
        
        $this->db->select('*');
        $this->db->from('tbl_course');
        $this->db->join('tbl_branch','tbl_branch.branch_id=tbl_course.branch_id');
        $this->db->where('tbl_course.branch_id',$result->branch_id);
        return $this->db->get()->result();
    }

    function addCourse() {
        $uname = $this->session->userdata('admin');
        $result = $this->db->get_where('tbl_admin', array('admin_username' => $uname))->row();

        $name = $this->input->post('course_name');
        $desc = $this->input->post('course_desc');
        $fee = $this->input->post('course_fee');

        if (isset($_POST['active'])) {
            $active = 1;
        }
        else
            $active = 0;

        $data = array('course_name' => $name,
            'course_description' => $desc,
            'course_fee' => $fee,
            'branch_id' => $result->branch_id,
            'status' => $active);
        return $this->db->insert('tbl_course', $data);
    }

    function editCourse() {

        $uname = $this->session->userdata('admin');
        $result = $this->db->get_where('tbl_admin', array('admin_username' => $uname))->row();

        $id = $this->uri->segment(3);
        $name = $this->input->post('course_name');
        $desc = $this->input->post('course_desc');
        $fee = $this->input->post('course_fee');
        //$batchId = 0;
        if (isset($_POST['active'])) {
            $active = 1;
        }
        else
            $active = 0;

        $data = array('course_name' => $name,
            'course_description' => $desc,
            'course_fee' => $fee,
            'branch_id' => $result->branch_id,
            'status' => $active);
        $this->db->where('course_id', $id);
        return $this->db->update('tbl_course', $data);
    }

    function getAllCoursesByID() {
        $id = $this->uri->segment(3);
        if (!empty($id)) {
            return $this->db->get_where('tbl_course', array('course_id' => $id))->row();
        } else {
            return null;
        }
    }

    function remove() {
        $id = $this->uri->segment(3);

        $this->db->delete('tbl_appointments', array('course_id' => $id));

        $this->db->delete('tbl_lesson', array('course_id' => $id));
        $q = mysql_query("DELETE FROM tbl_course WHERE course_id = '$id'");

        return $q;
    }

    function getBatchName($id) {

        return $this->db->get_where('tbl_batch', array('batch_id' => $id))->row();
    }

    function listAllBatches() {
        return $this->db->get('tbl_batch')->result();
    }

    function getCourseByBatches($batchId) {
        if ($batchId != 0) {
            return $this->db->get_where('tbl_course', array('batch_id' => $batchId))->result();
        } else {
            return $this->db->get_where('tbl_course')->result();
        }
    }

    function getAllTrainers() {
        $uname = $this->session->userdata('admin');
        $result = $this->db->get_where('tbl_admin', array('admin_username' => $uname))->row();
        return $this->db->get_where('tbl_trainer', array('branch_id' => $result->branch_id))->result();
    }

    function updateTrainer($courseId, $trainerId) {

        $status = $this->db->get_where('tbl_course_trainer', array('course_id' => $courseId))->row();

        if ($status) {
            $data = array('trainer_id' => $trainerId);
            $this->db->where('course_id', $courseId);
            $this->db->update('tbl_course_trainer', $data);
        } else {

            $data = array('course_id' => $courseId, 'trainer_id' => $trainerId);
            $this->db->insert('tbl_course_trainer', $data);
        }
    }

    function isNotEmptyCourse($courseId) {

        $status = $this->db->get_where('tbl_course_trainer', array('course_id' => $courseId))->row();


        if ($status) {
            return true;
        } else {
            return false;
        }
    }

    function getTrainerIdForCourse($courseId) {

        return $this->db->get_where('tbl_course_trainer', array('course_id' => $courseId))->row();
    }

}

?>
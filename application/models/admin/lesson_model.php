<?php

class Lesson_model extends CI_Model {

    function listAllLessons() {
        $this->db->select('*');
        $this->db->from('tbl_lesson');
        $this->db->join('tbl_course', 'tbl_course.course_id=tbl_lesson.course_id');
        return $this->db->get()->result();
    }

    function addLesson() { {
            $name = $this->input->post('lesson_name');
            $desc = $this->input->post('lesson_desc');
            $courseId = $this->input->post('course_id');
            if (isset($_POST['active'])) {
                $active = 1;
            }
            else
                $active = 0;

            $data = array('lesson_name' => $name,
                'lesson_description' => $desc,
                'course_id' => $courseId,
                'status' => $active);
            return $this->db->insert('tbl_lesson', $data);
        }
    }

    function editLesson() {
        $id = $this->uri->segment(3);
        $name = $this->input->post('lesson_name');
        $desc = $this->input->post('lesson_desc');
        $courseId = $this->input->post('course_id');
        if (isset($_POST['active'])) {
            $active = 1;
        }
        else
            $active = 0;

        $data = array('lesson_name' => $name,
            'lesson_description' => $desc,
            'course_id' => $courseId,
            'status' => $active);
        $this->db->where('lesson_id', $id);
        return $this->db->update('tbl_lesson', $data);
    }

    function getAllLessonsByID() {
        $id = $this->uri->segment(3);

        $this->db->select('*');
        $this->db->from('tbl_lesson');
        $this->db->join('tbl_course', 'tbl_course.course_id=tbl_lesson.course_id');
        $this->db->where('tbl_lesson.course_id', $id);
        return $this->db->get()->row();
    }

    function remove() {
        $id = $this->uri->segment(3);
        $q = mysql_query("DELETE FROM tbl_lesson WHERE lesson_id = '$id'");
        return $q;
    }

    function getCourseName($id) {

        return $this->db->get_where('tbl_course', array('course_id' => $id))->row();
    }

    function listAllCourses() {
        $uname = $this->session->userdata('admin');
        $result = $this->db->get_where('tbl_admin', array('admin_username' => $uname))->row();
        $this->db->select('*');
        $this->db->from('tbl_course');
        $this->db->join('tbl_branch', 'tbl_branch.branch_id=tbl_course.branch_id');
        $this->db->where('tbl_course.branch_id', $result->branch_id);
        return $this->db->get()->result();
    }

    function getLessonByCourses($courseId) {
        if ($courseId != 0) {
            $this->db->select('*');
            $this->db->from('tbl_lesson');
            $this->db->join('tbl_course', 'tbl_course.course_id=tbl_lesson.course_id');
            $this->db->where('tbl_lesson.course_id',$courseId);
            return $this->db->get()->result();
            
        } else {
            $this->db->select('*');
            $this->db->from('tbl_lesson');
            $this->db->join('tbl_course', 'tbl_course.course_id=tbl_lesson.course_id');
            return $this->db->get()->result();
        }
    }

}

?>
<?php

class Schedule_model extends CI_model {

    function list_schedule($id) {
        $trainer = $this->session->userdata('trainer');
        $result = $this->db->get_where('tbl_trainer', array('username' => $trainer))->row();
        $trainer_id = $result->trainer_id;

        $this->db->order_by('training_date', 'asc');
        return $this->db->get_where('tbl_training', array('trainer_id' => $trainer_id, 'status' => 1, 'session_id' => $id))->result();
    }

    function view_schedule() {
        $id = $this->uri->segment(3);
        $q = mysql_query("select * from tbl_training where training_id='$id'");
        if (mysql_num_rows($q) > 0) {
            return $q;
        }
        else
            return NULL;
    }

    function getTrainer($id) {
        $q = mysql_query("select username from tbl_trainer where trainer_id='$id'");
        if (mysql_num_rows($q) > 0) {
            $res = mysql_fetch_assoc($q);
            return $res['username'];
        }
        else
            return NULL;
    }

    function getTrainingTimeById($id) {

        return $this->db->get_where('tbl_timeslot_trainings', array('timeslot_id' => $id))->row();
    }

    function getTrainingNameById($id) {

        return $this->db->get_where('tbl_timeslot_schedule', array('id' => $id))->row();
    }

    function getCourseNameById($id) {

        return $this->db->get_where('tbl_course', array('course_id' => $id))->row();
    }

    function getSessionNameById($id) {

        return $this->db->get_where('tbl_course_session', array('session_id' => $id))->row();
    }

    function getLessonNameById($id) {

        return $this->db->get_where('tbl_lesson', array('lesson_id' => $id))->row();
    }

    function getScheduleDetailsById() {
        $id = $this->uri->segment('3');
        return $this->db->get_where('tbl_training', array('training_id' => $id))->row();
    }

    function getAssignedCourses() {
        $trainer = $this->session->userdata('trainer');
        $result = $this->db->get_where('tbl_trainer', array('username' => $trainer))->row();
        $trainer_id = $result->trainer_id;

        $this->db->select('*');
        $this->db->from('tbl_training');
        //$this->db->join('tbl_training_bookings', 'tbl_training_bookings.training_id = tbl_training.training_id');
        $this->db->join('tbl_course_trainer', 'tbl_course_trainer.course_id = tbl_training.course_id');
        $this->db->join('tbl_course','tbl_course.course_id=tbl_training.course_id');
        $this->db->where('tbl_course_trainer.trainer_id', $trainer_id);
        $this->db->order_by('tbl_training.training_date');
        $this->db->order_by('tbl_training.course_id');
        $this->db->where('tbl_training.training_status', 0);


        return $this->db->get()->result();
    }

    function getStartDate($id) {

        $this->db->select_min('lesson_id');
        $this->db->select('training_date');
        return $this->db->get_where('tbl_training', array('session_id' => $id))->row();
    }

    function getTraineesBySchedule($id) {


        $this->db->select('*');
        $this->db->from('tbl_users');
        $this->db->join('tbl_training_bookings', 'tbl_users.user_id=tbl_training_bookings.user_id');
        $this->db->where('tbl_training_bookings.training_id', $id);

        $return = $this->db->get()->result();

        return $return;
    }

    function getAssignmentMarks($scheduleId, $userId) {

        return $this->db->get_where('tbl_training_feedback', array('training_id' => $scheduleId, 'user_id' => $userId))->row();
    }

    function getFeedbacksBySchedule($scheduleId) {

        return $this->db->get_where('tbl_training_feedback_sessions', array('training_id' => $scheduleId))->result();
    }

    function getTraineeNameById($userId) {

        return $this->db->get_where('tbl_users', array('user_id' => $userId))->row();
    }

    function getTraineeCount($scheduleId) {

        return $this->db->get_where('tbl_training_bookings', array('training_id' => $scheduleId))->result();
    }

    function completeSession($scheduleId) {

        $this->db->where('training_id', $scheduleId);
        $this->db->update('tbl_training', array('training_status' => 1));
    }

    function getCompletedSchedules() {
        $trainer = $this->session->userdata('trainer');
        $result = $this->db->get_where('tbl_trainer', array('username' => $trainer))->row();
        $trainer_id = $result->trainer_id;

        $this->db->select('*');
        $this->db->from('tbl_training');
        //$this->db->join('tbl_training_bookings', 'tbl_training_bookings.training_id = tbl_training.training_id');
        $this->db->join('tbl_course_trainer', 'tbl_course_trainer.course_id = tbl_training.course_id');

        $this->db->where('tbl_course_trainer.trainer_id', $trainer_id);
        $this->db->order_by('tbl_training.training_date');
        $this->db->order_by('tbl_training.course_id');
        $this->db->where('tbl_training.training_status', 1);


        return $this->db->get()->result();
    }

}

?>
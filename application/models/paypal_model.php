<?php

class Paypal_model extends CI_Model {

    function insertHalfPayment($course_id) {

        $username = $this->session->userdata('user');

        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();


        $userId = $result->user_id;

        $courseId = $course_id;
        $amount = $this->db->get_where('tbl_course', array('course_id' => $courseId))->row();
        $branchId = $result->branch_id;


        $data = array('user_id' => $userId,
            'course_id' => $courseId,
            'payment_fee' => $amount->course_fee / 2,
            'status' => 2,
            'payment_method' => "Paypal");



        $this->db->insert('tbl_paypal_log', $data);

        $this->db->where('user_id', $userId);
        $this->db->where('course_id', $courseId);
        $this->db->update('tbl_enrollment', array('status' => 1));


        $data1 = array('user_id' => $userId,
            'course_id' => $courseId,
            'enrollment_status' => 1,
            'payment_status' => 2,
            'course_status' => 0);
        $this->db->where('course_id', $courseId);
        $this->db->where('user_id', $result->user_id);
        $this->db->update('tbl_course_log', $data1);
    }

    function insertFullPayment($course_id) {

        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();

        $userId = $result->user_id;

        $courseId = $course_id;
        $amount = $this->db->get_where('tbl_course', array('course_id' => $courseId))->row();
        $branchId = $result->branch_id;


        $data = array('user_id' => $userId,
            'course_id' => $courseId,
            'payment_fee' => $amount->course_fee,
            'status' => 1,
            'payment_method' => "Paypal");

        $this->db->insert('tbl_paypal_log', $data);

        $data1 = array('user_id' => $userId,
            'course_id' => $courseId,
            'enrollment_status' => 1,
            'payment_status' => 1,
            'course_status' => 0);
        $this->db->where('course_id', $courseId);
        $this->db->where('user_id', $result->user_id);
        $this->db->update('tbl_course_log', $data1);
        
    }

    function getPaymentHistory() {
        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();

        $userId = $result->user_id;
        
        $this->db->select('*');
        $this->db->from('tbl_course');
        $this->db->join('tbl_paypal_log','tbl_paypal_log.course_id=tbl_course.course_id');
        $this->db->where('tbl_paypal_log.user_id',$userId);
        return $this->db->get()->result();
    }

    function getCourseNameById($id) {

        return $this->db->get_where('tbl_course', array('course_id' => $id))->row();
    }

    function getSessionNameByTrainingId($trainingId) {

        $session = $this->db->get_where('tbl_training', array('training_id' => $trainingId))->row();

        return $this->db->get_where('tbl_course_session', array('session_id' => $session->session_id))->row();
    }

    function getCourseAmountById($id) {

        return $this->db->get_where('tbl_course', array('course_id' => $id))->row();
    }

    function insertDuePayment($courseId) {

        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();
        $userId = $result->user_id;

        $courseAmount = $this->db->get_where('tbl_course', array('course_id' => $courseId))->row();

        $data = array('status' => 1, 'payment_fee' => $courseAmount->course_fee, 'payment_method' => "Paypal");
        $this->db->where('user_id', $userId);
        $this->db->where('course_id', $courseId);
        $this->db->update('tbl_paypal_log', $data);

        $data1 = array('payment_status' => 1);

        $this->db->where('user_id', $userId);
        $this->db->where('course_id', $courseId);
        $this->db->update('tbl_course_log', $data1);
    }
    
    function insertPartialPayment($courseId,$amount) {

        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();
        $userId = $result->user_id;

        $paidAmount = $this->db->get_where('tbl_paypal_log', array('course_id' => $courseId,'user_id'=>$userId))->row()->payment_fee;
        
        $courseAmount = $this->db->get_where('tbl_course', array('course_id' => $courseId))->row();
        
        $newPaidAmount = $paidAmount + $amount;
         if($newPaidAmount<$courseAmount->course_fee){
              $data = array('status' => 0, 'payment_fee' => $newPaidAmount, 'payment_method' => "Paypal");
         }
       else{
           $data = array('status' => 1, 'payment_fee' => $newPaidAmount, 'payment_method' => "Paypal");
       }
        $this->db->where('user_id', $userId);
        $this->db->where('course_id', $courseId);
        $this->db->update('tbl_paypal_log', $data);
         
        if($newPaidAmount<$courseAmount->course_fee){
            $data1 = array('payment_status' => 0);
        }else{
        $data1 = array('payment_status' => 1);
        }
        $this->db->where('user_id', $userId);
        $this->db->where('course_id', $courseId);
        $this->db->update('tbl_course_log', $data1);
    }
    
    function getDueFee($courseId){
        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();
        $userId = $result->user_id;
        
        $totalFee = $this->db->get_where('tbl_course',array('course_id'=>$courseId))->row()->course_fee;
        $paidFee = $this->db->get_where('tbl_paypal_log',array('course_id'=>$courseId,'user_id'=>$userId))->row()->payment_fee;
        
        return $totalFee - $paidFee;
    }

}

?>
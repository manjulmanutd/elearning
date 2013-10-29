<?php

class User_model extends CI_Model {

    function list_user() {
        $uname = $this->session->userdata('admin');
        $result = $this->db->get_where('tbl_admin', array('admin_username' => $uname))->row();

        $q = mysql_query("SELECT * FROM tbl_users where branch_id = '$result->branch_id'");
        if (mysql_num_rows($q) > 0) {
            return $q;
        }
        else
            return 0;
    }

    function remove() {
        $id = $this->uri->segment(3);
        $q = mysql_query("DELETE FROM tbl_users WHERE user_id = '$id'");
        return $q;
    }

    function remove_logs() {
        $id = $this->uri->segment(3);
        $q = mysql_query("DELETE FROM tbl_course_log WHERE course_log_id = '$id'");
        return $q;
    }

    function view_user() {
        $id = $this->uri->segment(3);
        $q = mysql_query("SELECT * FROM tbl_users WHERE user_id = '$id'");
        if (mysql_num_rows($q) > 0) {
            return $q;
        }
        else
            return NULL;
    }

    function getCountry($id) {
        $q = mysql_query("SELECT countryName FROM tbl_country WHERE country_id = '$id'");
        if (mysql_num_rows($q) > 0) {
            $row = mysql_fetch_assoc($q);
            return $row['countryName'];
        }
    }

    function active_user() {
        $id = $this->uri->segment('3');
        $isPaid = 0;
        $active = $this->input->post('active');
        if (!empty($active)) {
            $active = 1;
        } else {
            $active = 0;
        }
        $q = "update tbl_users set isPaid='$isPaid', status='$active' where user_id='$id'";

        mysql_query($q);
    }

    function getProvince($id) {
        /* $q = "select province_name from tbl_province where province_id='$id'";
          $res = mysql_query($q);
          if (mysql_num_rows($res) > 0) {
          return mysql_fetch_assoc($res);
          } */
    }

    function logs_user() {
        $id = $this->uri->segment('3');
        $q = "select * from tbl_course_log join tbl_users on tbl_course_log.user_id = tbl_users.user_id where tbl_users.user_id='$id' order by tbl_course_log.course_log_id desc";
        $res = mysql_query($q);
        if (mysql_num_rows($res) > 0) {
            return $res;
        }
        else
            return NULL;
    }

    function getUser() {
        $id = $this->uri->segment('3');
        $q = "select username from tbl_users where user_id='$id'";
        $res = mysql_query($q);
        if (mysql_num_rows($res) > 0) {
            return $res;
        }
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

    function getPaymentHistory($userId) {


        return $this->db->get_where('tbl_paypal_log', array('user_id' => $userId))->result();
    }

    function getCourseHistory($userId) {


        return $this->db->get_where('tbl_course_log', array('user_id' => $userId))->result();
    }

    function getBranchNameByCourse($courseId) {
        $result = $this->db->get_where('tbl_course', array('course_id' => $courseId))->row();
        
        return $this->db->get_where('tbl_branch', array('branch_id' => $result->branch_id))->row();
    }

    function getEnrollmentStatus($id) {

        return $this->db->get_where('tbl_enrollment', array('user_id' => $id))->row();
    }

    function getCourseNameById($id) {

        return $this->db->get_where('tbl_course', array('course_id' => $id))->row();
    }

    function getSessionNameByTrainingId($trainingId) {

        $session = $this->db->get_where('tbl_training', array('training_id' => $trainingId))->row();

        return $this->db->get_where('tbl_course_session', array('session_id' => $session->session_id))->row();
    }

    function completePayment($course_id, $userId) {

        $courseAmount = $this->db->get_where('tbl_course', array('course_id' => $course_id))->row();

        $data = array('status' => 1, 'payment_fee' => $courseAmount->course_fee, 'payment_method' => 'Paypal and appointment');
        $this->db->where('user_id', $userId);
        $this->db->where('course_id', $course_id);
        $this->db->update('tbl_paypal_log', $data);
    }

    function clearPayment($course_id, $userId) {


        $courseAmount = $this->db->get_where('tbl_course', array('course_id' => $course_id))->row();

        $data = array('status' => 1, 'payment_fee' => $courseAmount->course_fee, 'payment_method' => 'Appointment');
        $this->db->where('user_id', $userId);
        $this->db->where('course_id', $course_id);
        $this->db->update('tbl_paypal_log', $data);

        $data1 = array('status' => 1);
        $this->db->where('user_id', $userId);
        $this->db->where('course_id', $course_id);
        $this->db->update('tbl_enrollment', $data1);

        $data2 = array('user_id' => $userId,
            'course_id' => $course_id,
            'enrollment_status' => 1,
            'payment_status' => 1,
            'course_status' => 0);

        $this->db->insert('tbl_course_log', $data2);
    }

    function getCourseAmountById($id) {

        return $this->db->get_where('tbl_course', array('course_id' => $id))->row();
    }

    function getUserEnrollmentStatus($id) {

        return $this->db->get_where('tbl_enrollment', array('user_id' => $id))->row();
    }

    function getAllCourses() {

        $uname = $this->session->userdata('admin');
        $result = $this->db->get_where('tbl_admin', array('admin_username' => $uname))->row();
        return $this->db->get_where('tbl_course', array('branch_id' => $result->branch_id, 'status' => 1))->result();
    }

    function add_trainee() {

        $uname = $this->session->userdata('admin');
        $result = $this->db->get_where('tbl_admin', array('admin_username' => $uname))->row();

        $first = $this->input->post('first');
        //$middle=$this->input->post('middle');
        $last = $this->input->post('last');
        $user = $this->input->post('user');
        $pass = $this->input->post('pass');
        $contact = $this->input->post('contact');
        //$image=$this->input->post('image');
        $email = $this->input->post('email');
        $branch = $result->branch_id;
        $course = $this->input->post('course');
        $session_id = $this->input->post('training_id');
        $date = date('Y/m/d H:i:s');

        $data = array(
            'user_id' => '',
            'first_name' => $first,
            'last_name' => $last,
            'username' => $user,
            'password' => $pass,
            'contact_number' => $contact,
            'email' => $email,
            'branch_id' => $branch,
            'course_id' => $course,
            'isPaid' => '',
            'registered_date' => $date,
            'status' => '1'
        );

        $this->db->insert('tbl_users', $data);
    }

    function getTraineeDetById($traineeId) {

        return $this->db->get_where('tbl_users', array('user_id' => $traineeId))->row();
    }

    function sendMessage($traineeId) {

        $this->load->helper('date');
        $trainee = $this->db->get_where('tbl_users', array('user_id' => $traineeId))->row();
        $uname = $this->session->userdata('admin');
        $result = $this->db->get_where('tbl_admin', array('admin_username' => $uname))->row();

        $subject = $this->input->post('subject');
        $message = $this->input->post('message');

        $this->load->library('email');
        $email_config = Array(
            'mailtype' => 'html'
        );
//
        $this->email->initialize($email_config);
        $this->email->from($result->admin_email1, $result->admin_fullname);
        $this->email->to($trainee->email);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();


        $date = now();
        $format = "%Y-%m-%d";
        $data = array('subject' => $subject,
            'message' => $message,
            'sender_id' => 1,
            'reciever_id' => 3,
            'trainer_id' => 0,
            'user_id' => $trainee->user_id,
            'admin_id' => $result->admin_id,
            'sent_date' => mdate($format, $date)
        );

        $this->db->insert('tbl_messaging', $data);
    }

    function getDueFee($courseId, $userId) {

        $totalFee = $this->db->get_where('tbl_course', array('course_id' => $courseId))->row()->course_fee;
        $paidFee = $this->db->get_where('tbl_paypal_log', array('course_id' => $courseId, 'user_id' => $userId))->row();


        return $totalFee - $paidFee->payment_fee;
    }

    function clearPartialPayment($courseId, $userId, $amount) {


        $paidAmount = $this->db->get_where('tbl_paypal_log', array('course_id' => $courseId, 'user_id' => $userId))->row()->payment_fee;

        $courseAmount = $this->db->get_where('tbl_course', array('course_id' => $courseId))->row();

        $newPaidAmount = $paidAmount + $amount;
        if ($newPaidAmount < $courseAmount->course_fee) {
            $data = array('status' => 0, 'payment_fee' => $newPaidAmount, 'payment_method' => "Appointment");
        } else {
            $data = array('status' => 1, 'payment_fee' => $newPaidAmount, 'payment_method' => "Appointment");
        }
        $this->db->where('user_id', $userId);
        $this->db->where('course_id', $courseId);
        $this->db->update('tbl_paypal_log', $data);

        if ($newPaidAmount < $courseAmount->course_fee) {
            $data1 = array('payment_status' => 0);
        } else {
            $data1 = array('payment_status' => 1);
        }
        $this->db->where('user_id', $userId);
        $this->db->where('course_id', $courseId);
        $this->db->update('tbl_course_log', $data1);
    }

    function sendMessageUsers() {

        $this->load->helper('date');

        $uname = $this->session->userdata('admin');
        $result = $this->db->get_where('tbl_admin', array('admin_username' => $uname))->row();
        $message = $this->input->post('message');

        $time = time();
        $format = "%Y-%m-%d %h:%i:%s";

        $data = array('ann_to' => 3, 'ann_admin_from' => $result->admin_id, 'message' => $message, 'sent_date' => mdate($format, $time));
        $this->db->insert('tbl_announcement', $data);
    }

    function getUserMessages() {
        $uname = $this->session->userdata('admin');
        $result = $this->db->get_where('tbl_admin', array('admin_username' => $uname))->row();
        $this->db->order_by('sent_date', 'desc');
        return $this->db->get_where('tbl_announcement', array('ann_admin_from' => $result->admin_id, 'ann_to' => 3))->result();
    }

    function removeUsersMessage() {

        $id = $this->uri->segment('3');
        $this->db->delete('tbl_announcement', array('ann_id' => $id));
    }

    function getTerms() {
        return $this->db->get_where('tbl_terms', array('term_id' => 1))->row();
    }

    function getCoursesByBranch() {
        $uname = $this->session->userdata('admin');
        $result = $this->db->get_where('tbl_admin', array('admin_username' => $uname))->row();
        $branchId = $result->branch_id;

        return $this->db->get_where('tbl_course', array('branch_id' => $branchId))->result();
    }

    function enroll_now($userId) {

        $firstname = $this->input->post('first_name');
        $lastname = $this->input->post('last_name');
        $gender = $this->input->post('gender');
        $address = $this->input->post('address');
        $post_code = $this->input->post('post_code');
        $dob = $this->input->post('dob');
        $ni_number = $this->input->post('ni_number');
        $contact_number = $this->input->post('contact_number');
        $alt_number = $this->input->post('alt_number');
        $emergency_contact_name = $this->input->post('emergency_contact_name');
        $emergency_contact_no = $this->input->post('emergency_contact_no');
        $pref_start_date = $this->input->post('pref_start_date');
        $course_id = $this->input->post('course_id');
        $q1_ideal_accnt = $this->input->post('q1_ideal_accnt');
        $q2_industry = $this->input->post('q2_industry');
        $q3_salary = $this->input->post('q3_salary');
        $q4_jobs_applied = $this->input->post('q4_jobs_applied');
        $q5_doing_what = $this->input->post('q5_doing_what');
        $status = 2;

        $data = array(
            'user_id' => $userId,
            'first_name' => $firstname,
            'last_name' => $lastname,
            'gender' => $gender,
            'address' => $address,
            'post_code' => $post_code,
            'dob' => $dob,
            'ni_number' => $ni_number,
            'contact_number' => $contact_number,
            'alt_number' => $alt_number,
            'emergency_contact_name' => $emergency_contact_name,
            'emergency_contact_no' => $emergency_contact_no,
            'pref_start_date' => $pref_start_date,
            'course_id' => $course_id,
            'q1_ideal_accnt' => $q1_ideal_accnt,
            'q2_industry' => $q2_industry,
            'q3_salary' => $q3_salary,
            'q4_jobs_applied' => $q4_jobs_applied,
            'q5_doing_what' => $q5_doing_what,
            'status' => $status);

        $this->db->insert('tbl_enrollment', $data);

        $data1 = array('course_id' => $course_id,
            'user_id' => $userId,
            'enrollment_status' => 1,
            'course_status' => 0,
            'payment_status' => 0);
        $this->db->insert('tbl_course_log', $data1);

        $data2 = array('user_id' => $userId,
            'course_id' => $course_id,
            'payment_fee' => 0,
            'status' => 0);
        $this->db->insert('tbl_paypal_log', $data2);
    }

}

?>
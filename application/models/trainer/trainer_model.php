<?php

class Trainer_model extends CI_Model {

    function dashboardContent() {
        $q = "select * from tbl_staticpages where staticpage_id=22";
        $res = mysql_query($q);
        if (mysql_num_rows($res) > 0) {
            return $res;
        }
        else
            return NULL;
    }

    function account_settings($user) {
        $q = "select * from tbl_trainer where username='$user'";
        $res = mysql_query($q);
        if (mysql_num_rows($res) > 0) {
            return $res;
        }
    }

    function update_settings() {
        $user = $this->session->userdata('trainer');
        $first = $this->input->post('first');
        $last = $this->input->post('last');
        $un = $this->input->post('user');
        $pass = $this->input->post('pass');
        $contact = $this->input->post('contact');
        //$image=$this->input->post('image');
        $email = $this->input->post('email');

        $data = array(
            'firstname' => $first,
            'lastname' => $last,
            'username' => $un,
            'password' => $pass,
            'phone' => $contact,
            'email' => $email,
            'status' => '1'
        );
        $this->db->where("username", $user);
        $q = $this->db->update('tbl_trainer', $data);
        if ($q) {
            $this->session->unset_userdata('trainer');
            $this->session->set_userdata('trainer', $un);
            return true;
        }
        else
            return NULL;
    }

    function getFeedback($sessionId) {
        $user = $this->session->userdata('trainer');
        $trainer = $this->db->get_where('tbl_trainer', array('username' => $user))->row();

        $trainerId = $trainer->trainer_id;

        $this->db->select('*');
        $this->db->from('tbl_feedback');
        $this->db->join('tbl_training', 'tbl_feedback.training_id=tbl_training.training_id');
        $this->db->where('tbl_training.trainer_id', $trainerId);
        $this->db->where('tbl_training.session_id', $sessionId);
        return $this->db->get()->result();
    }

    function getTraineeNameById($traineeId) {

        return $this->db->get_where('tbl_users', array('user_id' => $traineeId))->row();
    }

    function getCourseNameByTrainingId($trainingId) {

        $training = $this->db->get_where('tbl_training_users', array('training_id' => $trainingId))->row();
        return $this->db->get_where('tbl_course', array('course_id' => $training->course_id))->row();
    }

    function removeFeedback() {
        $id = $this->uri->segment('3');
        $this->db->delete('tbl_feedback', array('feedback_id' => $id));
    }

    function getAssignedCourses() {
        $user = $this->session->userdata('trainer');
        $trainer = $this->db->get_where('tbl_trainer', array('username' => $user))->row();
        
        $this->db->select('*');
        $this->db->from('tbl_course_trainer');
        $this->db->join('tbl_course','tbl_course.course_id=tbl_course_trainer.course_id');
        $this->db->where('tbl_course_trainer.trainer_id',$trainer->trainer_id);
        return $this->db->get()->result();
    }
    
    function getCourseNameById($id){
        
        return $this->db->get_where('tbl_course',array('course_id'=>$id))->row();
    }

    function getMessages(){

        $user = $this->session->userdata('trainer');
        $trainer = $this->db->get_where('tbl_trainer', array('username' => $user))->row();

        $data = array('reciever_id'=>2,
                      'trainer_id'=>$trainer->trainer_id,
                      'status'=>0);

        return $this->db->get_where('tbl_messaging',$data)->result();
       
    }
    
        function sendMessage() {

        $this->load->helper('date');

        $user = $this->session->userdata('trainer');
        $trainer = $this->db->get_where('tbl_trainer', array('username' => $user))->row();
        //$trainee = $this->db->get_where('tbl_users',array('user_id'=>$traineeId))->row();

        $admin = $this->db->get_where('tbl_admin', array('branch_id' => $trainer->branch_id))->row();

        $subject = $this->input->post('subject');
        $message = $this->input->post('message');

        $this->load->library('email');
        $email_config = Array(
            'mailtype' => 'html'
        );
//
        $this->email->initialize($email_config);
        $this->email->from($trainer->email, $trainer->firstname . " " . $trainer->lastname);
        $this->email->to($admin->admin_email1);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();


        $date = now();
        $format = "%Y-%m-%d";
        $data = array('subject' => $subject,
            'message' => $message,
            'sender_id' => 2,
            'reciever_id' => 1,
            'trainer_id' => $trainer->trainer_id,
            'user_id' => 0,
            'admin_id' => $admin->admin_id,
            'sent_date' => mdate($format, $date)
        );

        $this->db->insert('tbl_messaging', $data);
    }

     function getTraineeDetById($traineeId){
        
        return $this->db->get_where('tbl_users',array('user_id'=>$traineeId))->row();
    }
    
     function sendMessageUser($traineeId){

        $this->load->helper('date');
        
        $user = $this->session->userdata('trainer');
        $trainer = $this->db->get_where('tbl_trainer', array('username' => $user))->row();
        $trainee = $this->db->get_where('tbl_users',array('user_id'=>$traineeId))->row();
        
       // $admin = $this->db->get_where('tbl_admin',array('branch_id'=>$trainer->branch_id))->row();

        $subject = $this->input->post('subject');
        $message = $this->input->post('message');

        $this->load->library('email');
        $email_config = Array(
            'mailtype' => 'html'
        );
//
        $this->email->initialize($email_config);
        $this->email->from($trainer->email,$trainer->firstname." ".$trainer->lastname);
        $this->email->to($trainee->email);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();
       

        $date = now();
        $format = "%Y-%m-%d"; 
        $data = array('subject' => $subject,
                     'message'=>$message,
                    'sender_id'=>2,
                    'reciever_id'=>1,
                    'trainer_id'=>$trainer->trainer_id,
                    'user_id'=>$trainee->user_id,
                    'admin_id'=>0,
                    'sent_date'=>mdate($format,$date)
                    );
        
        $this->db->insert('tbl_messaging',$data);

        
    }
    
    function getAllMessages(){
        $this->db->order_by('sent_date','asc');
        return $this->db->get_where('tbl_announcement',array('ann_to'=>2))->result();
    }
}

?>
<?php

class Trainer_model extends CI_Model {

    function list_trainer() {
        $uname = $this->session->userdata('admin');
        $result = $this->db->get_where('tbl_admin', array('admin_username' => $uname))->row();

        return $this->db->get_where('tbl_trainer', array('branch_id' => $result->branch_id))->result();
    }

    function edit_trainer($user) {
        $q = "select * from tbl_trainer where trainer_id='$user'";
        $res = mysql_query($q);
        if (mysql_num_rows($res) > 0) {
            return $res;
        }
    }

    function add_trainer() {

        $uname = $this->session->userdata('admin');
        $result = $this->db->get_where('tbl_admin', array('admin_username' => $uname))->row();

        $first = $this->input->post('first');
        $last = $this->input->post('last');
        $un = $this->input->post('user');
        $pass = $this->input->post('pass');
        $contact = $this->input->post('contact');
        //$image=$this->input->post('image');
        $email = $this->input->post('email');
        if ($_POST['active'] != NULL) {
            $active = 1;
        }
        else
            $active = 0;

        $data = array(
            'firstname' => $first,
            'lastname' => $last,
            'username' => $un,
            'password' => $pass,
            'phone' => $contact,
            'email' => $email,
            'status' => $active,
            'branch_id'=>$result->branch_id
        );
        $q = $this->db->insert('tbl_trainer', $data);
    }

    function update_trainer() {
        $id = $this->uri->segment(3);
        $first = $this->input->post('first');
        $last = $this->input->post('last');
        $un = $this->input->post('user');
        $pass = $this->input->post('pass');
        $contact = $this->input->post('contact');
        //$image=$this->input->post('image');
        $email = $this->input->post('email');
        //$a=$this->input->post('acitve');
        if (isset($_POST['active'])) {
            $active = 1;
        }
        else
            $active = 0;
        $data = array(
            'firstname' => $first,
            'lastname' => $last,
            'username' => $un,
            'password' => $pass,
            'phone' => $contact,
            'email' => $email,
            'status' => $active
        );
        $q = "update tbl_trainer set firstname='$first', lastname='$last', username='$un', password='$pass', phone='$contact', email='$email', status='$active'\
        where trainer_id='$id'";
        mysql_query($q);
        /* $this->db->where('trainer_id', $id);
          $this->db->update('tbl_trainer', $data);; */
    }

    function delete_trainer() {
        $id = $this->uri->segment(3);
        $q = "delete from tbl_trainer where trainer_id='$id'";
        
        $this->db->delete('tbl_course_trainer',array('trainer_id'=>$id));
        mysql_query($q);
    }
    
    function getTrainerDetById($trainerId){
        
        return $this->db->get_where('tbl_trainer',array('trainer_id'=>$trainerId))->row();
    }
    
    function sendMessage($trainerId){

        $this->load->helper('date');
        $trainer = $this->db->get_where('tbl_trainer',array('trainer_id'=>$trainerId))->row();
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
        $this->email->from($result->admin_email1,$result->admin_fullname);
        $this->email->to($trainer->email);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();
       

        $date = now();
        $format = "%Y-%m-%d"; 
        $data = array('subject' => $subject,
                     'message'=>$message,
                    'sender_id'=>1,
                    'reciever_id'=>2,
                    'trainer_id'=>$trainerId,
                    'user_id'=>0,
                    'admin_id'=>$result->admin_id,
                    'sent_date'=>mdate($format,$date)
                    );
        
        $this->db->insert('tbl_messaging',$data);

        
    }

    function sendMessageTrainers(){

        $this->load->helper('date');

         $uname = $this->session->userdata('admin');
         $result = $this->db->get_where('tbl_admin', array('admin_username' => $uname))->row();
         $message = $this->input->post('message');

         $time = time();
         $format = "%Y-%m-%d %h:%i:%s"; 
        
         $data = array('ann_to'=>2,'ann_admin_from'=>$result->admin_id,'message'=>$message,'sent_date'=>mdate($format,$time));
         $this->db->insert('tbl_announcement',$data);
    }

    function getTrainerMessages(){
         $uname = $this->session->userdata('admin');
         $result = $this->db->get_where('tbl_admin', array('admin_username' => $uname))->row();
         $this->db->order_by('sent_date','asc');
         return $this->db->get_where('tbl_announcement',array('ann_admin_from'=>$result->admin_id,'ann_to'=>2))->result();
    }

    function removeTrainersMessage(){

        $id= $this->uri->segment('3');
        $this->db->delete('tbl_announcement',array('ann_id'=>$id));
    }
}

?>

<?php

class Login_model extends CI_model {

    function verify() {
        $un = $this->input->post('un');
        $pw = $this->input->post('pw');
        $as = $this->input->post('as');
        if ($as == 'user') {
            $q = "SELECT username,password FROM tbl_users WHERE username = '$un' AND password = '$pw' AND status = 1";
            $res = $this->db->query($q);
            if ($res->num_rows() > 0) {
                $this->session->set_userdata('user', $un);
                $this->db->delete('chat_with', array('session' => $un));
                $data = array('session' => $un, 'level' => 'user', 'status' => 1);
                $this->db->insert('chat_with', $data);
                $q = "SELECT user_id FROM tbl_users WHERE username = '$un'";
                $res = mysql_query($q);
                if (mysql_num_rows($res) > 0) {
                    $row = mysql_fetch_assoc($res);
                    $uid = $row['user_id'];
                    $date = date('Y/m/d G:i:s');
                    $ip = $_SERVER['REMOTE_ADDR'];
                    /* $query="select user_id from tbl_log_manager where user_id='$uid'";
                      $ress=mysql_query($query);
                      if(mysql_num_rows($ress)>0)
                      { */
                    $branchId = $this->db->get_where('tbl_users', array('user_id' => $uid))->row()->branch_id;
                    $que = "insert into tbl_log_manager (log_id,user_id,user_login_date,ip,branch_id,log_status) values('',$uid,'$date','$ip',$branchId,1)";
                    $r = mysql_query($que);
                    /* }
                      else
                      {
                      $quer = "INSERT into tbl_log_manager VALUES('','$uid','$date',1)";
                      mysql_query($quer);
                      } */
                }
                return true;
            }
            else
                return false;
        }
        else
        if ($as == 'admin') {
            $q = "SELECT admin_username, admin_password, admin_id FROM tbl_admin WHERE admin_username = '$un' AND admin_password = '$pw' AND status = 1";
            $res = $this->db->query($q);
            if ($res->num_rows() > 0) {
                $this->session->set_userdata('admin', $un);
                $this->db->delete('chat_with', array('session' => $un));
                $data = array('session' => $un, 'level' => 'admin', 'status' => 1);
                $this->db->insert('chat_with', $data);
                return true;
            }
            else
                return false;
        }
        else
        if ($as == 'trainer') {
            $q = "SELECT username, password, trainer_id FROM tbl_trainer WHERE username = '$un' AND password = '$pw' AND status = 1";
            $res = $this->db->query($q);
            if ($res->num_rows() > 0) {
                $this->session->set_userdata('trainer', $un);
                $this->db->delete('chat_with', array('session' => $un));
                $data = array('session' => $un, 'level' => 'trainer', 'status' => 1);
                $this->db->insert('chat_with', $data);
                return true;
            }
            else
                return false;
        }

        else
        if ($as == 'superadmin') {
            
        }
    }

    function logout($uname) {
        $q = "select user_id from tbl_users where username='$uname'";
        $res = mysql_query($q);
        $id = mysql_fetch_assoc($res);
        $uid = $id['user_id'];
        $date = date('Y/m/d G:i:s');
        $q = "select log_id from tbl_log_manager where user_id='$uid' order by log_id desc limit 1";
        $res = mysql_query($q);
        if (mysql_num_rows($res) > 0) {
            $logid = mysql_fetch_assoc($res);
            $id = $logid['log_id'];
            $q = "update tbl_log_manager set log_status=0,user_logout_date='$date' where log_id='$id'";
            mysql_query($q);
        }
    }

    function getCountry() {
        $q = 'select * from tbl_country';
        $res = mysql_query($q);
        if (mysql_num_rows($res) > 0)
            ; {
            return $res;
        }
        //else return NULL;
    }

    function signup_verify() {
        $first = $this->input->post('first');
        //$middle=$this->input->post('middle');
        $last = $this->input->post('last');
        $user = $this->input->post('user');
        $pass = $this->input->post('pass');
        $contact = $this->input->post('contact');
        //$image=$this->input->post('image');
        $email = $this->input->post('email');
        $branch = $this->input->post('branch');
        $course = $this->input->post('course');
        $session_id = $this->input->post('training_id');
        //$gender=$this->input->post('gender');
        //$yyyy=$this->input->post('yyyy');
        /* $mm=$this->input->post('mm');
          $dd=$this->input->post('dd');
          $country=$this->input->post('country');
          $city=$this->input->post('city');
          $province=$this->input->post('province');
          $postal=$this->input->post('postal'); */
        $date = date('Y/m/d H:i:s');
        /* $file_name = time()."_".rand("100000","999999");
          $ext = end(explode('/', $_FILES['image']['type']));
          $complete=$file_name.".".$ext;
          $path = str_replace('system/','',BASEPATH).'/images/users/'.$complete;
          move_uploaded_file($_FILES['image']['tmp_name'],$path); */
        $data = array(
            'user_id' => '',
            'first_name' => $first,
            //'middle_name' => $middle ,
            'last_name' => $last,
            'username' => $user,
            'password' => $pass,
            'contact_number' => $contact,
            // 'image' => $complete,
            'email' => $email,
            'branch_id' => $branch,
            'course_id' => $course,
            /* 'gender' => $gender,
              'dob_year' => $yyyy,
              'dob_month' => $mm,
              'dob_day' => $dd,
              'country_id' => $country,
              'city' => $city,
              'province_id' => $province,
              'postal_code' => $postal, */
            'isPaid' => '',
            'registered_date' => $date,
            // 'verification_code' => '',
            'status' => '1'
        );

        $this->db->insert('tbl_users', $data);

        $this->load->library('email');
        $email_config = Array(
            'mailtype' => 'html'
        );

        $data['first_name'] = $first;
        $data['last_name'] = $last;
        $data['username'] = $user;
        $data['password'] = $pass;

        $this->email->initialize($email_config);
        $this->email->from('noreply@work-experience.tdanda.co.uk', 'Work Experience');
        $this->email->to($email);
        $this->email->subject("Login Details");
        $message = $this->load->view('pages/email/login_details', $data, TRUE);
        $this->email->message($message);
        $this->email->send();

        $adminEmail = $this->db->get_where('tbl_admin', array('branch_id' => $branch))->row()->admin_email1;
        $this->email->initialize($email_config);
        $this->email->from('noreply@work-experience.tdanda.co.uk', 'New User Registered');
        $this->email->to($adminEmail);
        $this->email->subject("New User Registered");
        $this->email->message("Hi Branch Admin<br>
            A new User has been registered in your branch. <br><br><br>
                Thanks");
        $this->email->send();

        /* $result = $this->db->get_where('tbl_users',array('username'=>$user))->row();
          $userId = $result->user_id;

          $data1 = array('user_id'=>$userId,'branch_id'=>$branch,'course_id'=>$course,'session_id'=>$session_id,'course_status'=>1,'payment_status'=>1);

          $this->db->insert('tbl_training_users',$data1); */
    }

    function login_forgot() {
        $email = $this->input->post('email');
        $q = "select username,password,email from tbl_users where email='$email'";
        $res = mysql_query($q);
        if (mysql_num_rows($res) > 0) {
            return $res;
        }
        else
            return NULL;
    }

    function home_content() {
        $q = "select * from tbl_staticpages where staticpage_id= 1";
        $res = mysql_query($q);
        if (mysql_num_rows($res) > 0) {
            return $res;
        }
        else
            return NULL;
    }

    function getAllBranches() {
        $batches = $this->db->get('tbl_branch');
        return $batches->result();
    }

    function getAllCourses() {

        $courses = $this->db->get('tbl_course');
        return $courses->result();
    }

    function getCoursesByBatch($id) {

        $courseByBatch = $this->db->get_where('tbl_course', array('batch_id' => $id));
        return $courseByBatch->result();
    }

    function getTrainingsByCourse($id) {

        return $this->db->get_where('tbl_course_session', array('course_id' => $id))->result();
    }

    function getStartDate($id) {

        $this->db->select_min('lesson_id');
        $this->db->select('training_date');
        return $this->db->get_where('tbl_training', array('session_id' => $id))->row();
    }

    function getAllSliderImages() {
        return $this->db->get('tbl_slider_images')->result();
    }

    function chat_status() {

        if ($this->session->userdata('user')) {
            $session = $this->session->userdata('user');
            $this->session->unset_userdata('user');
            //$this->session->unset_userdata('user');

            mysql_query("DELETE FROM chat_with WHERE session = '$session'");
        } else if ($this->session->userdata('admin')) {
            $session = $this->session->userdata('admin');
            $this->session->unset_userdata('admin');
            //$this->session->unset_userdata('user');
            mysql_query("DELETE FROM chat_with WHERE session = '$session'");
        } else if ($this->session->userdata('trainer')) {
            $session = $this->session->userdata('trainer');
            $this->session->unset_userdata('trainer');
            //$this->session->unset_userdata('user');
            mysql_query("DELETE FROM chat_with WHERE session = '$session'");
        }
    }

    function get_chat_admin() {
        $user = $this->session->userdata('user');
        $branchId = $this->db->get_where('tbl_users', array('username' => $user))->row()->branch_id;
        $adminUsername = $this->db->get_where('tbl_admin', array('branch_id' => $branchId))->row()->admin_username;
        $this->db->where_in('level', array('admin'));
        return $this->db->get_where('chat_with', array('session' => $adminUsername))->result();
    }

    function get_chat_trainer() {
        $user = $this->session->userdata('user');
        $userId = $this->db->get_where('tbl_users', array('username' => $user))->row()->user_id;

        $this->db->select('*');
        $this->db->from('tbl_course_log');
        $this->db->join('tbl_course','tbl_course_log.course_id=tbl_course.course_id');
        $this->db->where('tbl_course_log.user_id',$userId);
        $courses = $this->db->get()->result();
         
        
        if (!empty($courses)) {
            foreach ($courses as $course) {
                $trainerId = $this->db->get_where('tbl_course_trainer', array('course_id' => $course->course_id))->row()->trainer_id;
                $train[] = $this->db->get_where('tbl_trainer', array('trainer_id' => $trainerId))->row()->username;
            }
        } else {
            $train[] = '';
        }
        $this->db->where_in('session', $train);
        $this->db->where_in('level', array('trainer'));
        return $this->db->get('chat_with')->result();
    }

    function get_chat_admin_trainees() {
        $user = $this->session->userdata('admin');
        $branchId = $this->db->get_where('tbl_admin', array('admin_username' => $user))->row()->branch_id;
        $trainees = $this->db->get_where('tbl_users', array('branch_id' => $branchId))->result();

        if (!empty($trainees)) {
            foreach ($trainees as $trainee) {
                $train[] = $trainee->username;
            }
        } else {
            $train[] = '';
        }
        $this->db->where_in('level', array('user'));
        $this->db->where_in('session', $train);
        return $this->db->get_where('chat_with')->result();
    }

    function get_chat_admin_trainers() {
        $user = $this->session->userdata('admin');
        $branchId = $this->db->get_where('tbl_admin', array('admin_username' => $user))->row()->branch_id;
        $trainers = $this->db->get_where('tbl_trainer', array('branch_id' => $branchId))->result();
        if (!empty($trainers)) {
            foreach ($trainers as $trainer) {
                $train[] = $trainer->username;
            }
        } else {
            $train[] = '';
        }
        $this->db->where_in('level', array('trainer'));
        $this->db->where_in('session', $train);
        return $this->db->get_where('chat_with')->result();
    }

    function get_chat_trainer_admin() {
        $user = $this->session->userdata('trainer');
        $branchId = $this->db->get_where('tbl_trainer', array('username' => $user))->row()->branch_id;
        $adminUsername = $this->db->get_where('tbl_admin', array('branch_id' => $branchId))->row()->admin_username;
        $this->db->where_in('level', array('admin'));
        return $this->db->get_where('chat_with', array('session' => $adminUsername))->result();
    }

    function get_chat_trainer_trainees() {
        $user = $this->session->userdata('trainer');
        $trainerId = $this->db->get_where('tbl_trainer', array('username' => $user))->row()->trainer_id;
        
        $this->db->select('*');
        $this->db->from('tbl_course_trainer');
        $this->db->join('tbl_course','tbl_course_trainer.course_id=tbl_course.course_id');
        $this->db->where('tbl_course_trainer.trainer_id',$trainerId);
        $courses = $this->db->get()->result();

        if (!empty($courses)) {
            foreach ($courses as $course) {
                $trainees = $this->db->get_where('tbl_course_log', array('course_id' => $course->course_id))->result();
                if (!empty($trainees)) {
                    foreach ($trainees as $trainee) {
                        $train[] = $this->db->get_where('tbl_users', array('user_id' => $trainee->user_id))->row()->username;
                    }
                } else {
                    $train[] = '';
                }
            }
        } else {
            $train[] = '';
        }
        $this->db->where_in('level', array('user'));
        $this->db->where_in('session', $train);
        return $this->db->get_where('chat_with')->result();
    }

}

?>
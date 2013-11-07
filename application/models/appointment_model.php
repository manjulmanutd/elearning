<?php

class Appointment_model extends CI_Model {

    function getAllBranches() {
        return $this->db->get('tbl_branch')->result();
    }

    function getAllTimeslots() {
        return $this->db->get('tbl_timeslot_appointments')->result();
    }

    function registerAppointment() {

        $userId = 0;
        $fname = $this->input->post('firstname');
        $lname = $this->input->post('lastname');
        $phoneno = $this->input->post('phoneno');
        $email = $this->input->post('email');
        $branch_id = $this->input->post('branch_id');
        $admin_id = $this->input->post('admin_id');
        $appointment_date = $this->input->post('appointment_date');
        $timeslot_id = $this->input->post('timeslot_id');
        $specific_requirements = $this->input->post('specific_requirements');


        $active = 1;

        $data = array(
            'user_id' => $userId,
            'firstname' => $fname,
            'lastname' => $lname,
            'phoneno' => $phoneno,
            'email' => $email,
            'appointment_date' => $appointment_date,
            'branch_id' => $branch_id,
            'admin_id' =>$admin_id,
            'timeslot_id' => $timeslot_id,
            'requirements' => $specific_requirements,
            'status' => $active);




        $result = $this->db->get_where('tbl_admin', array('branch_id' => $branch_id,'admin_id'=>$admin_id))->row();

        $this->load->library('email');
        $email_config = Array(
            'mailtype' => 'html'
        );
//
        $this->email->initialize($email_config);
        $this->email->from('noreply@work-experience.tdanda.co.uk', 'Work Experience');
        $this->email->to($result->admin_email1);
        $this->email->subject("New appointment submitted");
        $this->email->message("Hi " . $result->admin_fullname . ",<br><br>
            You have got a new appointment from " . $fname . " " . $lname . " <br><br><br>
                Thanks");
        $this->email->send();

        return $this->db->insert('tbl_appointments', $data);
    }

    function listAppointments() {

        $uname = $this->session->userdata('admin');
        $result = $this->db->get_where('tbl_admin', array('admin_username' => $uname))->row();

        $config['base_url'] = base_url() . 'appointment/list_appointments';
        $config['total_rows'] = $this->db->get_where('tbl_appointments', array('branch_id' => $result->branch_id))->num_rows();
        $config['per_page'] = 20;
        $config['num_links'] = 10;
        $config['full_tag_open'] = '<div id="pagination">';
        $config['full_tag_close'] = '</div>';

        $this->pagination->initialize($config);

        $this->db->order_by('appointment_date', 'asc');
        $this->db->where('status', 1);
        $this->db->where('branch_id', $result->branch_id);
        $this->db->where('admin_id',$result->admin_id);
        return $this->db->get('tbl_appointments', $config['per_page'], $this->uri->segment(3))->result();
    }

    function viewHistory() {

        $uname = $this->session->userdata('admin');
        $result = $this->db->get_where('tbl_admin', array('admin_username' => $uname))->row();

        $config['base_url'] = base_url() . 'appointment/view_appointment_history';
        $config['total_rows'] = $this->db->get_where('tbl_appointments', array('branch_id' => $result->branch_id))->num_rows();
        $config['per_page'] = 20;
        $config['num_links'] = 10;
        $config['full_tag_open'] = '<div id="pagination">';
        $config['full_tag_close'] = '</div>';

        $this->pagination->initialize($config);

        $this->db->order_by('appointment_id', 'desc');
        $this->db->where('status', 0);
        $this->db->where('branch_id',$result->branch_id);
        $this->db->where('admin_id',$result->admin_id);
        return $this->db->get('tbl_appointments', $config['per_page'], $this->uri->segment(3))->result();
    }

    function getTimeSlot($id) {
        return $this->db->get_where('tbl_timeslot_appointments', array('id' => $id))->row();
    }

    function remove() {
        $id = $this->uri->segment(3);
        $q = mysql_query("UPDATE tbl_appointments SET status = '0' where appointment_id = '$id'");
        return $q;
    }

    function getTimeSlotsByBranchAndDate($branchId, $date) {
        $this->load->helper('date');
        $actualDate = strtotime($date);
        $day = date('D', $actualDate);

        $dateString = "%Y-%m-%d";
        $time = time();
        $today = mdate($dateString, $time);
        $curDate = strtotime($today);

        if ($day == "Sun") {
            $dayId = 1;
            $weekend = $this->db->get_where('tbl_working_days_appointment', array('day_sun' => 1, 'branch_id' => $branchId))->row();
        } else if ($day == "Mon") {
            $dayId = 2;
            $weekend = $this->db->get_where('tbl_working_days_appointment', array('day_mon' => 1, 'branch_id' => $branchId))->row();
        } else if ($day == "Tue") {
            $dayId = 3;
            $weekend = $this->db->get_where('tbl_working_days_appointment', array('day_tue' => 1, 'branch_id' => $branchId))->row();
        } else if ($day == "Wed") {
            $dayId = 4;
            $weekend = $this->db->get_where('tbl_working_days_appointment', array('day_wed' => 1, 'branch_id' => $branchId))->row();
        } else if ($day == "Thu") {
            $dayId = 5;
            $weekend = $this->db->get_where('tbl_working_days_appointment', array('day_thu' => 1, 'branch_id' => $branchId))->row();
        } else if ($day == "Fri") {
            $dayId = 6;
            $weekend = $this->db->get_where('tbl_working_days_appointment', array('day_fri' => 1, 'branch_id' => $branchId))->row();
        } else if ($day == "Sat") {
            $dayId = 7;
            $weekend = $this->db->get_where('tbl_working_days_appointment', array('day_sat' => 1, 'branch_id' => $branchId))->row();
        }

        $holiday = $this->db->get_where('tbl_holidays_appointment', array('holiday_date' => $date))->row();

        if (empty($holiday) && !empty($weekend)) {
            if ($actualDate < $curDate) {
                return null;
            } else {
                $this->db->select('timeslot_id');
                $this->db->where('appointment_date', $date);
                $timeslot = $this->db->get_where('tbl_appointments', array('branch_id' => $branchId, 'status' => 1))->result();

                foreach ($timeslot as $slot) {
                    $tislot[] = $slot->timeslot_id;
                }

                $this->db->where_not_in('id', $tislot);
                return $this->db->get_where('tbl_timeslot_appointments', array('branch_id' => $branchId))->result();
            }
        } else {
            return null;
        }
    }

    function getBranchNameById($id) {

        return $this->db->get_where('tbl_branch', array('branch_id' => $id))->row();
    }

    function bookAppointment() {
        $userId = $this->input->post('user_id');
        $fname = $this->input->post('firstname');
        $lname = $this->input->post('lastname');
        $phoneno = $this->input->post('contact');
        $email = $this->input->post('email');
        $branch_id = $this->input->post('branch_id');
        $admin_id = $this->input->post('admin_id');
        $appointment_date = $this->input->post('appointment_date');
        $timeslot_id = $this->input->post('timeslot_id');
        $specific_requirements = $this->input->post('specific_requirements');
        $course_id = $this->input->post('course_id');
        $active = 1;

        $data = array(
            'user_id' => $userId,
            'firstname' => $fname,
            'lastname' => $lname,
            'phoneno' => $phoneno,
            'email' => $email,
            'appointment_date' => $appointment_date,
            'branch_id' => $branch_id,
            'admin_id' => $admin_id,
            'timeslot_id' => $timeslot_id,
            'requirements' => $specific_requirements,
            'course_id' => $course_id,
            'status' => $active);


        $this->db->insert('tbl_appointments', $data);



        $uname = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $uname))->row();

        $userId = $result->user_id;
        $courseId = $this->db->get_where('tbl_enrollment', array('user_id' => $userId))->row()->course_id;
        $courseFee = $this->db->get_where('tbl_course', array('course_id' => $courseId))->row()->course_fee;

        $data1 = array('status' => 2);

        $this->db->where('user_id', $userId);
        $this->db->where('course_id', $courseId);
        $this->db->update('tbl_enrollment', $data1);

        $data2 = array('user_id' => $userId,
            'course_id' => $courseId,
            'payment_fee' => 0,
            'status' => 0);
        $this->db->insert('tbl_paypal_log', $data2);
    }

    function addWorkingDays() {

        $uname = $this->session->userdata('admin');
        $result = $this->db->get_where('tbl_admin', array('admin_username' => $uname))->row();

        if (!isset($_POST['day_1'])) {
            $active_1 = 0;
        } else {
            $active_1 = 1;
        }

        if (!isset($_POST['day_2'])) {
            $active_2 = 0;
        } else {
            $active_2 = 1;
        }


        if (!isset($_POST['day_3'])) {
            $active_3 = 0;
        } else {
            $active_3 = 1;
        }


        if (!isset($_POST['day_4'])) {
            $active_4 = 0;
        } else {
            $active_4 = 1;
        }


        if (!isset($_POST['day_5'])) {
            $active_5 = 0;
        } else {
            $active_5 = 1;
        }


        if (!isset($_POST['day_6'])) {
            $active_6 = 0;
        } else {
            $active_6 = 1;
        }


        if (!isset($_POST['day_7'])) {
            $active_7 = 0;
        } else {
            $active_7 = 1;
        }




        $data = array('day_sun' => $active_1,
            'day_mon' => $active_2,
            'day_tue' => $active_3,
            'day_wed' => $active_4,
            'day_thu' => $active_5,
            'day_fri' => $active_6,
            'day_sat' => $active_7,
            'branch_id' => $result->branch_id);

        //$this->db->select_max('day_id');
        $status = $this->db->get_where('tbl_working_days_appointment', array('branch_id' => $result->branch_id))->row();



        if (!empty($status)) {

            $this->db->select_max('day_id');
            $query = $this->db->get('tbl_working_days_appointment')->row();

            $dayId = $query->day_id;
            $this->db->where('day_id', $dayId);
            $this->db->update('tbl_working_days_appointment', $data);
        } else {

            $this->db->insert('tbl_working_days_appointment', $data);
        }
    }

    function getSelectedDays() {
        $uname = $this->session->userdata('admin');
        $result = $this->db->get_where('tbl_admin', array('admin_username' => $uname))->row();
        $this->db->select('day_id');
        $query = $this->db->get_where('tbl_working_days_appointment', array('branch_id' => $result->branch_id))->row();
        if (!empty($query)) {
            $dayId = $query->day_id;

            return $this->db->get_where('tbl_working_days_appointment', array('day_id' => $dayId, 'branch_id' => $result->branch_id))->row();
        } else {
            return null;
        }
    }

    function getAllHolidays() {

        $uname = $this->session->userdata('admin');
        $result = $this->db->get_where('tbl_admin', array('admin_username' => $uname))->row();

        $this->db->order_by('holiday_date', 'asc');
        return $this->db->get_where('tbl_holidays_appointment', array('branch_id' => $result->branch_id))->result();
    }

    function addHoliday() {

        $uname = $this->session->userdata('admin');
        $result = $this->db->get_where('tbl_admin', array('admin_username' => $uname))->row();

        $date = $this->input->post('holiday_date');
        $remarks = $this->input->post('holiday_remarks');

        $data = array('holiday_date' => $date, 'holiday_remarks' => $remarks, 'branch_id' => $result->branch_id);
        $this->db->insert('tbl_holidays_appointment', $data);
    }

    function removeHoliday() {

        $id = $this->uri->segment('3');
        $this->db->delete('tbl_holidays_appointment', array('holiday_id' => $id));
    }

    function inspectWorkingDay($day, $date) {

        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();

        $this->db->where_in('course_status', array(0, 1));
        $course = $this->db->get_where('tbl_course_log', array('user_id' => $result->user_id))->row();
        $branch = $this->db->get_where('tbl_course', array('course_id' => $course->course_id))->row();

        $actualDate = strtotime($date);
        $dateString = "%Y-%m-%d";
        $time = time();
        $today = mdate($dateString, $time);
        $curDate = strtotime($today);

        if ($actualDate >= $curDate) {
            $result = $this->db->get_where('tbl_holidays', array('holiday_date' => $date))->result();

            if ($day == 'Sun' && empty($result)) {
                return $this->db->get_where('tbl_working_days', array('day_sun' => 1, 'branch_id' => $branch->branch_id))->row();
            } else if ($day == 'Mon' && empty($result)) {
                return $this->db->get_where('tbl_working_days', array('day_mon' => 1, 'branch_id' => $branch->branch_id))->row();
            } else if ($day == 'Tue' && empty($result)) {
                return $this->db->get_where('tbl_working_days', array('day_tue' => 1, 'branch_id' => $branch->branch_id))->row();
            } else if ($day == 'Wed' && empty($result)) {
                return $this->db->get_where('tbl_working_days', array('day_wed' => 1, 'branch_id' => $branch->branch_id))->row();
            } else if ($day == 'Thu' && empty($result)) {
                return $this->db->get_where('tbl_working_days', array('day_thu' => 1, 'branch_id' => $branch->branch_id))->row();
            } else if ($day == 'Fri' && empty($result)) {
                return $this->db->get_where('tbl_working_days', array('day_fri' => 1, 'branch_id' => $branch->branch_id))->row();
            } else if ($day == 'Sat' && empty($result)) {
                return $this->db->get_where('tbl_working_days', array('day_sat' => 1, 'branch_id' => $branch->branch_id))->row();
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    function getAdminsByBranch($branchId) {

        return $this->db->get_where('tbl_admin', array('branch_id' => $branchId, 'user_type' => 1))->result();
    }
    
    function updateAppointment($id){
        
        $remarks = $this->input->post('remarks');
        
        $this->db->where('appointment_id',$id);
        $this->db->update('tbl_appointments',array('remarks'=>$remarks));
    }

}

?>
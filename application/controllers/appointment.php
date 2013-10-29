<?php

class Appointment extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('appointment_model');
        if ($this->session->userdata('admin')) {
            $this->load->model('admin/schedule_model');
        }
        if ($this->session->userdata('user')) {
            $this->load->model('trainee/trainee_model');
        }
    }

    function index() {
        $this->load->model('appointment_model');
        $data['allBranches'] = $this->appointment_model->getAllBranches();
        $data['allTimeslots'] = $this->appointment_model->getAllTimeslots();
        $this->load->view('appointment', $data);
    }

    function register() {
        $result = $this->appointment_model->registerAppointment();


        if ($result) {

            $this->load->view('appointment_complete');
        } else {
            redirect('appointment');
        }
    }

    function list_appointments() {

        if ($this->session->userdata('admin')) {

            $data['allAppointments'] = $this->appointment_model->listAppointments();
            $data['page'] = 'admin/pages/appointments/list_appointments';
            $this->load->view('admin/admin_dash', $data);
        } else {
            redirect('login');
        }
    }

    function view_appointment_history() {

        if ($this->session->userdata('admin')) {

            $data['allAppointments'] = $this->appointment_model->viewHistory();
            $data['page'] = 'admin/pages/appointments/view_history';
            $this->load->view('admin/admin_dash', $data);
        } else {
            redirect('login');
        }
    }

    function remove() {
        $res = $this->appointment_model->remove();
        redirect('appointment/list_appointments');
    }

    function configure_working_days() {
        if ($this->session->userdata('admin')) {
            $data['selectedDays'] = $this->appointment_model->getSelectedDays();
            $data['page'] = 'admin/pages/appointments/configure_working_days';
            $this->load->view('admin/admin_dash', $data);
        }
    }

    function add_working_days() {
        if ($this->session->userdata('admin')) {
            $this->appointment_model->addWorkingDays();
            redirect('appointment/list_appointments');
        }
    }

    function enroll() {
        if ($this->session->userdata('user')) {


            $data['allTimeslots'] = $this->appointment_model->getAllTimeslots();
            $data['user'] = $this->trainee_model->getTraineeDetails();
            $data['allBranches'] = $this->trainee_model->getAllBranches();
            $data['pages'] = 'pages/enrollment/appointment';
            $this->load->view('enrollment_view', $data);
        }
    }

    function getTimeSlots($branchId, $date) {
        echo $branchId;
        echo $date;
        $data['timeSlots'] = $this->appointment_model->getTimeSlotsByBranchAndDate($branchId, $date);
        $this->load->view('timeslot_by_branch', $data);
    }

    function bookSession() {

        $this->appointment_model->bookAppointment();

        redirect('trainee/trainee_dashboard');
    }

    function configure_holidays() {
        $data['allHolidays'] = $this->appointment_model->getAllHolidays();
        $data['page'] = 'admin/pages/appointments/configure_holidays';
        $this->load->view('admin/admin_dash', $data);
    }

    function add_holiday() {
        $data['page'] = 'admin/pages/appointments/add_holiday';
        $this->load->view('admin/admin_dash', $data);
    }

    function insert_holiday() {

        $this->appointment_model->addHoliday();
        redirect('appointment/configure_holidays');
    }

    function remove_holiday() {
        $this->appointment_model->removeHoliday();
        redirect('appointment/configure_holidays');
    }

    function checkValidDate() {
        $date = $this->uri->segment('3');
        $actualDate = strtotime($date);
        $day = date('D', $actualDate);
        $status = $this->appointment_model->inspectWorkingDay($day, $date);
        // $bookedStatus = $this->appointment_model->checkDateBookings($date);

        if (!empty($status)) {
            $valid = 1;
        } else {
            $valid = 0;
        }
        echo $valid;
    }

    function getBranchAdmins($branchId) {

        $data['adminsByBranch'] = $this->appointment_model->getAdminsByBranch($branchId);
        $this->load->view('pages/enrollment/admins_by_branch', $data);
    }

}
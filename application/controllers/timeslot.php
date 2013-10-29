<?php

class Timeslot extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->session->userdata('admin')) {
            redirect('admin');
        }
        $this->load->model('admin/timeslot_model');
        $this->load->model('admin/schedule_model');
    }

    function list_timeslots() {
        $data['page'] = 'admin/pages/timeslot/show_options';
        $this->load->view('admin/admin_dash', $data);
    }

    function list_appointment_timeslots() {

        $data['allAppointmentsTimeslots'] = $this->timeslot_model->listAllAppointmentTimeslots();
        $data['page'] = 'admin/pages/timeslot/list_appointment_timeslot';
        $this->load->view('admin/admin_dash', $data);
    }

    function add_appointment_timeslot() {
        $data['selectedDays'] = $this->schedule_model->getSelectedDays();
        $data['page'] = 'admin/pages/timeslot/add_appointment_timeslot';
        $this->load->view('admin/admin_dash', $data);
    }

    function addAppointmentTimeslot() {

        $this->timeslot_model->addAppointmentTimeslot();
        redirect('timeslot/list_appointment_timeslots');
    }

    function remove_appointment_timeslot() {
        $res = $this->timeslot_model->removeAppointmentTimeslot();
        redirect('timeslot/list_appointment_timeslots');
    }

    function list_schedule_timeslots() {

        $data['allScheduleTimeslots'] = $this->timeslot_model->listAllScheduleTimeslots();
        $data['page'] = 'admin/pages/timeslot/list_schedule_timeslot';
        $this->load->view('admin/admin_dash', $data);
    }

    function add_schedule_timeslot() {
        //$data['selectedDays'] = $this->schedule_model->getSelectedDays();
        $data['page'] = 'admin/pages/timeslot/add_schedule_timeslot';
        $this->load->view('admin/admin_dash', $data);
    }

    function addScheduleTimeslot() {

        $this->timeslot_model->addScheduleTimeslot();
        redirect('timeslot/list_schedule_timeslots');
    }

    function remove_schedule_timeslot() {
        $res = $this->timeslot_model->removeScheduleTimeslot();
        redirect('timeslot/list_schedule_timeslots');
    }

}

?>

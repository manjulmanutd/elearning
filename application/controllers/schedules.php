<?php

class Schedules extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('trainer'))
            redirect('login');
        $this->load->model('trainer/schedule_model');
    }

    public function index() {
        if ($this->session->userdata('trainer'))
            redirect('schedules/list_schedule');
        else
            redirect('login');
    }

    function list_courses() {
        $data['allCourses'] = $this->schedule_model->getAssignedCourses();
        $data['dashboard'] = 'trainer/pages/schedule/list_assigned_courses';
        $this->load->view('trainer/trainer_dashboard', $data);
    }

    function list_schedule($sessionId) {
        $data['allSchedules'] = $this->schedule_model->list_schedule($sessionId);
        $data['dashboard'] = 'trainer/pages/schedule/list_schedule';
        $this->load->view('trainer/trainer_dashboard', $data);
    }

    function view_schedule() {
        $data['schedules'] = $this->schedule_model->view_schedule();
        $data['dashboard'] = 'trainer/pages/schedule/view_schedule';
        $this->load->view('trainer/trainer_dashboard', $data);
    }

    function view_schedule_details() {

        $data['scheduleById'] = $this->schedule_model->getScheduleDetailsById();
        $data['dashboard'] = 'trainer/pages/schedule/list_schedule_details';
        $this->load->view('trainer/trainer_dashboard', $data);
    }

    function view_trainees($scheduleId) {

        $data['allTrainees'] = $this->schedule_model->getTraineesBySchedule($scheduleId);
        $data['dashboard'] = 'trainer/pages/schedule/view_trainees';

        $this->load->view('trainer/trainer_dashboard', $data);
    }

    function view_feedbacks($scheduleId) {
        $data['allFeedbacks'] = $this->schedule_model->getFeedbacksBySchedule($scheduleId);
        $data['dashboard'] = 'trainer/pages/schedule/view_feedbacks';

        $this->load->view('trainer/trainer_dashboard', $data);
    }
    
    function complete_session($scheduleId){
        
        $this->schedule_model->completeSession($scheduleId);
        redirect('schedules/list_courses');
    }
    
    function view_completed_schedules(){
        $data['allCourses'] = $this->schedule_model->getCompletedSchedules();
        $data['dashboard'] = 'trainer/pages/schedule/list_completed_courses';
        $this->load->view('trainer/trainer_dashboard', $data);
    }

}

?>
<?php

class Trainer extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('trainer'))
            redirect('login');
        $this->load->model('trainer/trainer_model');
    }

    public function index() {
        if ($this->session->userdata('trainer'))
            redirect('trainer/dashboard');
        else
            redirect('login');
    }

    public function dashboard() {
        //$data['dashboard_content']=$this->trainer_model->dashboardContent();
        $data['courses'] = $this->trainer_model->getAssignedCourses();
        $data['user'] = $this->session->userdata('trainer');
        $data['dashboard'] = 'trainer/pages/welcome';
        $this->load->view('trainer/trainer_dashboard', $data);
    }

    function account_settings() {
        $user = $this->session->userdata('trainer');
        $data['user'] = $user;
        $data['userDetail'] = $this->trainer_model->account_settings($user);
        $data['dashboard'] = 'trainer/pages/account_settings_view';
        $this->load->view('trainer/trainer_dashboard', $data);
    }

    function update_settings() {
        $data['updateData'] = $this->trainer_model->update_settings();
        $data['user'] = $this->session->userdata('trainer');
        $data['dashboard'] = 'trainer/pages/update_settings_view';
        $this->load->view('trainer/trainer_dashboard', $data);
    }

    function view_feedback($sessionId) {

        $data['allFeedbacks'] = $this->trainer_model->getFeedback($sessionId);
        $data['dashboard'] = 'trainer/pages/view_feedback';
        $this->load->view('trainer/trainer_dashboard', $data);
    }

    function remove_feedback() {

        $this->trainer_model->removeFeedback();
        redirect('schedules/list_courses');
    }

    function messages() {
        $data['messages'] = $this->trainer_model->getMessages();
        $data['dashboard'] = 'trainer/pages/messaging/view_messages';
        $this->load->view('trainer/trainer_dashboard', $data);
    }

    function message_admin() {
       // $data['traineeDet'] = $this->user_model->getTraineeDetById($traineeId);
        $data['dashboard'] = 'trainer/pages/messaging/message_admin';
        $this->load->view('trainer/trainer_dashboard', $data);
    }

    function send_message() {

        $this->trainer_model->sendMessage();
        redirect('trainer/dashboard');
    }
    
    function sendMessageUser($traineeId) {
        $data['traineeDet'] = $this->trainer_model->getTraineeDetById($traineeId);
        $data['dashboard'] = 'trainer/pages/messaging/message_user';
        $this->load->view('trainer/trainer_dashboard', $data);
    }
    
    function send_message_user($traineeId) {

        $this->trainer_model->sendMessageUser($traineeId);
        redirect('schedules/list_courses');
    }
    
    function viewAnnouncements(){
        $data['messages'] = $this->trainer_model->getAllMessages();
        $data['dashboard'] = 'trainer/pages/messaging/all_messages';
        $this->load->view('trainer/trainer_dashboard', $data);
    }
    
    function liveChat(){
        $data['dashboard'] = 'trainer/pages/messaging/livechat';
         $this->load->view('trainer/trainer_dashboard', $data);
        
    }
}

?>
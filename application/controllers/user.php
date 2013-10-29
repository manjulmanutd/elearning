<?php

class User extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->session->userdata('admin')) {
            redirect('login');
        }
        $this->load->model('admin/user_model');
    }

    function list_user() {
        $data['user'] = $this->user_model->list_user();
        $data['page'] = 'admin/pages/user/list_user';
        $this->load->view('admin/admin_dash', $data);
    }

    function remove() {
        $res = $this->user_model->remove();
        redirect('user/list_user');
    }

    function remove_logs() {
        $res = $this->user_model->remove_logs();
        redirect('/user/logs_user/' . $this->session->userdata('uri3'));
    }

    function view_user() {
        $data['det'] = $this->user_model->view_user();
        $data['page'] = 'admin/pages/user/view_user';
        $this->load->view('admin/admin_dash', $data);
    }

    function active_user() {
        $this->user_model->active_user();
        $data['user_edit'] = "Changes have been uploaded to the user profile";
        $data['det'] = $this->user_model->view_user();
        $data['page'] = 'admin/pages/user/view_user';
        $this->load->view('admin/admin_dash', $data);
    }

    function logs_user() {
        $data['user'] = $this->user_model->getUser();
        $data['logs'] = $this->user_model->logs_user();
        $data['page'] = 'admin/pages/user/logs_user';
        $this->load->view('admin/admin_dash', $data);
    }

    function getPaymentHistory($id) {

        $data['enrollment'] = $this->user_model->getEnrollmentStatus($id);
        $data['allPayments'] = $this->user_model->getPaymentHistory($id);
        $data['page'] = 'admin/pages/user/payment_history';
        $this->load->view('admin/admin_dash', $data);
    }
    
    

    function completePayment($trainingId, $userId) {

        $this->user_model->completePayment($trainingId, $userId);
        $data['allPayments'] = $this->user_model->getPaymentHistory($userId);
        $data['page'] = 'admin/pages/user/payment_history';
        $this->load->view('admin/admin_dash', $data);
    }

    function clearPayment($trainingId, $userId) {
        $this->user_model->clearPayment($trainingId, $userId);
        $data['allPayments'] = $this->user_model->getPaymentHistory($userId);
        $data['page'] = 'admin/pages/user/payment_history';
        $this->load->view('admin/admin_dash', $data);
    }

    function partialPayment($courseId,$userId){
        $data['courseId'] = $courseId;
        $data['userId'] = $userId;
        $data['page'] = 'admin/pages/user/partial_payment';
        $this->load->view('admin/admin_dash', $data);
    }
    
    function clearPartialPayment($courseId,$userId){
        $amount = $this->input->post('payment_fee');
        $this->user_model->clearPartialPayment($courseId,$userId,$amount);
        $data['allPayments'] = $this->user_model->getPaymentHistory($userId);
        $data['page'] = 'admin/pages/user/payment_history';
        $this->load->view('admin/admin_dash', $data);
    }
    function view_enrollment($userId) {
        $data['allCourses'] = $this->user_model->getAllCourses();
        $data['enrollment'] = $this->user_model->getUserEnrollmentStatus($userId);
        $data['page'] = 'admin/pages/user/enrollment_details';
        $this->load->view('admin/admin_dash', $data);
    }

    function addUser() {

        $data['allCourses'] = $this->user_model->getAllCourses();
        $data['page'] = 'admin/pages/user/add_trainee';
        $this->load->view('admin/admin_dash', $data);
    }

    function add_user() {
        $this->load->library('form_validation');
        $this->form_validation->set_message('is_unique', '%s already exists');
        $this->form_validation->set_rules('user', 'User Name', 'trim|min_length[5]|max_length[50]|is_unique[tbl_users.username]');
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|is_unique[tbl_users.email]');

        if ($this->form_validation->run() == FALSE) {
            $data['first'] = $this->input->post('first');
            //$data['middle']=$this->input->post('middle');
            $data['last'] = $this->input->post('last');
            $data['user'] = $this->input->post('user');
            $data['pass'] = $this->input->post('pass');
            $data['contact'] = $this->input->post('contact');
            //$data['image']=$this->input->post('image');
            $data['email'] = $this->input->post('email');
            $data['branch'] = $this->input->post('branch');
            $data['course'] = $this->input->post('course');
            $data['session_id'] = $this->input->post('training_id');
            //$data['gender']=$this->input->post('gender');
            //$data['yyyy']=$this->input->post('yyyy');
            //$data['mm']=$this->input->post('mm');
            //$data['dd']=$this->input->post('dd');
            //$data['country']=$this->input->post('country');
            //$data['city']=$this->input->post('city');
            //$data['province']=$this->input->post('province');
            //$data['postal']=$this->input->post('postal');

            $data['allCourses'] = $this->user_model->getAllCourses();
            $data['page'] = 'admin/pages/user/add_trainee';
            $this->load->view('admin/admin_dash', $data);
        } else {

            $this->load->helper('html');

            if ($this->input->post('submit')) {
                $rand = $this->user_model->add_trainee();
                redirect('user/list_user');
            }
        }
    }

     function message_user($traineeId) {
        $data['traineeDet'] = $this->user_model->getTraineeDetById($traineeId);
        $data['page'] = 'admin/pages/user/message_user';
        $this->load->view('admin/admin_dash', $data);
    }

    function send_message($traineeId) {

        $this->user_model->sendMessage($traineeId);
        redirect('user/list_user');
    }

     function mpdf($userId)
     {
        $user = $this->db->get_where('tbl_users',array('user_id'=>$userId))->row();
       $pdfFilePath = FCPATH."course/enrollment/enrollment_".$user->first_name.$user->last_name.$userId.".pdf";

        $data['allCourses'] = $this->user_model->getAllCourses();
        $data['terms'] = $this->user_model->getTerms();
        $data['enrollment'] = $this->user_model->getUserEnrollmentStatus($userId);
        $data['page_title'] = 'Enrollment Form'; 
       if (file_exists($pdfFilePath) == FALSE)
            {
                ini_set('memory_limit','32M'); // boost the memory limit if it's low <img src="http://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley firstChild">
            
                  $html = $this->load->view('pages/enrollment/enrollment_new', $data, true); // render the view into HTML
             
                $this->load->library('pdf');
                $pdf = $this->pdf->load();
                //$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); // Add a footer for good measure <img src="http://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley lastChild">
                $stylesheet = file_get_contents('css/enrollment-style.css');  
                $pdf->WriteHTML($stylesheet,1);
                $pdf->WriteHTML($html,2); // write the HTML into the PDF
                $pdf->Output($pdfFilePath, 'F'); // save to file because we can
            }
             
            redirect("course/enrollment/enrollment_".$user->first_name.$user->last_name.$userId.".pdf");
        }

   function messageUsers() {
        $data['page'] = 'admin/pages/user/message_users';
        $this->load->view('admin/admin_dash', $data);
    }

      function send_message_users() {

        $this->user_model->sendMessageUsers();
        redirect('user/viewUserMessages');
    }

    function viewUserMessages(){

        $data['messages'] = $this->user_model->getUserMessages();
        $data['page'] = 'admin/pages/user/view_message_users';
        $this->load->view('admin/admin_dash', $data);
    }

    function removeUsersMessage(){
        $this->user_model->removeUsersMessage();
        redirect('user/viewUserMessages');
    }
    
    function enroll_user($userId){
        $data['allCourses'] = $this->user_model->getCoursesByBranch();
        $data['trainee'] = $this->user_model->getTraineeDetById($userId);
        $data['page'] = 'admin/pages/user/enrollment_form';
        $this->load->view('admin/admin_dash', $data);
    }
    
    function enroll_now($userId){
       
        $this->user_model->enroll_now($userId);
        $data['enrollment'] = $this->user_model->getEnrollmentStatus($userId);
        $data['allPayments'] = $this->user_model->getPaymentHistory($userId);
        $data['page'] = 'admin/pages/user/payment_history';
        $this->load->view('admin/admin_dash', $data);
    }
    
    function course_history($userId){
        
        $data['allCourses'] = $this->user_model->getCourseHistory($userId);
        $data['page'] = 'admin/pages/user/course_history';
        $this->load->view('admin/admin_dash', $data);
    }
}

?>
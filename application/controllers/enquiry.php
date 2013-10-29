<?php

class Enquiry extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('enquiry_model');
    }
    
    function index(){
        $data['allBranches'] = $this->enquiry_model->getAllBranches();
        $this->load->view('front/enquiry',$data);
    }
    
    function makeEnquiry(){
        
        $this->enquiry_model->makeEnquiry();
        $this->load->View('front/enquiry_complete');
    }
}
?>

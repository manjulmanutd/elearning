<?php

class Enroll extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user')) {
            redirect('login');
        } else {
            $this->load->model('paypal_model');
        }
    }

    function payHalfFee() {

        $this->load->library('Paypal');
        $this->paypal->initialize();
        $course_id = $this->uri->segment('3');
        $this->paypal->add_field('return', site_url('enroll/success_half/' . $course_id));
        $this->paypal->add_field('cancel_return', site_url('enroll/cancel'));
        $this->paypal->add_field('notify_url', site_url('enroll/ipn'));
        $this->paypal->add_field('currency_code', 'GBP');

        $courseName = $this->db->get_where('tbl_course', array('course_id' => $course_id))->row()->course_name;
        $courseAmount = $this->db->get_where('tbl_course', array('course_id' => $course_id))->row()->course_fee;
        $this->paypal->add_field('item_name', $courseName);
        $this->paypal->add_field('amount', $courseAmount / 2);


        $this->paypal->paypal_auto_form();
    }

    function payFullFee() {

        $this->load->library('Paypal');
        $this->paypal->initialize();
        $course_id = $this->uri->segment('3');
        $this->paypal->add_field('return', site_url('enroll/success_full/' . $course_id));
        $this->paypal->add_field('cancel_return', site_url('enroll/cancel'));
        $this->paypal->add_field('notify_url', site_url('enroll/ipn'));
        $this->paypal->add_field('currency_code', 'GBP');

        $courseName = $this->db->get_where('tbl_course', array('course_id' => $course_id))->row()->course_name;
        $courseAmount = $this->db->get_where('tbl_course', array('course_id' => $course_id))->row()->course_fee;


        $this->paypal->add_field('item_name', $courseName);
        $this->paypal->add_field('amount', $courseAmount);


        $this->paypal->paypal_auto_form();
    }

    function payRemainingFee() {
        $this->load->library('Paypal');
        $this->paypal->initialize();
        $course_id = $this->uri->segment('3');
        $this->paypal->add_field('return', site_url('enroll/success_due/' . $course_id));
        $this->paypal->add_field('cancel_return', site_url('enroll/cancel'));
        $this->paypal->add_field('notify_url', site_url('enroll/ipn'));
        $this->paypal->add_field('currency_code', 'GBP');




        $courseName = $this->db->get_where('tbl_course', array('course_id' => $course_id))->row()->course_name;
        $courseAmount = $this->db->get_where('tbl_course', array('course_id' => $course_id))->row()->course_fee;
        $this->paypal->add_field('item_name', $courseName);
        $this->paypal->add_field('amount', $courseAmount / 2);


        $this->paypal->paypal_auto_form();
    }
    
    function payPartialAmount() {
        
        $amount = $this->input->post('payment_fee');
        $this->load->library('Paypal');
        $this->paypal->initialize();
        $course_id = $this->uri->segment('3');
        $this->paypal->add_field('return', site_url('enroll/success_partial/' . $course_id."/".$amount));
        $this->paypal->add_field('cancel_return', site_url('enroll/cancel'));
        $this->paypal->add_field('notify_url', site_url('enroll/ipn'));
        $this->paypal->add_field('currency_code', 'GBP');




        $courseName = $this->db->get_where('tbl_course', array('course_id' => $course_id))->row()->course_name;
        $courseAmount = $this->db->get_where('tbl_course', array('course_id' => $course_id))->row()->course_fee;
        $this->paypal->add_field('item_name', $courseName);
        $this->paypal->add_field('amount', $amount);


        $this->paypal->paypal_auto_form();
    }

    function ipn() {
        $this->load->library('Paypal');
        if ($this->paypal->validate_ipn()) {
            $pdata = $this->paypal->ipn_data;
            if ($pdata['txn_type'] == "web_accept") {
                if ($pdata['payment_status'] == "Completed") {
                    if ($pdata['business'] == $this->config->item('paypal_email')) {
                        // $this->paypal_model->insertPayment($pdata);
                    }
                }
            }
        }
    }

    function success_half() {
        $course_id = $this->uri->segment('3');
        $this->paypal_model->insertHalfPayment($course_id);
        redirect('trainee/trainee_dashboard');
    }

    function success_full() {
        $course_id = $this->uri->segment('3');
        $this->paypal_model->insertFullPayment($course_id);
        redirect('trainee/trainee_dashboard');
    }

    function success_due() {
        $course_id = $this->uri->segment('3');
        $this->paypal_model->insertDuePayment($course_id);
        redirect('enroll/getPaymentHistory');
    }
    
     function success_partial() {
        $course_id = $this->uri->segment('3');
        $amount = $this->uri->segment('4');
        $this->paypal_model->insertPartialPayment($course_id,$amount);
        redirect('enroll/getPaymentHistory');
    }

    function cancel() {
        redirect('trainee/trainee_dashboard');
    }

    function getPaymentHistory() {

        $data['allPayments'] = $this->paypal_model->getPaymentHistory();
        $data['pages'] = 'pages/training/payment_history';
        $this->load->view('training_view', $data);
    }
    
    function payPartialFee(){
        $data['pages'] = 'pages/training/partial_payment';
        $this->load->view('training_view', $data);
    }

}
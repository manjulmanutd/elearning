<?php

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        /* if(!$this->session->userdata('user'))
          {
          redirect('login');
          } */
        $this->load->model('login_model');
    }

    function index() {
        if ($this->session->userdata('user')) {
            redirect('trainee/trainee_dashboard');
        } else if ($this->session->userdata('admin')) {
            redirect('admin');
        } else if ($this->session->userdata('trainer')) {
            redirect('trainer');
        } else {
            redirect('login');
        }
    }

    function loginn() {
        $data['home_content'] = $this->login_model->home_content();
        $data['allImages'] = $this->login_model->getAllSliderImages();
        $this->load->view('login', $data);
    }

    function verify() {
        $data['home_content'] = $this->login_model->home_content();
        $data['allImages'] = $this->login_model->getAllSliderImages();
        $result = $this->login_model->verify();
        if ($result && $this->session->userdata('user')) {
            $url = base_url() . "trainee/user_home_dashboard";

            redirect('session.php?url=' . urlencode($url) . '&un=' . $this->session->userdata('user'));
        } else if ($result && $this->session->userdata('admin')) {
            $url = base_url() . "admin";
            redirect('session.php?url=' . urlencode($url) . '&un=' . $this->session->userdata('admin'));
        } else if ($result && $this->session->userdata('trainer')) {
            $url = base_url() . "trainer";
            redirect('session.php?url=' . urlencode($url) . '&un=' . $this->session->userdata('trainer'));
        } else {
            $data['error'] = "Invalid Username or Password";
            $this->load->view('login', $data);
        }
    }

    function logout() {
        
        if ($this->session->userdata('user')) {
            $un = $this->session->userdata('user');
            $this->login_model->logout($un);
            $this->login_model->chat_status();
            $this->session->unset_userdata('user');
        } else if ($this->session->userdata('admin')) {
            $this->login_model->chat_status();
            $this->session->unset_userdata('admin');
        } else if ($this->session->userdata('trainer')) {
            $this->login_model->chat_status();
            $this->session->unset_userdata('trainer');
        }
        $this->login_model->chat_status();
        redirect('login');
    }

    function signup() {
        $data['home_content'] = $this->login_model->home_content();
        $data['page'] = 'front/signup_view';
        $data['allBranches'] = $this->login_model->getAllBranches();
        $data['allCourses'] = $this->login_model->getAllCourses();
        $this->load->view('login', $data);
    }

    function signup_verify() {
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
            $data['allBranches'] = $this->login_model->getAllBranches();
            $data['allCourses'] = $this->login_model->getAllCourses();
            $data['home_content'] = $this->login_model->home_content();
            $data['page'] = 'front/signup_view';

            $this->load->view('login', $data);
        } else {

            $this->load->helper('html');

            if ($this->input->post('submit')) {
                $rand = $this->login_model->signup_verify();
                /* if($rand)
                  {

                  $user=$this->input->post('user');
                  $pass=$this->input->post('pass');
                  $this->load->library('email');
                  $config['mailtype'] = 'html';
                  $this->email->initialize($config);
                  $this->email->from('noreply@letmesingthis.com ', 'Letmesingthis.com');
                  $this->email->to($this->input->post('e'));
                  $this->email->subject("Email Confirmation");
                  $this->email->message("Hi ".$user.",<br><br>Thank you for registering with Elearnig.com.<br> Your login Details:<br><br><b>Username:</b> ".$user."<br><b>Password:</b> ".$pass."<br><br>Thank you for Using E Learning Portal!!");
                  if($this->email->send())
                  {
                  echo "success";
                  /*$data['user']=$this->session->set_userdata('user',$user);
                  $data['page']='front/welcome_view';
                  $this->load->view('dashboard_view',$data);
                  } */
                $user = $this->input->post('user');
                $pass = $this->input->post('pass');
                $this->session->set_userdata('user', $user);

                $data['allBranches'] = $this->login_model->getAllBranches();
                $data['allCourses'] = $this->login_model->getAllCourses();
                //$data['user']=$this->session->set_userdata('user',$user);
                $data['home_content'] = $this->login_model->home_content();
                $data['page'] = 'front/signup_success_view';
                $this->load->view('login', $data);
            }
        }
    }

    function forgot_login() {
        $data['home_content'] = $this->login_model->home_content();
         $data['allImages'] = $this->login_model->getAllSliderImages();
        $data['forgot_login'] = 'front/forgot_login_view';
        $this->load->view('login', $data);
    }

    function login_forgot() {
        $data['home_content'] = $this->login_model->home_content();
        $mail = $this->login_model->login_forgot();
        if ($mail) {
            $m = mysql_fetch_assoc($mail);
           
             $this->load->library('email');
            $email_config = Array(
                'mailtype' => 'html'
            );

            $this->email->initialize($email_config);
            $this->email->from('noreply@work-experience.tdanda.co.uk', 'Work Experience');
            $this->email->to($m['email']);

            $this->email->subject('Password Recovery');
            $this->email->message("Your username:" . $m['username'] . "<br> password:" . $m['password']);
          
            if ($this->email->send()) {

                $data['forgot_login'] = 'front/login_forgot_view';
                $data['allImages'] = $this->login_model->getAllSliderImages();
                $this->load->view('login', $data);
            } else {
                $data['email_error'] = "<font color='red'><b>Sorry an error while sending an email to your account.</b></font>";
                $data['allImages'] = $this->login_model->getAllSliderImages();
                $this->load->view('login', $data);
            }
        } else {
            $data['forgot_invalid'] = "<font color='red'><b>Invalid Email</b></font>";
            $data['allImages'] = $this->login_model->getAllSliderImages();
            $this->load->view('login', $data);
        }
    }

    function getCoursesByBatch($id) {

        $data['coursesByBatch'] = $this->login_model->getCoursesByBatch($id);

        $this->load->view('front/course_list', $data);
    }

    function getTrainingsByCourse($id) {

        $data['trainingsByCourse'] = $this->login_model->getTrainingsByCourse($id);
        $this->load->view('front/training_list', $data);
    }

    function mpdf() {
        $pdfFilePath = FCPATH . "course/enrollment/enrollment.pdf";
        $data['page_title'] = 'Hello world';
        if (file_exists($pdfFilePath) == FALSE) {
            ini_set('memory_limit', '32M'); // boost the memory limit if it's low <img src="http://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley firstChild">

            $html = $this->load->view('pages/enrollment/enrollment_new', $data, true); // render the view into HTML

            $this->load->library('pdf');
            $pdf = $this->pdf->load();
            //$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); // Add a footer for good measure <img src="http://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley lastChild">
            $stylesheet = file_get_contents('css/enrollment-style.css');
            $pdf->WriteHTML($stylesheet, 1);
            $pdf->WriteHTML($html, 2); // write the HTML into the PDF
            $pdf->Output($pdfFilePath, 'F'); // save to file because we can
        }

        redirect("course/enrollment/enrollment.pdf");
    }

    function enrollmentView() {
        $data['page_title'] = 'Hello world';
        $this->load->view('pages/enrollment/enrollment_new', $data); // render the view into HTML
    }

    function endsession() {
        
         $this->login_model->chat_status();
        
        
    }

}

?>
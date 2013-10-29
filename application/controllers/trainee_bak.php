<?php

class Trainee extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('date');
        if (!$this->session->userdata('user')) {
            redirect('login');
        }
        $this->load->model('trainee/trainee_model');
    }

    function index() {
        $data['allCourses'] = $this->trainee_model->getAllCoursesByBranch();
        $data['trainee'] = $this->trainee_model->getTraineeDetails();
        $data['pages'] = 'pages/enrollment/enrollment_form';
        $this->load->view('enrollment_view', $data);
    }

    function enroll_now() {
        $userId = $this->uri->segment('3');
        $courseId = $this->input->post('course_id');
        $this->trainee_model->enroll_now($userId);
        $data['courseId'] = $courseId;
        $data['pages'] = 'pages/enrollment/payment_options';
        $this->load->view('enrollment_view', $data);
    }

    function trainee_dashboard() {

        $status = $this->trainee_model->getCourseStatus();
        $lessonActiveStatus = $this->trainee_model->getLessonActiveStatus();
        $lessonCompleteStatus = $this->trainee_model->getLessonCompleteStatus();
        $paymentStatus = $this->trainee_model->getPaymentStatus();
        $enrollment = $this->trainee_model->getEnrollmentStatus();

        if (!empty($paymentStatus)) {

            if (!empty($status)) {
                $enrollmentStatus = $status->enrollment_status;
                if ($enrollment->status == 2) {
                    $data['courseStatus'] = $status;
                    $data['appDetails'] = $this->trainee_model->getAppointmentDetails($status->training_id);
                    $data['pages'] = 'pages/training/booked_status';
                    $this->load->view('enrollment_view', $data);
                } else if ($enrollmentStatus == 1) {

                    if ($status->course_status == 1) {
                        //TODO

                        if (empty($lessonActiveStatus)) {
                            $completeStatus = $this->trainee_model->getCourseCompleteStatus();
                            $data['completeStatus'] = $completeStatus;
                            $data['allLessons'] = $this->trainee_model->getAllAvailableLessons();
                            $data['allTrainings'] = $this->trainee_model->getAllTrainings();
                            $data['pages'] = 'pages/training/list_all_trainings';
                            $this->load->view('dashboard_view', $data);
                        } else {
                            $data['courseProgress'] = $this->trainee_model->getCourseProgress();
                            $data['paymentStatus'] = $this->trainee_model->getPaymentStatus();
                            $data['courseStatus'] = $lessonActiveStatus;
                            $data['pages'] = 'pages/training/welcome_course';
                            $this->load->view('dashboard_view', $data);
                        }
                    } else if ($status->course_status == 3) {
                        $data['totalMarks'] = $this->trainee_model->getTotalMarks();
                        $data['courseStatus'] = $lessonActiveStatus;
                        $data['pages'] = 'pages/training/complete_course';
                        $this->load->view('dashboard_view', $data);
                    } else if ($status->course_status == 2) {
                        //$data['paymentStatus'] = $this->trainee_model->getPaymentStatus();
                        $data['courseStatus'] = $status;
                        $data['pages'] = 'pages/training/course_feedback';
                        $this->load->view('dashboard_view', $data);
                    }
                }
            } else {
                $completeStatus = $this->trainee_model->getCourseCompleteStatus();

                if (!empty($completeStatus)) {
                    if ($completeStatus->course_status == 3) {
                        $data['totalMarks'] = $this->trainee_model->getTotalMarks();
                        $data['pages'] = 'pages/training/complete_course';
                        $this->load->view('dashboard_view', $data);
                    }
                } else {
                    $data['completeStatus'] = $completeStatus;
                    $data['allLessons'] = $this->trainee_model->getAllAvailableLessons();
                    $data['allTrainings'] = $this->trainee_model->getAllTrainings();
                    $data['pages'] = 'pages/training/list_all_trainings';
                    $this->load->view('dashboard_view', $data);
                }
            }
        } else if (!empty($enrollment)) {

            if ($enrollment->status == 2) {
                $data['courseStatus'] = $status;
                $data['appDetails'] = $this->trainee_model->getAppointmentDetails($enrollment->course_id);
                $data['pages'] = 'pages/training/booked_status';
                $this->load->view('enrollment_view', $data);
            } else {
                $username = $this->session->userdata('user');
                $result = $this->db->get_where('tbl_users', array('username' => $username))->row();

                $userId = $result->user_id;
                $courseId = $this->db->get_where('tbl_enrollment', array('user_id' => $userId))->row()->course_id;
                $data['courseId'] = $courseId;
                $data['pages'] = 'pages/enrollment/payment_options';
                $this->load->view('enrollment_view', $data);
            }
        } else {
            redirect('trainee');
        }
    }

    function view_documents() {
        $data['allSchedules'] = $this->trainee_model->getEnrolledSchedules();
        $data['pages'] = 'pages/training/list_documents';
        $this->load->view('dashboard_view', $data);
    }

    function view_documents_by_schedule($scheduleId) {
        $data['allDocs'] = $this->trainee_model->getDocumentBySchedule($scheduleId);
       $this->load->view('pages/training/list_all_documents', $data);
    }
    
    function view_assignments() {
        $data['allSchedules'] = $this->trainee_model->getEnrolledSchedules();
        $data['pages'] = 'pages/training/list_assignments';
        $this->load->view('dashboard_view', $data);
    }

    function view_assignments_by_schedule($scheduleId) {
        $data['allDocs'] = $this->trainee_model->getAssignmentBySchedule($scheduleId);
       $this->load->view('pages/training/list_all_assignments', $data);
    }

   
    

    function view_docs() {
        $data['f'] = $this->trainee_model->view_docs();
        $data['pages'] = 'pages/training/view_docs';
        $this->load->view('dashboard_view', $data);
    }

    function download() {
        $this->load->helper('download');
        $id = $this->uri->segment(3);
        $fil = $this->trainee_model->download($id);
        if ($fil != NULL) {
            $file = mysql_fetch_assoc($fil);
            $path = str_replace('system/', '', BASEPATH) . "docs/" . $file['doc_file'];
            $data = file_get_contents($path); // Read the file's contents
            $name = $file['doc_file'];
            force_download($name, $data);
        }
        else
            redirect('trainee/view_all_documents');
    }

    function enrollment() {
        $data['traineeDetails'] = $this->trainee_model->getTraineeDetails();
        $data['pages'] = 'pages/enrollment/enrollment_form';
        $this->load->view('enrollment_view', $data);
    }

    function submit($trainingId) {
        $data['schedule'] = $this->trainee_model->getTrainingDetails($trainingId);
        $data['trainingId'] = $trainingId;
        $data['pages'] = 'pages/training/submit_assignment';
        $this->load->view('dashboard_view', $data);
    }

    function submit_assignment() {
        $this->trainee_model->submit_assignment();
        redirect('trainee/view_assignments');
    }

    function progressBarTest() {

        $this->load->view('progress_bar');
    }

    function feedback() {

        $this->trainee_model->addFeedback();
        redirect('trainee/trainee_dashboard');
    }

    function markLessonComplete($trainingId) {
       
        $this->trainee_model->markLessonComplete($trainingId);
        $lessonCompleteStatus = $this->trainee_model->getLessonCompleteStatus();
               
        if ($lessonCompleteStatus == 1) {
            $this->trainee_model->markCourseComplete($trainingId);
            redirect('trainee/trainee_dashboard');
        } else {
            $completeStatus = $this->trainee_model->getCourseCompleteStatus();
            $data['completeStatus'] = $completeStatus;
            $data['allLessons'] = $this->trainee_model->getAllAvailableLessons();
            $data['allTrainings'] = $this->trainee_model->getAllTrainings();
            $data['pages'] = 'pages/training/list_all_trainings';
            $this->load->view('dashboard_view', $data);
        }
    }

    function startTraining($trainingId) {

        $this->trainee_model->start_training($trainingId);
        redirect('trainee/trainee_dashboard');
    }

    function getTrainingsByLesson($lessonId) {

        $data['trainingsByLesson'] = $this->trainee_model->getTrainingsByLesson($lessonId);
        $this->load->view('pages/training/list_trainings_by_lesson', $data);
    }

}

?>

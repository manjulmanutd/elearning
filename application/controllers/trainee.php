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
        $data['terms'] = $this->trainee_model->getTerms();
        $data['pages'] = 'pages/enrollment/enrollment_form';
        $this->load->view('enrollment_view', $data);
    }

    function enroll_now() {
        $userId = $this->uri->segment('3');
        $courseId = $this->input->post('course_id');
        $this->trainee_model->enroll_now($userId, $courseId);
        $data['courseId'] = $courseId;
        $data['pages'] = 'pages/enrollment/payment_options';
        $this->load->view('enrollment_view', $data);
    }

    function user_home_dashboard() {
        $enrollment = $this->trainee_model->getEnrollmentStatus();

        if (!empty($enrollment)) {
            $paymentStatus = $this->trainee_model->getPaymentStatus();
            if (!empty($paymentStatus)) {
                //$data['courseProgress'] = $this->trainee_model->getCourseProgress();
                redirect('dashboard/welcome');
            } else {
                $appointmentStatus = $this->trainee_model->getAppointmentStatus();
                if (!empty($appointmentStatus)) {
                    //$data['courseStatus'] = $appointmentStatus;
                    $data['appDetails'] = $this->trainee_model->getAppointmentDetails();
                    $data['pages'] = 'pages/training/booked_status';
                    $this->load->view('enrollment_view', $data);
                } else {
                    $username = $this->session->userdata('user');
                    $result = $this->db->get_where('tbl_users', array('username' => $username))->row();
                    $userId = $result->user_id;
                    $this->db->where_in('course_status', array(0, 1));
                    $courseId = $this->db->get_where('tbl_course_log', array('user_id' => $result->user_id))->row()->course_id;
                    $data['courseId'] = $courseId;
                    $data['pages'] = 'pages/enrollment/payment_options';
                    $this->load->view('enrollment_view', $data);
                }
            }
        } else {
            redirect('trainee');
        }
    }

    function trainee_dashboard() {

        $enrollment = $this->trainee_model->getEnrollmentStatus();

        if (!empty($enrollment)) {
            $paymentStatus = $this->trainee_model->getPaymentStatus();

            if (!empty($paymentStatus)) {
                //$data['courseProgress'] = $this->trainee_model->getCourseProgress();
                $data['allCourses'] = $this->trainee_model->getAllEnrolledCourses();
                $data['pages'] = 'pages/training/training_home';
                $this->load->view('training_view', $data);
            } else {
                $appointmentStatus = $this->trainee_model->getAppointmentStatus();

                if (!empty($appointmentStatus)) {
                    //$data['courseStatus'] = $appointmentStatus;
                    $data['appDetails'] = $this->trainee_model->getAppointmentDetails();
                    $data['pages'] = 'pages/training/booked_status';
                    $this->load->view('enrollment_view', $data);
                } else {
                    $username = $this->session->userdata('user');
                    $result = $this->db->get_where('tbl_users', array('username' => $username))->row();
                    $userId = $result->user_id;
                    $this->db->where_in('course_status', array(0, 1));
                    $courseId = $this->db->get_where('tbl_course_log', array('user_id' => $result->user_id))->row()->course_id;
                    $data['courseId'] = $courseId;
                    $data['pages'] = 'pages/enrollment/payment_options';
                    $this->load->view('enrollment_view', $data);
                }
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
        $data['terms'] = $this->trainee_model->getTerms();
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

    function bookTraining($trainingId) {

        $this->trainee_model->start_training($trainingId);
        redirect('trainee/course_dashboard');
    }

    function getTrainingsByLesson($lessonId) {

        $data['trainingsByLesson'] = $this->trainee_model->getTrainingsByLesson($lessonId);
        $this->load->view('pages/training/list_trainings_by_lesson', $data);
    }

    function course_dashboard($courseId) {
        $courseStatus = $this->trainee_model->getCourseCompleteStatus($courseId);

        if ($courseStatus == 1) {
            $this->trainee_model->completeCourse($courseId);
            $data['totalMarks'] = $this->trainee_model->getTotalMarks($courseId);
            $data['pages'] = 'pages/training/complete_course';
            $this->load->view('dashboard_view', $data);
        } else {
            $data['activeCourse'] = $courseId;
            $data['trainingsByLesson'] = $this->trainee_model->getBookedSessions($courseId);
            $data['pages'] = 'pages/trainingCourse/list_booked_trainings';
            $this->load->view('dashboard_view', $data);
        }
    }

    function archive_dashboard($courseId) {
        $courseStatus = $this->trainee_model->getCourseCompleteStatus($courseId);

        if ($courseStatus == 1) {
            $this->trainee_model->completeCourse($courseId);
            $data['totalMarks'] = $this->trainee_model->getTotalMarks($courseId);
            $data['pages'] = 'pages/training/complete_course';
            $this->load->view('archive_view', $data);
        } else {
            $data['activeCourse'] = $courseId;
            $data['trainingsByLesson'] = $this->trainee_model->getBookedSessions($courseId);
            $data['pages'] = 'pages/trainingCourse/list_booked_trainings';
            $this->load->view('archive_view', $data);
        }
    }

    function list_unbooked_lessons() {
        $data['allLessons'] = $this->trainee_model->getAllAvailableLessons();
        $data['timeSlots'] = $this->trainee_model->getAllTimeSlots();
        $data['pages'] = 'pages/trainingCourse/list_all_trainings';
        $this->load->view('dashboard_view', $data);
    }

    function cancelBooking() {

        $this->trainee_model->cancelBooking();
        redirect('trainee/trainee_dashboard');
    }

    function feedback_home() {
        $data['allFeedbacks'] = $this->trainee_model->getAllFeedbacks();

        $data['pages'] = 'pages/feedback/feedback_home';
        $this->load->view('dashboard_view', $data);
    }

    function feedback_lesson() {
        $data['feedbackByLesson'] = $this->trainee_model->getFeedbackByLesson();
        $data['pages'] = 'pages/feedback/provide_feedback_trainee';
        $this->load->view('dashboard_view', $data);
    }

    function provideFeedbackSession($id) {
        $this->trainee_model->provideFeedbackSession($id);
        redirect('trainee/feedback_home');
    }

    function checkValidDate() {
        $date = $this->uri->segment('3');
        $actualDate = strtotime($date);
        $day = date('D', $actualDate);
        $status = $this->trainee_model->inspectWorkingDay($day, $date);
        $bookedStatus = $this->trainee_model->checkDateBookings($date);

        if (!empty($status) && $bookedStatus <= 15) {
            $valid = 1;
        } else {
            $valid = 0;
        }
        echo $valid;
    }

    function bookUserSession() {

        $this->trainee_model->bookUserSession();
        redirect('trainee/trainee_dashboard');
    }

    function view_archive_documents($courseId) {
        $data['allSchedules'] = $this->trainee_model->getCourseSchedules($courseId);
        $data['pages'] = 'pages/trainingArchive/list_documents';
        $this->load->view('archive_view', $data);
    }

    function view_archive_documents_by_schedule($scheduleId) {
        $data['allDocs'] = $this->trainee_model->getDocumentBySchedule($scheduleId);
        $this->load->view('pages/trainingArchive/list_all_documents', $data);
    }

    function view_archive_assignments($courseId) {
        $data['allSchedules'] = $this->trainee_model->getCourseSchedules($courseId);
        $data['pages'] = 'pages/trainingArchive/list_assignments';
        $this->load->view('archive_view', $data);
    }

    function view_archive_assignments_by_schedule($scheduleId) {
        $data['allDocs'] = $this->trainee_model->getAssignmentBySchedule($scheduleId);
        $this->load->view('pages/trainingArchive/list_all_assignments', $data);
    }

    function feedback_archive($courseId) {
        $data['allFeedbacks'] = $this->trainee_model->getAllFeedbacksByCourse($courseId);

        $data['pages'] = 'pages/feedback/feedback_home_archive';
        $this->load->view('archive_view', $data);
    }

    //just to enroll a course in the same branch
    function enrollAnother_old() {

        $data['allCourses'] = $this->trainee_model->getCourseByBranch();
        $data['pages'] = 'pages/enrollment/enrollment_next';
        $this->load->view('training_view', $data);
    }

    function enroll_another() {

        $this->trainee_model->enroll_another();
        redirect('trainee/trainee_dashboard');
    }

    function enrollSelectBranch() {
        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();
        $data['allBranches'] = $this->trainee_model->getAllBranches();
        $data['branchId'] = $result->branch_id;
        $data['pages'] = 'pages/enrollment/enroll_select_branch';
        $this->load->view('training_view', $data);
    }

    function enrollAnother() {
        $branchId = $this->input->post('branch_id');
        $data['allCourses'] = $this->trainee_model->getAllCoursesByBranchId($branchId);
        $data['trainee'] = $this->trainee_model->getTraineeDetails();
        $data['terms'] = $this->trainee_model->getTerms();
        $data['pages'] = 'pages/enrollment/enrollment_form';
        $this->load->view('training_view', $data);
    }

    //TODO
    function checkDateBookings($date) {
        $count = $this->trainee_model->checkDateBookings($date);
        $countConf = $this->trainee_model->getSessionNumber();
        echo $countConf->number_session - $count;
    }

    function message_admin() {
        // $data['traineeDet'] = $this->user_model->getTraineeDetById($traineeId);
        $data['pages'] = 'pages/messaging/message_admin';
        $this->load->view('training_view', $data);
    }

    function send_message() {

        $this->trainee_model->sendMessage();
        redirect('trainee/trainee_dashboard');
    }

    function message_trainer($courseId) {
        $data['courseId'] = $courseId;
        $data['pages'] = 'pages/messaging/message_trainer';
        $this->load->view('training_view', $data);
    }

    function send_message_trainer($courseId) {

        $this->trainee_model->sendMessageTrainer($courseId);
        redirect('trainee/trainee_dashboard');
    }

    function viewAnnouncements() {
        $data['messages'] = $this->trainee_model->getAllMessages();
        $data['pages'] = 'pages/messaging/all_messages';
        $this->load->view('training_view', $data);
    }

    function liveChat() {
        $data['pages'] = 'pages/messaging/livechat';
        $this->load->view('training_view', $data);
    }

}

?>

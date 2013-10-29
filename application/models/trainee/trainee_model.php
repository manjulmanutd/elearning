<?php

class Trainee_model extends CI_Model {

    function getAllBranches() {

        return $this->db->get('tbl_branch')->result();
    }

    function getAllTrainings() {

        $username = $this->session->userdata('user');
        $result1 = $this->db->get_where('tbl_users', array('username' => $username))->row();

        $result = $this->db->get_where('tbl_enrollment', array('user_id' => $result1->user_id))->row();
        $this->db->select_min('lesson_id');
        $lesson = $this->db->get_where('tbl_training', array('course_id' => $result->course_id))->row();


        $this->db->select('*');
        $this->db->from('tbl_course_session');
        $this->db->join('tbl_training', 'tbl_course_session.session_id=tbl_training.session_id');
        $this->db->join('tbl_course', 'tbl_course.course_id=tbl_training.course_id');
        $this->db->where('tbl_course_session.course_id', $result->course_id);
        $this->db->where('tbl_training.lesson_id', $lesson->lesson_id);
        $this->db->where('tbl_training.status', 1);
        $this->db->where('tbl_course_session.status', 1);
        $this->db->order_by('tbl_training.training_date');
        return $this->db->get()->result();
        //   return $this->db->get_where('tbl_course_session',array('course_id'=>$result->course_id))->result();
    }

    function getTimeSlotNameById($id) {

        return $this->db->get_where('tbl_timeslot_trainings', array('timeslot_id' => $id))->row();
    }

    function getLessonNameById($id) {

        return $this->db->get_where('tbl_lesson', array('lesson_id' => $id))->row();
    }

    function getCourseDetailsById($id) {

        return $this->db->get_where('tbl_course', array('course_id' => $id))->row();
    }

    function getCourseNameById($id) {

        return $this->db->get_where('tbl_course', array('course_id' => $id))->row();
    }

    function getTrainerNameById($id) {

        return $this->db->get_where('tbl_trainer', array('trainer_id' => $id))->row();
    }

    function getTrainerNameByCourse($courseId) {

        $result = $this->db->get_where('tbl_course_trainer', array('course_id' => $courseId))->row();

        return $this->db->get_where('tbl_trainer', array('trainer_id' => $result->trainer_id))->row();
    }

    function getAllCourseDocs() {
        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();

        $training = $this->db->get_where('tbl_training_users', array('user_id' => $result->user_id))->row();

        if (!empty($training)) {
            $session = $this->db->get_where('tbl_training', array('training_id' => $training->training_id))->row();

            $lessons = $this->db->get_where('tbl_training', array('session_id' => $session->session_id))->result();
            foreach ($lessons as $les) {
                $lesson[] = $les->lesson_id;
            }

            $this->db->where_in('lesson_id', $lesson);
            return $this->db->get_where('tbl_doc', array('doc_type' => 1))->result();
        } else {
            return null;
        }
    }

    function getAllCourseAssigns() {
        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();

        $training = $this->db->get_where('tbl_training_users', array('user_id' => $result->user_id))->row();

        if (!empty($training)) {
            $session = $this->db->get_where('tbl_training', array('training_id' => $training->training_id))->row();

            $lessons = $this->db->get_where('tbl_training', array('session_id' => $session->session_id))->result();
            foreach ($lessons as $les) {
                $lesson[] = $les->lesson_id;
            }

            $this->db->where_in('lesson_id', $lesson);
            return $this->db->get_where('tbl_doc', array('doc_type' => 2))->result();
        } else {
            return null;
        }
    }

    function view_docs() {
        $id = $this->uri->segment(3);
        $quer = "select * from tbl_doc where doc_id='$id'";
        $result = mysql_query($quer);
        if (mysql_num_rows($result) > 0) {
            return $result;
        }
        else
            return NULL;
    }

    function download($id) {
        $q = "select doc_file from tbl_doc where doc_id='$id' and isDownloadable=1";
        $result = mysql_query($q);
        if (mysql_num_rows($result) > 0) {
            return $result;
        }
        else
            return NULL;
    }

    function getStartDate($id) {

        $this->db->select_min('lesson_id');
        $this->db->select('training_date');
        return $this->db->get_where('tbl_training', array('session_id' => $id))->row();
    }

    function getTraineeDetails() {

        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();
        return $result;
    }

    function getSessionNameById($id) {
        $this->db->select('session_id');
        $result = $this->db->get_where('tbl_training', array('training_id' => $id))->row();

        $this->db->select('session_name');
        return $this->db->get_where('tbl_course_session', array('session_id' => $result->session_id))->row();
    }

    function getEnrollmentStatus() {
        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();
        return $this->db->get_where('tbl_enrollment', array('user_id' => $result->user_id))->row();
    }

    function getPaymentStatus() {
        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();

        $this->db->where_in('course_status', array(0, 1, 2));
        $course = $this->db->get_where('tbl_course_log', array('user_id' => $result->user_id))->row();

        $this->db->where_in('status', array(1, 2));
        return $this->db->get_where('tbl_paypal_log', array('user_id' => $result->user_id, 'course_id' => $course->course_id))->row();
    }

    function getAppointmentStatus() {
        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();
        $this->db->where_in('status', array(0));
        return $this->db->get_where('tbl_paypal_log', array('user_id' => $result->user_id))->row();
    }

    function getCourseStatus() {
        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();


        $this->db->where_in('course_status', array(1, 2));

        return $this->db->get_where('tbl_course_log', array('user_id' => $result->user_id))->row();
    }

    function getLessonActiveStatus() {
        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();


        $this->db->where_in('lesson_status', array(1));

        return $this->db->get_where('tbl_training_users', array('user_id' => $result->user_id))->row();
    }

    function getAppointmentDetails() {
        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();
        return $this->db->get_where('tbl_appointments', array('user_id' => $result->user_id,
                    'status' => 1))->row();
    }

    function getAppointmentTimeById($id) {

        return $this->db->get_where('tbl_timeslot_appointments', array('id' => $id))->row();
    }

    function getAdminName($id) {

        return $this->db->get_where('tbl_admin', array('branch_id' => $id))->row();
    }

    function getAllSchedules() {

        $trainer = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $trainer))->row();
        $user_id = $result->user_id;

        $training = $this->db->get_where('tbl_training_users', array('user_id' => $user_id, 'course_status' => 1))->row();
        if (!empty($training)) {
            $session = $this->db->get_where('tbl_training', array('training_id' => $training->training_id))->row();

            $this->db->select('lesson_id');
            $this->db->distinct();
            $this->db->order_by('training_date');
            return $this->db->get_where('tbl_training', array('session_id' => $session->session_id, 'status' => 1))->result();
        } else {
            return null;
        }
    }

    function getTrainingNameById($id) {

        return $this->db->get_where('tbl_timeslot_schedule', array('id' => $id))->row();
    }

    function submit_assignment() {

        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();

        $user_id = $result->user_id;
        $training_id = $this->input->post('schedule_id');

        $lesson_id = $this->db->get_where('tbl_training_schedule', array('schedule_id' => $training_id))->row()->lesson_id;


        $file_name = time() . "_" . rand("100000", "999999");
        $ext = end(explode('.', $_FILES['file']['name']));

        $complete = $file_name . "." . $ext;
        $path = str_replace('system/', '', BASEPATH) . '/docs/' . $complete;
        if (move_uploaded_file($_FILES['file']['tmp_name'], $path)) {
            $data = array('doc_file' => $complete,
                'training_id' => $training_id,
                'user_id' => $user_id,
                'lesson_id' => $lesson_id,
                'status' => 0
            );

            $this->db->insert('tbl_assignment_users', $data);
        } else {

            $data = array(
                'training_id' => $training_id,
                'doc_file' => '',
                'user_id' => $user_id,
                'lesson_id' => $lesson_id,
                'status' => 0
            );

            $this->db->insert('tbl_assignment_users', $data);
        }
    }

    function addFeedback() {

        $courseId = $this->uri->segment('3');
        $userId = $this->uri->segment('4');


        $course_feedback = $this->input->post('course_feedback');

        $this->db->insert('tbl_feedback', array('course_id' => $courseId, 'user_id' => $userId, 'course_feedback' => $course_feedback));




        $this->db->where('user_id', $userId);
        $this->db->where('course_id', $courseId);
        $this->db->update('tbl_course_log', array('course_status' => 3));
    }

    function markLessonComplete($trainingId) {
        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();

        $data = array('lesson_status' => 2);
        $this->db->where('training_id', $trainingId);
        $this->db->where('user_id', $result->user_id);
        $this->db->update('tbl_training_users', $data);
    }

    function markCourseComplete($trainingId) {
        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();

        $course = $this->db->get_where('tbl_training_schedule', array('schedule_id' => $trainingId))->row();
        $data = array('course_status' => 2);
        $this->db->where('course_id', $course->course_id);
        $this->db->where('user_id', $result->user_id);
        $this->db->update('tbl_course_log', $data);
    }

    function isTrainingComplete($training_id) {
        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();

        return $this->db->get_where('tbl_training_users', array('user_id' => $result->user_id, 'training_id' => $training_id))->row();
    }

    function getAllCourses() {

        return $this->db->get('tbl_course')->result();
    }

    function enroll_now($userId, $courseId) {

        $firstname = $this->input->post('first_name');
        $lastname = $this->input->post('last_name');
        $gender = $this->input->post('gender');
        $address = $this->input->post('address');
        $post_code = $this->input->post('post_code');
        $dob = $this->input->post('dob');
        $ni_number = $this->input->post('ni_number');
        $contact_number = $this->input->post('contact_number');
        $alt_number = $this->input->post('alt_number');
        $emergency_contact_name = $this->input->post('emergency_contact_name');
        $emergency_contact_no = $this->input->post('emergency_contact_no');
        $pref_start_date = $this->input->post('pref_start_date');
        $course_id = $this->input->post('course_id');
        $q1_ideal_accnt = $this->input->post('q1_ideal_accnt');
        $q2_industry = $this->input->post('q2_industry');
        $q3_salary = $this->input->post('q3_salary');
        $q4_jobs_applied = $this->input->post('q4_jobs_applied');
        $q5_doing_what = $this->input->post('q5_doing_what');
        $status = 0;

        $data = array(
            'user_id' => $userId,
            'first_name' => $firstname,
            'last_name' => $lastname,
            'gender' => $gender,
            'address' => $address,
            'post_code' => $post_code,
            'dob' => $dob,
            'ni_number' => $ni_number,
            'contact_number' => $contact_number,
            'alt_number' => $alt_number,
            'emergency_contact_name' => $emergency_contact_name,
            'emergency_contact_no' => $emergency_contact_no,
            'pref_start_date' => $pref_start_date,
            'course_id' => $course_id,
            'q1_ideal_accnt' => $q1_ideal_accnt,
            'q2_industry' => $q2_industry,
            'q3_salary' => $q3_salary,
            'q4_jobs_applied' => $q4_jobs_applied,
            'q5_doing_what' => $q5_doing_what,
            'status' => $status);

        $this->db->insert('tbl_enrollment', $data);

        $data1 = array('course_id' => $course_id,
            'user_id' => $userId,
            'enrollment_status' => 1,
            'course_status' => 0,
            'payment_status' => 0);
        $this->db->insert('tbl_course_log', $data1);
    }

    function start_training($trainingId) {
        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();

        $userId = $result->user_id;
        $this->db->where_in('course_status', array(0, 1));
        $courseId = $this->db->get_where('tbl_course_log', array('user_id' => $result->user_id))->row()->course_id;
        $branchId = $result->branch_id;
        $lesson = $this->db->get_where('tbl_training_schedule', array('schedule_id' => $trainingId))->row();
        $paymentStatus = 1;
        $lessonStatus = 1;
        $enrollmentStatus = 1;

        $data = array('user_id' => $userId,
            'training_id' => $trainingId,
            'branch_id' => $branchId,
            'course_id' => $courseId,
            'lesson_id' => $lesson->lesson_id,
            'enrollment_status' => $enrollmentStatus,
            'lesson_status' => $lessonStatus,
            'payment_status' => $paymentStatus);

        $this->db->insert('tbl_training_users', $data);

        $data1 = array('course_status' => 1);

        $this->db->where('user_id', $userId);
        $this->db->where('course_id', $courseId);
        $this->db->update('tbl_course_log', $data1);
    }

    function getAllCoursesByBranch() {
        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();

        return $this->db->get_where('tbl_course', array('branch_id' => $result->branch_id))->result();
    }
    
     function getAllCoursesByBranchId($branch_id) {
       
        return $this->db->get_where('tbl_course', array('branch_id' => $branch_id))->result();
    }

    function getAllLessons() {
        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();

        $course = $this->db->get_where('tbl_course_log', array('user_id' => $result->user_id))->row();

        return $this->db->get_where('tbl_lesson', array('course_id' => $course->course_id))->result();
    }

    function getTrainingsByLesson($lessonId) {
        if ($lessonId != 0) {
            return $this->db->get_where('tbl_training_schedule', array('lesson_id' => $lessonId, 'status' => 1))->result();
        } else {
            return null;
        }
    }

    function getLessonNameByTraining($trainingId) {
        $result = $this->db->get_where('tbl_training_schedule', array('schedule_id' => $trainingId))->row();

        return $this->db->get_where('tbl_lesson', array('lesson_id' => $result->lesson_id))->row();
    }

    function getLessonCompleteStatus() {

        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();

        $this->db->where_in('course_status', array(0, 1));
        $course = $this->db->get_where('tbl_course_log', array('user_id' => $result->user_id))->row();

        if (!empty($course)) {
            $course = $this->db->get_where('tbl_course', array('course_id' => $course->course_id))->row();

            $training = $this->db->get_where('tbl_training_users', array('course_id' => $course->course_id))->result();
            $allLessons = $this->db->get_where('tbl_lesson', array('course_id' => $course->course_id))->result();


            foreach ($allLessons as $lesson) {


                $trainingId = $this->db->get_where('tbl_training_users', array('lesson_id' => $lesson->lesson_id,
                            'user_id' => $result->user_id))->row();

                if (!empty($trainingId)) {
                    $lessonStat = $this->db->get_where('tbl_training_users', array('user_id' => $result->user_id,
                                'lesson_status' => 2,
                                'training_id' => $trainingId->training_id))->row();
                    //print_r($lessonStat->lesson_status);
                    if (!empty($lessonStat)) {
                        $statLesson[] = 1;
                    } else {
                        $statLesson[] = 0;
                    }

                    //print_r($statLesson);
                    $stat[] = 1;
                } else {
                    $stat[] = 0;
                }
            }

            if (in_array(0, $stat) || in_array(0, $statLesson)) {
                return 0;
            } else {
                return 1;
            }
        } else {
            return 0;
        }
    }

    function getAllAvailableLessons() {

        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();

        $this->db->where_in('course_status', array(0, 1));
        $course = $this->db->get_where('tbl_course_log', array('user_id' => $result->user_id))->row();

        $bookings = $this->db->get_where('tbl_training_bookings', array('course_id' => $course->course_id,
                    'user_id' => $result->user_id))->result();
        if (!empty($bookings)) {
            foreach ($bookings as $booking) {

                $book[] = $booking->training_id;
            }
            $this->db->where_in('training_id', $book);
            $lessons = $this->db->get_where('tbl_training', array('course_id' => $course->course_id))->result();

            if (!empty($lessons)) {
                foreach ($lessons as $lesson) {

                    $less[] = $lesson->lesson_id;
                }
            } else {
                $less[] = 0;
            }
        } else {
            $less[] = 0;
        }



        $this->db->where_not_in('lesson_id', $less);

        return $this->db->get_where('tbl_lesson', array('course_id' => $course->course_id))->result();
    }

    function getTrainingDate($trainingId) {

        return $this->db->get_where('tbl_training_schedule', array('schedule_id' => $trainingId))->row();
    }

    function getEnrolledSchedules() {
        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();

        $this->db->where_in('course_status', array(0, 1));
        $course = $this->db->get_where('tbl_course_log', array('user_id' => $result->user_id))->row();

        $this->db->select('*');
        $this->db->from('tbl_training');
        $this->db->join('tbl_training_bookings', 'tbl_training.training_id=tbl_training_bookings.training_id');
        $this->db->join('tbl_course', 'tbl_training.course_id=tbl_course.course_id');
        $this->db->where('tbl_training.course_id', $course->course_id);
        $this->db->where('tbl_training_bookings.user_id', $result->user_id);
        return $this->db->get()->result();
    }

    function getAssignmentBySchedule($scheduleId) {
        if ($scheduleId != 0) {
            return $this->db->get_where('tbl_doc', array('schedule_id' => $scheduleId, 'doc_type' => 2))->result();
        } else {
            return NULL;
        }
    }

    function getDocumentBySchedule($scheduleId) {
        if ($scheduleId != 0) {
            return $this->db->get_where('tbl_doc', array('schedule_id' => $scheduleId, 'doc_type' => 1))->result();
        } else {
            return NULL;
        }
    }

    function getTrainingDetails($trainingId) {

        return $this->db->get_where('tbl_training_schedule', array('schedule_id' => $trainingId))->row();
    }

    function getCourseProgress($courseId) {
        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();

        // $this->db->where_in('course_status', array(0, 1));
        //$courseId = $this->db->get_where('tbl_course_log', array('user_id' => $result->user_id))->row();

        $this->db->select('*');
        $this->db->from('tbl_training');
        $this->db->join('tbl_training_bookings', 'tbl_training.training_id=tbl_training_bookings.training_id');
        $this->db->join('tbl_course', 'tbl_training.course_id=tbl_course.course_id');
        $this->db->where('tbl_training_bookings.user_id', $result->user_id);
        $this->db->where('tbl_training_bookings.course_id', $courseId);

        $assignedLessons = $this->db->get()->result();

        $allLessons = $this->db->get_where('tbl_lesson', array('course_id' => $courseId))->result();
        if (!empty($assignedLessons)) {

            $i = 0;
            $k = 0;
            foreach ($assignedLessons as $lesson) {

                $less[] = $lesson->training_status;
            }

            foreach ($allLessons as $lesson) {
                $i++;
                // $less[] = $lesson->lesson_status;
            }
            $totalLesson = $i;
            // echo $totalLesson;

            for ($j = 0; $j < count($less); $j++) {
                if ($less[$j] == 1) {
                    $k++;
                } else {
                    $k = $k;
                }
            }

            $totalPercentage = $k / $totalLesson * 100;
            return round($totalPercentage, 2);
        } else {
            return 0;
        }
    }

    function getTotalMarks($course_id) {
        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();

        $this->db->where_in('course_status', array(0, 1));
        $courseId = $this->db->get_where('tbl_course_log', array('user_id' => $result->user_id))->row();

        $this->db->select('*');
        $this->db->from('tbl_training');
        $this->db->join('tbl_training_bookings', 'tbl_training.training_id=tbl_training_bookings.training_id');
        $this->db->join('tbl_course', 'tbl_training.course_id=tbl_course.course_id');
        $this->db->where('tbl_training_bookings.user_id', $result->user_id);
        $this->db->where('tbl_training_bookings.course_id', $course_id);

        $lessons = $this->db->get()->result();


        if (!empty($lessons)) {
            $i = 0;
            foreach ($lessons as $lesson) {
                $i++;
                $less[] = $this->db->get_where('tbl_training', array('lesson_id' => $lesson->lesson_id
                        ))->row()->training_id;
            }

            $totalObtainedMarks = 0;
            for ($j = 0; $j < count($less); $j++) {
                $lessonMarks = $this->db->get_where('tbl_training_feedback', array('user_id' => $result->user_id, 'training_id' => $less[$j]))->row();
                if (!empty($lessonMarks)) {
                    $lessonMark = $lessonMarks->assignment_marks;
                } else {
                    $lessonMark = 0;
                }
                $totalObtainedMarks = $totalObtainedMarks + $lessonMark;
            }

            $totalMarks = $i * 10;
            $percentage = $totalObtainedMarks / $totalMarks * 100;

            return round($percentage, 2);
        } else {
            return 0;
        }
    }

    function getAllEnrolledCourses() {
        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();

        $this->db->select('*');
        $this->db->from('tbl_course_log');
        $this->db->join('tbl_course', 'tbl_course_log.course_id=tbl_course.course_id');
        $this->db->where('tbl_course_log.user_id', $result->user_id);
        $this->db->where('tbl_course_log.enrollment_status', 1);
        return $this->db->get_where()->result();
    }

    function getActiveCourse() {
        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();

        $this->db->where_in('course_status', array(0, 1));
        return $this->db->get_where('tbl_course_log', array('user_id' => $result->user_id))->row();
    }

    function getBookedSessions($course_id) {
        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();

        $this->db->where_in('course_status', array(0, 1));
        $courseId = $this->db->get_where('tbl_course_log', array('user_id' => $result->user_id))->row();

        $this->db->select('*');
        $this->db->from('tbl_training_bookings');
        $this->db->join('tbl_training', 'tbl_training_bookings.training_id=tbl_training.training_id');
        $this->db->where('tbl_training_bookings.user_id', $result->user_id);
        $this->db->where('tbl_training_bookings.course_id', $course_id);
        return $this->db->get()->result();
    }

    function cancelBooking() {

        $id = $this->uri->segment('3');
        $this->db->delete('tbl_training_bookings', array('booking_id' => $id));
    }

    function getAllFeedbacks() {
        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();

        $this->db->where_in('course_status', array(0, 1));
        $course = $this->db->get_where('tbl_course_log', array('user_id' => $result->user_id))->row();

        $this->db->select('*');
        $this->db->from('tbl_training_feedback');
        $this->db->join('tbl_training_bookings', 'tbl_training_feedback.training_id=tbl_training_bookings.training_id');
        $this->db->join('tbl_training', 'tbl_training.training_id=tbl_training_bookings.training_id');
        $this->db->where('tbl_training_bookings.course_id', $course->course_id);
        $this->db->where('tbl_training_feedback.user_id', $result->user_id);
    }

    function getFeedbackByLesson() {
        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();

        $user_id = $result->user_id;
        $training_id = $this->uri->segment('3');
        return $this->db->get_where('tbl_training_feedback_sessions', array('training_id' => $training_id, 'user_id' => $user_id))->row();
    }

    function provideFeedbackSession($trainingId) {
        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();

        $remarks = $this->input->post('remarks');

        $status = $this->db->get_where('tbl_training_feedback_sessions', array('training_id' => $trainingId, 'user_id' => $result->user_id))->row();
        $data = array('training_id' => $trainingId,
            'user_id' => $result->user_id,
            'remarks' => $remarks);
        if (!empty($status)) {
            $this->db->where('training_id', $trainingId);
            $this->db->where('user_id', $result->user_id);
            $this->db->update('tbl_training_feedback_sessions', $data);
        } else {
            $this->db->insert('tbl_training_feedback_sessions', $data);
        }
    }

    function getCourseCompleteStatus($courseId) {
        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();

        $this->db->where_in('course_status', array(0, 1));
        $course = $this->db->get_where('tbl_course_log', array('user_id' => $result->user_id))->row();

        $this->db->select('*');
        $this->db->from('tbl_training');
        $this->db->join('tbl_training_bookings', 'tbl_training.training_id=tbl_training_bookings.training_id');
        $this->db->where('tbl_training_bookings.user_id', $result->user_id);
        $this->db->where('tbl_training_bookings.course_id', $courseId);

        $assignedLessons = $this->db->get()->result();

        $allLessons = $this->db->get_where('tbl_lesson', array('course_id' => $courseId))->result();
        if (!empty($assignedLessons)) {

            $i = 0;
            $k = 0;
            foreach ($assignedLessons as $lesson) {

                $less[] = $lesson->training_status;
            }

            foreach ($allLessons as $lesson) {
                $i++;
                // $less[] = $lesson->lesson_status;
            }
            $totalLesson = $i;
            // echo $totalLesson;

            for ($j = 0; $j < count($less); $j++) {
                if ($less[$j] == 1) {
                    $k++;
                } else {
                    $k = $k;
                }
            }

            $totalPercentage = $k / $totalLesson * 100;
            $percent = round($totalPercentage, 2);
            if ($percent == 100) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    function getAllTimeSlots() {

        return $this->db->get('tbl_timeslot_schedule')->result();
    }

    function inspectWorkingDay($day, $date) {

        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();

        $this->db->where_in('course_status', array(0, 1));
        $course = $this->db->get_where('tbl_course_log', array('user_id' => $result->user_id))->row();
        $branch = $this->db->get_where('tbl_course', array('course_id' => $course->course_id))->row();

        $actualDate = strtotime($date);
        $dateString = "%Y-%m-%d";
        $time = time();
        $today = mdate($dateString, $time);
        $curDate = strtotime($today);

        if ($actualDate >= $curDate) {
            $result = $this->db->get_where('tbl_holidays', array('holiday_date' => $date))->result();

            if ($day == 'Sun' && empty($result)) {
                return $this->db->get_where('tbl_working_days', array('day_sun' => 1, 'branch_id' => $branch->branch_id))->row();
            } else if ($day == 'Mon' && empty($result)) {
                return $this->db->get_where('tbl_working_days', array('day_mon' => 1, 'branch_id' => $branch->branch_id))->row();
            } else if ($day == 'Tue' && empty($result)) {
                return $this->db->get_where('tbl_working_days', array('day_tue' => 1, 'branch_id' => $branch->branch_id))->row();
            } else if ($day == 'Wed' && empty($result)) {
                return $this->db->get_where('tbl_working_days', array('day_wed' => 1, 'branch_id' => $branch->branch_id))->row();
            } else if ($day == 'Thu' && empty($result)) {
                return $this->db->get_where('tbl_working_days', array('day_thu' => 1, 'branch_id' => $branch->branch_id))->row();
            } else if ($day == 'Fri' && empty($result)) {
                return $this->db->get_where('tbl_working_days', array('day_fri' => 1, 'branch_id' => $branch->branch_id))->row();
            } else if ($day == 'Sat' && empty($result)) {
                return $this->db->get_where('tbl_working_days', array('day_sat' => 1, 'branch_id' => $branch->branch_id))->row();
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    function bookUserSession() {

        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();

        $userId = $result->user_id;
        $lessonId = $this->input->post('lesson_id');
        $sessionDate = $this->input->post('booking_date');
        $timeslot = $this->input->post('timeslot');
        $course = $this->db->get_where('tbl_lesson', array('lesson_id' => $lessonId))->row();

        $data = array('training_date' => $sessionDate,
            'lesson_id' => $lessonId,
            'course_id' => $course->course_id,
            'timeslot' => $timeslot,
            'training_status' => 0);

        $status = $this->db->get_where('tbl_training', array('training_date' => $sessionDate,
                    'lesson_id' => $lessonId,
                    'timeslot' => $timeslot))->row();
        //print_r($status); exit;
        if (!empty($status)) {

            $trainingId = $status->training_id;
            $bookindData = array('training_id' => $trainingId, 'course_id' => $course->course_id, 'user_id' => $userId);
            $this->db->insert('tbl_training_bookings', $bookindData);
        } else {

            $this->db->insert('tbl_training', $data);

            $status1 = $this->db->get_where('tbl_training', array('training_date' => $sessionDate,
                        'lesson_id' => $lessonId,
                        'timeslot' => $timeslot))->row();

            //print_r($status1); exit;
            $trainingId = $status1->training_id;
            $bookindData = array('training_id' => $trainingId, 'course_id' => $course->course_id, 'user_id' => $userId);
            $this->db->insert('tbl_training_bookings', $bookindData);

            $userEmail = $this->db->get_where('tbl_users', array('user_id' => $userId))->row()->email;
            $trainerId = $this->db->get_where('tbl_course_trainer', array('course_id' => $course->course_id))->row();
            if (!empty($trainerId)) {
                $trainerEmail = $this->db->get_where('tbl_trainer', array('trainer_id' => $trainerId->trainer_id))->row()->email;
            } else {
                $trainerEmail = 'trainer@trainer.com';
            }

            $branchId = $this->db->get_where('tbl_course', array('course_id' => $course->course_id))->row()->branch_id;
            $adminEmail = $this->db->get_where('tbl_admin', array('branch_id' => $branchId))->row()->admin_email1;
            $this->load->library('email');
            $email_config = Array(
                'mailtype' => 'html'
            );

            $data['booking_date'] = $sessionDate;
            $data['timeslot'] = $timeslot;
            $data['courseId'] = $course->course_id;
            $data['lessonId'] = $lessonId;
            $this->email->initialize($email_config);
            $this->email->from('noreply@work-experience.tdanda.co.uk', 'Work Experience');
            $list = array($userEmail, $trainerEmail, $adminEmail);
            $this->email->to($list);
            $this->email->subject("Booking Details");
            $message = $this->load->view('pages/email/booking_details', $data, TRUE);
            $this->email->message($message);
            $this->email->send();
        }
    }

    function checkDateBookings($date) {

        $this->db->select('*');
        $this->db->from('tbl_training_bookings');
        $this->db->join('tbl_training', 'tbl_training.training_id=tbl_training_bookings.training_id');
        $this->db->where('tbl_training.training_date', $date);
        $result = $this->db->get()->result();
        return count($result);
    }

    function completeCourse($id) {

        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();

        $this->db->where('course_id', $id);
        $this->db->where('user_id', $result->user_id);
        $this->db->update('tbl_course_log', array('course_status' => 2));
    }

    function getCourseSchedules($courseId) {
        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();

        $this->db->select('*');
        $this->db->from('tbl_training');
        $this->db->join('tbl_training_bookings', 'tbl_training.training_id=tbl_training_bookings.training_id');
        $this->db->where('tbl_training.course_id', $courseId);
        $this->db->where('tbl_training_bookings.user_id', $result->user_id);
        return $this->db->get()->result();
    }

    function getAllFeedbacksByCourse($courseId) {
        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();

        $this->db->select('*');
        $this->db->from('tbl_training_feedback');
        $this->db->join('tbl_training_bookings', 'tbl_training_feedback.training_id=tbl_training_bookings.training_id');
        $this->db->join('tbl_training', 'tbl_training.training_id=tbl_training_bookings.training_id');
        $this->db->where('tbl_training_bookings.course_id', $courseId);
        $this->db->where('tbl_training_feedback.user_id', $result->user_id);
        return $this->db->get()->result();
    }

    function getCourseByBranch() {
        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();
        $courses = $this->db->get_where('tbl_course_log', array('user_id' => $result->user_id))->result();

        if (!empty($courses)) {
            foreach ($courses as $course) {
                $cours[] = $course->course_id;
            }
        } else {
            $cours[] = 0;
        }
        $this->db->where_not_in('course_id', $cours);
        return $this->db->get_where('tbl_course', array('branch_id' => $result->branch_id))->result();
    }

    function enroll_another() {

        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();

        $newBranch = $result->branch_id;
        $newCourse = $this->input->post('course_id');

        $data = array('user_id' => $result->user_id,
            'course_id' => $newCourse,
            'enrollment_status' => 1,
            'course_status' => 0,
            'payment_status' => 0);
        $this->db->insert('tbl_course_log', $data);
    }

    function sendMessage() {

        $this->load->helper('date');

        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();
        //$trainee = $this->db->get_where('tbl_users',array('user_id'=>$traineeId))->row();

        $admin = $this->db->get_where('tbl_admin', array('branch_id' => $result->branch_id))->row();

        $subject = $this->input->post('subject');
        $message = $this->input->post('message');

        $this->load->library('email');
        $email_config = Array(
            'mailtype' => 'html'
        );
//
        $this->email->initialize($email_config);
        $this->email->from($result->email, $result->first_name . " " . $result->last_name);
        $this->email->to($admin->admin_email1);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();


        $date = now();
        $format = "%Y-%m-%d";
        $data = array('subject' => $subject,
            'message' => $message,
            'sender_id' => 3,
            'reciever_id' => 1,
            'trainer_id' => 0,
            'user_id' => $result->user_id,
            'admin_id' => $admin->admin_id,
            'sent_date' => mdate($format, $date)
        );

        $this->db->insert('tbl_messaging', $data);
    }

    function sendMessageTrainer($courseId) {

        $this->load->helper('date');

        $username = $this->session->userdata('user');
        $result = $this->db->get_where('tbl_users', array('username' => $username))->row();
        //$trainee = $this->db->get_where('tbl_users',array('user_id'=>$traineeId))->row();
        $trainerId = $this->db->get_where('tbl_course_trainer', array('course_id' => $courseId))->row()->trainer_id;
        $trainer = $this->db->get_where('tbl_trainer', array('trainer_id' => $trainerId))->row();
        //$admin = $this->db->get_where('tbl_admin', array('branch_id' => $result->branch_id))->row();

        $subject = $this->input->post('subject');
        $message = $this->input->post('message');

        $this->load->library('email');
        $email_config = Array(
            'mailtype' => 'html'
        );
//
        $this->email->initialize($email_config);
        $this->email->from($result->email, $result->first_name . " " . $result->last_name);
        $this->email->to($trainer->email);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();


        $date = now();
        $format = "%Y-%m-%d";
        $data = array('subject' => $subject,
            'message' => $message,
            'sender_id' => 3,
            'reciever_id' => 2,
            'trainer_id' => $trainer->trainer_id,
            'user_id' => $result->user_id,
            'admin_id' => 0,
            'sent_date' => mdate($format, $date)
        );

        $this->db->insert('tbl_messaging', $data);
    }

    function getAllMessages() {
        $this->db->order_by('sent_date', 'asc');
        return $this->db->get_where('tbl_announcement', array('ann_to' => 3))->result();
    }

    function getTerms() {
        return $this->db->get_where('tbl_terms', array('term_id' => 1))->row();
    }

    function getSessionNumber() {

        return $this->db->get_where('tbl_session_number', array('id' => 1))->row();
    }

}

?>
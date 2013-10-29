<?php

class Super_site_conf_model extends CI_Model {

    function login_setting() {
        $q = mysql_query("SELECT * FROM tbl_admin where user_type=0");
        if (mysql_num_rows($q) > 0) {
            return $q;
        }
        else
            return NULL;
    }

    function edit_login() {
        $un = $this->input->post('ad_un');
        $old_pw = $this->input->post('old');
        $new_pw = $this->input->post('new');
        if (!($new_pw)) {
            $new_pw = $old_pw;
        }
        $first = $this->input->post('first_email');
        $second = $this->input->post('second_email');
        $q = "update tbl_admin set admin_username='$un', admin_password='$new_pw', admin_email1='$first', admin_email2='$second', status=1 where user_type = 0";
        $res = mysql_query($q);
        if ($res) {
            return $res;
        }
        else
            return false;
    }

    function site_setting() {
        $q = "select * from tbl_configuration";
        $res = mysql_query($q);
        if (mysql_num_rows($res) > 0) {
            return $res;
        }
        else
            return NULL;
    }

    function edit_site_setting() {
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $contact = $this->input->post('contact');
        $file_name = time() . "_" . rand("100000", "999999");
        $ext = end(explode('/', $_FILES['logo']['type']));
        if ($ext != '') {
            $complete = $file_name . "." . $ext;
            $path = str_replace('system/', '', BASEPATH) . 'images/admin/' . $complete;
            if (move_uploaded_file($_FILES['logo']['tmp_name'], $path)) {
                $q = "select site_logo from tbl_configuration";
                $res = mysql_query($q);
                if (mysql_num_rows($res) > 0) {
                    $img = mysql_fetch_assoc($res);
                    unlink(str_replace('system/', '', BASEPATH) . 'images/admin/' . $img['site_logo']);
                }
                else
                    return NULL;
            }
            $q = "update tbl_configuration set site_name='$name', site_email='$email', site_logo='$complete', site_contact='$contact'";
        }
        else {
            $q = "update tbl_configuration set site_name='$name', site_email='$email',site_contact='$contact'";
        }
        $res = mysql_query($q);
        if ($res) {
            return $res;
        }
        else
            return NULL;
    }

    function getSliderImages() {

        return $this->db->get('tbl_slider_images')->result();
    }

    function addSliderImage() {


        $active = 1;


        $file_name = time() . "_" . rand("100000", "999999");
        $ext = end(explode('.', $_FILES['image_name']['name']));
        $complete = $file_name . "." . $ext;
        $path = str_replace('system/', '', BASEPATH) . '/slider/' . $complete;

        if (move_uploaded_file($_FILES['image_name']['tmp_name'], $path)) {
            $data = array('image_name' => $complete, 'status' => $active);
            $this->db->insert('tbl_slider_images', $data);
        } else {
            $data = array('image_name' => '', 'status' => $active);
            $this->db->insert('tbl_slider_images', $data);
        }
    }

    function removeImage() {
        $id = $this->uri->segment('3');
        $result = $this->db->get_where('tbl_slider_images', array('image_id' => $id))->row();
        $path = str_replace('system/', '', BASEPATH) . '/slider/' . $result->image_name;
        $this->db->delete('tbl_slider_images', array('image_id' => $id));
        unlink($path);
    }

    function getHomePage() {

        return $this->db->get_where('tbl_staticpages', array('staticpage_id' => 1))->row();
    }

    function updateHomePage() {

        $title = $this->input->post('staticpage_title');
        $content = $this->input->post('staticpage_content');

        $this->db->where('staticpage_id', 1);
        $this->db->update('tbl_staticpages', array('staticpage_title' => $title, 'staticpage_content' => $content));
    }

    function getTerms() {
        return $this->db->get_where('tbl_terms', array('term_id' => 1))->row();
    }

    function updateTerms() {

        $title = $this->input->post('terms');


        $this->db->where('term_id', 1);
        $this->db->update('tbl_terms', array('terms' => $title));
    }

    function getUserHome() {
        return $this->db->get_where('tbl_staticpages', array('staticpage_id' => 21))->row();
    }

    function updateUserHome() {

        $title = $this->input->post('user_home');


        $this->db->where('staticpage_id', 21);
        $this->db->update('tbl_staticpages', array('staticpage_content' => $title));
    }

    function getSessionNumber() {

        return $this->db->get_where('tbl_session_number', array('id' => 1))->row();
    }

    function updateSessionNumber() {

        $sessNum = $this->input->post('number_session');
        $this->db->where('id', 1);
        $this->db->update('tbl_session_number', array('number_session' => $sessNum));
    }

    function getPageTitle() {

        return $this->db->get_where('tbl_page_title', array('id' => 1))->row();
    }

    function updatePageTitle() {

        $pageTitle = $this->input->post('page_title');
        $this->db->where('id', 1);
        $this->db->update('tbl_page_title', array('page_title' => $pageTitle));
    }

    function getAllBranches() {
        return $this->db->get('tbl_branch')->result();
    }

    function getCoursesByBranch($branchId) {

        return $this->db->get_where('tbl_course', array('branch_id' => $branchId))->result();
    }

    function addCourse() {

        $name = $this->input->post('course_name');
        $desc = $this->input->post('course_desc');
        $fee = $this->input->post('course_fee');
        $branch_id = $this->input->post('branch_id');

        if (isset($_POST['active'])) {
            $active = 1;
        }
        else
            $active = 0;

        $data = array('course_name' => $name,
            'course_description' => $desc,
            'course_fee' => $fee,
            'branch_id' => $branch_id,
            'status' => $active);
        return $this->db->insert('tbl_course', $data);
    }

    function editCourse() {

        $id = $this->uri->segment(3);
        $name = $this->input->post('course_name');
        $desc = $this->input->post('course_desc');
        $fee = $this->input->post('course_fee');
        $branch_id = $this->input->post('branch_id');
        //$batchId = 0;
        if (isset($_POST['active'])) {
            $active = 1;
        }
        else
            $active = 0;

        $data = array('course_name' => $name,
            'course_description' => $desc,
            'course_fee' => $fee,
            'branch_id' => $branch_id,
            'status' => $active);
        $this->db->where('course_id', $id);
        return $this->db->update('tbl_course', $data);
    }

    function getAllCoursesByID() {
        $id = $this->uri->segment(3);
        if (!empty($id)) {
            return $this->db->get_where('tbl_course', array('course_id' => $id))->row();
        } else {
            return null;
        }
    }

    function removeCourse() {
        $id = $this->uri->segment(3);

        $this->db->delete('tbl_appointments', array('course_id' => $id));

        $this->db->delete('tbl_lesson', array('course_id' => $id));
        $q = mysql_query("DELETE FROM tbl_course WHERE course_id = '$id'");

        return $q;
    }

    function listAllLessons() {
        $this->db->select('*');
        $this->db->from('tbl_lesson');
        $this->db->join('tbl_course', 'tbl_course.course_id=tbl_lesson.course_id');
        return $this->db->get()->result();
    }

    function addLesson() { {
            $name = $this->input->post('lesson_name');
            $desc = $this->input->post('lesson_desc');
            $courseId = $this->input->post('course_id');
            if (isset($_POST['active'])) {
                $active = 1;
            }
            else
                $active = 0;

            $data = array('lesson_name' => $name,
                'lesson_description' => $desc,
                'course_id' => $courseId,
                'status' => $active);
            return $this->db->insert('tbl_lesson', $data);
        }
    }

    function editLesson() {
        $id = $this->uri->segment(3);
        $name = $this->input->post('lesson_name');
        $desc = $this->input->post('lesson_desc');
        $courseId = $this->input->post('course_id');
        if (isset($_POST['active'])) {
            $active = 1;
        }
        else
            $active = 0;

        $data = array('lesson_name' => $name,
            'lesson_description' => $desc,
            'course_id' => $courseId,
            'status' => $active);
        $this->db->where('lesson_id', $id);
        return $this->db->update('tbl_lesson', $data);
    }

    function getAllLessonsByID() {
        $id = $this->uri->segment(3);

        $this->db->select('*');
        $this->db->from('tbl_lesson');
        $this->db->join('tbl_course', 'tbl_course.course_id=tbl_lesson.course_id');
        $this->db->where('tbl_lesson.lesson_id', $id);
        return $this->db->get()->row();
    }

    function remove() {
        $id = $this->uri->segment(3);
        $q = mysql_query("DELETE FROM tbl_lesson WHERE lesson_id = '$id'");
        return $q;
    }

    function getCourseName($id) {

        return $this->db->get_where('tbl_course', array('course_id' => $id))->row();
    }

    function listAllCourses($branchId) {

        $this->db->select('*');
        $this->db->from('tbl_course');
        $this->db->join('tbl_branch', 'tbl_branch.branch_id=tbl_course.branch_id');
        $this->db->where('tbl_course.branch_id', $branchId);
        return $this->db->get()->result();
    }

    function getLessonByCourses($courseId) {
        if ($courseId != 0) {
            $this->db->select('*');
            $this->db->from('tbl_lesson');
            $this->db->join('tbl_course', 'tbl_course.course_id=tbl_lesson.course_id');
            $this->db->where('tbl_lesson.course_id', $courseId);
            return $this->db->get()->result();
        } else {
            $this->db->select('*');
            $this->db->from('tbl_lesson');
            $this->db->join('tbl_course', 'tbl_course.course_id=tbl_lesson.course_id');
            return $this->db->get()->result();
        }
    }

    function getCourseNameById($courseId) {

        return $this->db->get_where('tbl_course', array('course_id' => $courseId))->row();
    }

    function getPageFooter() {

        return $this->db->get_where('tbl_page_footer', array('id' => 1))->row();
    }

    function updatePageFooter() {

        $footerTitle = $this->input->post('footer_title');
        $footerCopyright = $this->input->post('footer_copyright');
        $footerLink = $this->input->post('footer_link');

        $data = array('footer_title' => $footerTitle, 
                    'footer_copyright' => $footerCopyright, 
                    'footer_link' => $footerLink);
        
        $this->db->where('id', 1);
        $this->db->update('tbl_page_footer', $data);
    }

}

?>
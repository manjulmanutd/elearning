<?php

class SuperAdmin extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('superadmin/superlogin_model');
        $this->load->model('superadmin/super_site_conf_model');
    }

    function index() {

        if ($this->session->userdata('superadmin')) {
            redirect('superadmin/superadmin_dashboard');
        } else {
            $this->load->view('superadmin/login');
        }
    }

    function verifyLogin() {

        $result = $this->superlogin_model->verifyLoginModel();
        if ($result && $this->session->userdata('superadmin')) {
            redirect('superadmin/superadmin_dashboard');
        } else {
            $data['error'] = "Invalid Username or Password";
            $this->load->view('superadmin/login', $data);
        }
    }

    function superadmin_dashboard() {

        if ($this->session->userdata('superadmin')) {
            $data['superadmin_content'] = $this->superlogin_model->superadmin_content();

            $data['page'] = 'superadmin/pages/welcome';
            $this->load->view('superadmin/superadmin_dash', $data);
        }
        else
            redirect('superadmin');
    }

    function logout() {
        if ($this->session->userdata('superadmin')) {
            $this->session->unset_userdata('superadmin');
        }
        redirect('superadmin');
    }

    function site_configuration() {
        $data['page'] = 'superadmin/pages/site_conf/show_options';
        $this->load->view('superadmin/superadmin_dash', $data);
    }

    function login_setting() {
        $data['admin'] = $this->super_site_conf_model->login_setting();
        $data['page'] = 'superadmin/pages/site_conf/login_setting';
        $this->load->view('superadmin/superadmin_dash', $data);
    }

    function edit_login() {
        $edit = $this->super_site_conf_model->edit_login();
        $data['msg'] = 'Your Log In information have been updated.';
        $data['admin'] = $this->super_site_conf_model->login_setting();
        $data['page'] = 'superadmin/pages/site_conf/login_setting';
        $this->load->view('superadmin/superadmin_dash', $data);
    }

    function site_setting() {
        $data['site'] = $this->super_site_conf_model->site_setting();
        $data['page'] = 'superadmin/pages/site_conf/site_setting_view';
        $this->load->view('superadmin/superadmin_dash', $data);
    }

    function edit_site_setting() {
        $edit = $this->super_site_conf_model->edit_site_setting();
        $data['mes'] = 'The Site Configuration have been updated.';
        $data['site'] = $this->super_site_conf_model->site_setting();
        $data['page'] = 'superadmin/pages/site_conf/site_setting_view';
        $this->load->view('superadmin/superadmin_dash', $data);
    }

    function slider_control() {
        $data['allImages'] = $this->super_site_conf_model->getSliderImages();
        $data['page'] = 'superadmin/pages/slider_conf/view_slider_images';
        $this->load->view('superadmin/superadmin_dash', $data);
    }

    function add_slider_images() {
        $data['page'] = 'superadmin/pages/slider_conf/add_slider_images';
        $this->load->view('superadmin/superadmin_dash', $data);
    }

    function addSliderImage() {
        $this->super_site_conf_model->addSliderImage();
        redirect('superadmin/slider_control');
    }

    function removeImage() {
        $this->super_site_conf_model->removeImage();
        redirect('superadmin/slider_control');
    }

    function home_page() {
        $this->load->helper('ckeditor');
        $data['ckeditor'] = array(
            //ID of the textarea that will be replaced
            'id' => 'staticpage_content',
            'path' => 'js/ckeditor',
            //Optionnal values
            'config' => array(
                'toolbar' => "Full", //Using the Full toolbar
                'width' => "1000px", //Setting a custom width
                'height' => '300px', //Setting a custom height
            ),
            //Replacing styles from the "Styles tool"
            'styles' => array(
                //Creating a new style named "style 1"
                'style 1' => array(
                    'name' => 'Blue Title',
                    'element' => 'h2',
                    'styles' => array(
                        'color' => 'Blue',
                        'font-weight' => 'bold'
                    )
                ),
                //Creating a new style named "style 2"
                'style 2' => array(
                    'name' => 'Red Title',
                    'element' => 'h2',
                    'styles' => array(
                        'color' => 'Red',
                        'font-weight' => 'bold',
                        'text-decoration' => 'underline'
                    )
                )
            )
        );



        $data['homePage'] = $this->super_site_conf_model->getHomePage();
        $data['page'] = 'superadmin/pages/site_conf/home_page';
        $this->load->view('superadmin/superadmin_dash', $data);
    }

    function updateHomePage() {
        $this->super_site_conf_model->updateHomePage();
        redirect('superadmin/superadmin_dashboard');
    }

    function terms() {
        $this->load->helper('ckeditor');
        $data['ckeditor'] = array(
            //ID of the textarea that will be replaced
            'id' => 'terms',
            'path' => 'js/ckeditor',
            //Optionnal values
            'config' => array(
                'toolbar' => "Full", //Using the Full toolbar
                'width' => "1000px", //Setting a custom width
                'height' => '300px', //Setting a custom height
            ),
            //Replacing styles from the "Styles tool"
            'styles' => array(
                //Creating a new style named "style 1"
                'style 1' => array(
                    'name' => 'Blue Title',
                    'element' => 'h2',
                    'styles' => array(
                        'color' => 'Blue',
                        'font-weight' => 'bold'
                    )
                ),
                //Creating a new style named "style 2"
                'style 2' => array(
                    'name' => 'Red Title',
                    'element' => 'h2',
                    'styles' => array(
                        'color' => 'Red',
                        'font-weight' => 'bold',
                        'text-decoration' => 'underline'
                    )
                )
            )
        );
        $data['terms'] = $this->super_site_conf_model->getTerms();
        $data['page'] = 'superadmin/pages/site_conf/terms';
        $this->load->view('superadmin/superadmin_dash', $data);
    }

    function updateTerms() {
        $this->super_site_conf_model->updateTerms();
        redirect('superadmin/superadmin_dashboard');
    }

    function user_home() {
        $this->load->helper('ckeditor');
        $data['ckeditor'] = array(
            //ID of the textarea that will be replaced
            'id' => 'user_home',
            'path' => 'js/ckeditor',
            //Optionnal values
            'config' => array(
                'toolbar' => "Full", //Using the Full toolbar
                'width' => "1000px", //Setting a custom width
                'height' => '300px', //Setting a custom height
            ),
            //Replacing styles from the "Styles tool"
            'styles' => array(
                //Creating a new style named "style 1"
                'style 1' => array(
                    'name' => 'Blue Title',
                    'element' => 'h2',
                    'styles' => array(
                        'color' => 'Blue',
                        'font-weight' => 'bold'
                    )
                ),
                //Creating a new style named "style 2"
                'style 2' => array(
                    'name' => 'Red Title',
                    'element' => 'h2',
                    'styles' => array(
                        'color' => 'Red',
                        'font-weight' => 'bold',
                        'text-decoration' => 'underline'
                    )
                )
            )
        );
        $data['userHome'] = $this->super_site_conf_model->getUserHome();
        $data['page'] = 'superadmin/pages/site_conf/user_home';
        $this->load->view('superadmin/superadmin_dash', $data);
    }

    function updateUserHome() {
        $this->super_site_conf_model->updateUserHome();
        redirect('superadmin/superadmin_dashboard');
    }

    function number_sessions() {

        $data['sessionNumber'] = $this->super_site_conf_model->getSessionNumber();
        $data['page'] = 'superadmin/pages/site_conf/sessions_number_conf';
        $this->load->view('superadmin/superadmin_dash', $data);
    }

    function updateSessionNumber() {
        $this->super_site_conf_model->updateSessionNumber();
        redirect('superadmin/number_sessions');
    }
    
     function page_title() {

        $data['pageTitle'] = $this->super_site_conf_model->getPageTitle();
        $data['page'] = 'superadmin/pages/site_conf/page_title';
        $this->load->view('superadmin/superadmin_dash', $data);
    }

    function updatePageTitle() {
        $this->super_site_conf_model->updatePageTitle();
        redirect('superadmin/page_title');
    }

    function list_course_branches() {

        $data['allBranches'] = $this->super_site_conf_model->getAllBranches();
        $data['page'] = 'superadmin/pages/course/list_branch';
        $this->load->view('superadmin/superadmin_dash', $data);
    }

    function getCoursesByBranch($branchId) {
        $data['coursesByBranch'] = $this->super_site_conf_model->getCoursesByBranch($branchId);
        $this->load->view('superadmin/pages/course/list_course_by_branch', $data);
    }

    function add_course() {

        $data['allBranches'] = $this->super_site_conf_model->getAllBranches();
        $data['page'] = 'superadmin/pages/course/add_course';
        $this->load->view('superadmin/superadmin_dash', $data);
    }

    function addCourse() {
        $this->super_site_conf_model->addCourse();
        redirect('superadmin/list_course_branches');
    }

    function edit_course() {
        $data['allBranches'] = $this->super_site_conf_model->getAllBranches();
        $data['courseById'] = $this->super_site_conf_model->getAllCoursesByID();
        $data['page'] = 'superadmin/pages/course/edit_course';
        $this->load->view('superadmin/superadmin_dash', $data);
    }

    function editCourse() {
        $this->super_site_conf_model->editCourse();
        redirect('superadmin/list_course_branches');
    }

    function removeCourse() {
        $res = $this->super_site_conf_model->removeCourse();
        redirect('superadmin/list_course_branches');
    }

    function list_lessons() {
        $data['allBranches'] = $this->super_site_conf_model->getAllBranches();
        //$data['allCourses'] = $this->super_site_conf_model->listAllCourses();
        $data['page'] = 'superadmin/pages/lesson/list_lesson';
        $this->load->view('superadmin/superadmin_dash', $data);
    }

    function getCoursesListByBranch($branchId){
        $data['allCourses'] = $this->super_site_conf_model->getCoursesByBranch($branchId);
        $this->load->view('superadmin/pages/lesson/course_list_by_branch', $data);
    }
    
    function getLessonByCourse($courseId) {
        $data['lessonsByCourse'] = $this->super_site_conf_model->getLessonByCourses($courseId);
        $data['courseId'] = $courseId;
       $this->load->view('superadmin/pages/lesson/list_lesson_by_course', $data);
    }

    function add_lesson($courseId) {
        $data['courseId'] = $courseId;
        $data['page'] = 'superadmin/pages/lesson/add_lesson';
        $this->load->view('superadmin/superadmin_dash', $data);
    }

    function addLesson() {
        $this->super_site_conf_model->addLesson();
        redirect('superadmin/list_lessons');
    }

    function edit_lesson() {
        $data['courseId'] = $this->uri->segment('4');
        $data['lessonById'] = $this->super_site_conf_model->getAllLessonsByID();
        $data['page'] = 'superadmin/pages/lesson/edit_lesson';
        $this->load->view('superadmin/superadmin_dash', $data);
    }

    function editLesson() {
        $this->super_site_conf_model->editLesson();
        redirect('superadmin/list_lessons');
    }

    function remove() {
        $res = $this->super_site_conf_model->remove();
        redirect('superadmin/list_lessons');
    }
    
     function page_footer() {

        $data['pageFooter'] = $this->super_site_conf_model->getPageFooter();
        $data['page'] = 'superadmin/pages/site_conf/page_footer';
        $this->load->view('superadmin/superadmin_dash', $data);
    }

    function updatePageFooter() {
        $this->super_site_conf_model->updatePageFooter();
        redirect('superadmin/page_footer');
    }

}

?>
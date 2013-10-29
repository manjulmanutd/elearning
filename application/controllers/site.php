<?php
class Site extends CI_Controller
{
	function index()
	{
		if($this->session->userdata('user'))
		{
			$this->load->view('home');
		}
		else
		{
		  $this->load->model('login_model');
		  $data['home_content'] = $this->login_model->home_content();
                  $data['allImages'] = $this->login_model->getAllSliderImages();
			$this->load->view('login',$data);
		}
	}
	function verify()
	{
		$this->site_model->verify();
		if($this->session->userdata('user'))
		{
			redirect('home');
		}
		else
		if($this->session->userdata('admin'))
		{
			redirect('admin');
		}
		else
		{
			$data['error']='Invalid username or password';
			$this->load->view('login',$data);
		}
	}
	function logout()
	{
		if($this->session->userdata('user')){
                 $this->login_model->chat_status();
		$this->session->unset_userdata('user');
                }
		if($this->session->userdata('admin')){
                    $this->login_model->chat_status();
		$this->session->unset_userdata('admin');
                }
                if($this->session->userdata('trainer')){
                    $this->login_model->chat_status();
		$this->session->unset_userdata('trainer');
                }
		redirect('home');
	}
}
?>
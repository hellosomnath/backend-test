<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('backend_model');
	}

	public function index()
	{
		if (!$this->session->has_userdata('user_type')) {
			redirect(base_url('/login'));
		}
		$this->load->view('welcome_message');
	}

	public function login()
	{
		if ($this->session->has_userdata('user_type')) {
			redirect(base_url('/'));
		}
		if ($_POST) {
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');

			if ($this->form_validation->run() == TRUE) {
				$user = $this->backend_model->checkLogin($this->input->post('email'), $this->input->post('password'));
				if ($user) {
					# if user exist open the welcome page
					$userType = ($user->user_type == 1) ? 'admin' : 'customer';
					$this->session->set_userdata('user_type', $userType);
					$this->session->set_userdata('user_email', $user->email);
					redirect('/');
				} else {
					# if user does not exist return to login page
					$this->session->set_flashdata('error', 'Wrong credential!');
				}
				
			}
		}
		$this->load->view('login');
	}

	public function logout()
	{
		$this->session->unset_userdata('user_type');
		$this->session->unset_userdata('user_email');
		$this->session->sess_destroy();
		redirect(base_url('/login'));
	}

}

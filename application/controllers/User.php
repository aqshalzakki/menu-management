<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_model');
		// load model
		$this->load->model('User_model', 'user');
		
		// load form validation
		$this->load->library('form_validation');
		
		// if user already logged in
		is_logged_in();
	}
	public function index()
	{ 
		// get user information
		$data['user'] = $this->Auth_model->getUserByEmail( $this->session->userdata('email') );

		$data['title'] = 'My Profile';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/home', $data);
		$this->load->view('templates/footer');
	}

	public function edit()
	{
		// get user information
		$data['user'] = $this->Auth_model->getUserByEmail( $this->session->userdata('email') );
		$data['title'] = 'Edit Profile';

		// set rules
		$this->form_validation->set_rules('username', 'Full name', 'required|trim|min_length[4]|max_length[14]', [
			'min_length' => 'Username is too short!'
		]);
		if ($this->form_validation->run() == false){
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('user/edit-profile', $data);
			$this->load->view('templates/footer');
		}else{ 
			$data = [
				'email' => $this->input->post('email'),
				'username' => $this->input->post('username'),
				'image' => $_FILES['image']['name']
			];
			
			// send it to model
			$this->user->editUser($data);
		}

	}

	public function changepassword()
	{
		// get user information
		$data['user'] = $this->Auth_model->getUserByEmail($this->session->userdata('email'));
		$data['title'] = 'Change Password';

		// set rules
		$this->form_validation->set_rules('current_password', 'Current password', 'required|trim');
		$this->form_validation->set_rules('new_password', 'New password', 'required|trim|min_length[7]', [
			'min_length' => 'Password is too short!'
		]);

		$this->form_validation->set_rules('confirm_password', 'Confirm password', 'required|trim|matches[new_password]', [
			'matches' => "Password didn't match!"
		]);

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('user/change-password', $data);
			$this->load->view('templates/footer');
		} else {
			// do something
			$this->user->changePassword($this->input->post());
		}
	}
}

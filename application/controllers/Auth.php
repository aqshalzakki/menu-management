<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->model('Auth_model');
	}
	public function index()
	{
		// if user is already login
		if ($this->session->userdata('email')){
			redirect('user');	
		}

		$data['title'] = 'Login page';

		$this->form_validation->set_rules('email','Email', 'required|valid_email|trim');
		$this->form_validation->set_rules('password','Password', 'required|trim');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('templates/header_auth', $data);
			$this->load->view('auth/login', $data);
			$this->load->view('templates/footer_auth');
		}else{
			// run login user function
			$this->Auth_model->login_user();
		}
	}

	public function registration()
	{
		// if user is already login
		if ($this->session->userdata('email')) {
			redirect('user');
		}

		$data['title'] = 'Registration page';

		// set rules
		$this->form_validation->set_rules('username','Username','required|trim');
		$this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique[user.email]', [
			// custom message
			'is_unique' => 'Email is already exists!'
		]);
		$this->form_validation->set_rules('password','Password','required|trim|min_length[3]|matches[password2]', [
			// custom message
			'matches' => 'Password didn\'t match!',
			'min_length' => 'Password is too short!' 
		]);
		$this->form_validation->set_rules('password2','confirmation password','matches[password]');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('templates/header_auth', $data);
			$this->load->view('auth/registration', $data);
			$this->load->view('templates/footer_auth');
		}else{
			// whenever success, send data to model
			$data = [
				'username' => $this->input->post('username', TRUE),
				'email' => $this->input->post('email', TRUE),
				'image' => 'default.jpg',
				'password' => password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT),
				'role_id' => 2,
				'is_active' => 0,
				'date_created' => time()
			];
			$this->Auth_model->registration_user($data);
		}
	}

	public function verify()
	{
		$this->Auth_model->run_verify();
	}

	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');

		message('You have been logged out!', 'success', 'auth');
	}

	public function blocked()
	{
		$data['title'] = 'Access Forbidden!';
		$this->load->view('auth/blocked', $data);
	}

	public function forgotPassword()
	{
		$data['title'] = 'Forgot password';

		$this->form_validation->set_rules('email', 'Email', 'required|trim');
		if ($this->form_validation->run() == FALSE){
			$this->load->view('templates/header_auth', $data);
			$this->load->view('auth/forgot-password', $data);
			$this->load->view('templates/footer_auth');
		}else{
			$this->Auth_model->run_forgot_password();
		}
	}
	
	public function resetPassword()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user_token = $this->db->get_where('user_token', ['email' => $email, 'token' => $token])->row_array();

		// jika ada usernya
		if ($user_token){
			$this->session->set_userdata('email_reset_password', $email);
			$this->changePassword();
		}else{
			message('Failed to reset Password! Email or token is invalid.', 'danger', 'auth/forgotPassword');
		}
	}

	public function changePassword()
	{
		// jika ada seseorang yang memaksa masuk
		if (!$this->session->userdata('email_reset_password')){
			redirect('auth');
		}

		$data['title'] = 'Reset password';

		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
			'min_length' => 'Password is too short!',
			'matches' => ''
		]);

		$this->form_validation->set_rules('password2', 'Repeat password', 'matches[password1]', [
			'matches' => 'Password didn\'t match!'
		]);
		
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header_auth', $data);
			$this->load->view('auth/reset-password', $data);
			$this->load->view('templates/footer_auth');
		} else {
			$this->Auth_model->reset_password();
		}
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Auth_model');
		$this->load->model('Admin_model', 'admin');
		$this->load->model('Menu_model', 'menu');
		
		// check if user has been logged in
		is_logged_in();
	}
	public function index()
	{
		// get user information
		$data['user'] = $this->Auth_model->getUserByEmail( $this->session->userdata('email') );
		$data['title'] = 'Dashboard';
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/home', $data);
		$this->load->view('templates/footer');
	}

	public function role()
	{
		// get user information
		$data['user'] = $this->Auth_model->getUserByEmail( $this->session->userdata('email') );
		$data['title'] = 'Role';
		$data['role'] = $this->admin->getRole(); 

		// set rules
		$this->form_validation->set_rules('role','Role','required|trim');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/role', $data);
			$this->load->view('templates/footer');
		}else{
			$this->admin->addRole($this->input->post());
		}
	}
	public function roleAccess($role_id)
	{
		// get user information
		$data['user'] = $this->Auth_model->getUserByEmail( $this->session->userdata('email') );
		$data['title'] = 'Role Access';
		$data['role'] = $this->admin->getRoleById($role_id); 
		$data['menu'] = $this->menu->getMenu();

		// if it is admin
		if ($role_id == 1) $data['menu'] = $this->menu->getMenuExceptAdmin();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/role-access', $data);
		$this->load->view('templates/footer');
	}

	public function getRoleEdit()
	{
		echo json_encode($this->admin->getRoleById($this->input->post('id')));
	}

	public function delete($id = null)
	{
		if (is_null($id)) redirect('admin/role');

		$this->admin->deleteRole($id);
	}

	public function edit()
	{
		// get user information
		$data['user'] = $this->Auth_model->getUserByEmail( $this->session->userdata('email') );
		$data['title'] = 'Role';
		$data['role'] = $this->admin->getRole(); 

		// set rules
		$this->form_validation->set_rules('role','Role','required|trim');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/role', $data);
			$this->load->view('templates/footer');
		}else{
			$this->admin->editRole($this->input->post());
		}
	}

	public function changeaccess()
	{
		$data = [
			'role_id' => $this->input->post('role_id'),
			'menu_id' => $this->input->post('menu_id')
		];
		$result = $this->admin->getUserAccessById($data['role_id'], $data['menu_id']);

		// jika datanya tidak ada berarti user menyentang checkbox
		if ($result < 1)
		{
			// maka tambahkan akses baru
			$this->admin->addUserAccess($data);
		}
		// jika ada
		else
		{
			// maka hapus akses
			$this->admin->deleteUserAccess($data);
		}
	}
}
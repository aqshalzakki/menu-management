<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_model', 'Auth');
		$this->load->model('Menu_model');
		
		$this->load->library('form_validation');
		is_logged_in();
	}
	
	public function index()
	{
		// get user information
		$data['user'] = $this->Auth->getUserByEmail( $this->session->userdata('email') );
		
		$data['menu'] = $this->Menu_model->getMenu();
		$data['title'] = 'Menu Management';
		
		$this->form_validation->set_rules('menu', 'Menu', 'required|trim|alpha_numeric_spaces', [
			'alpha_numeric_spaces' => 'Menu name must contains alpha numeric only!'
			]);
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar', $data);
				$this->load->view('templates/topbar', $data);
				$this->load->view('menu/index', $data);
				$this->load->view('templates/footer');
			}else{
				$this->Menu_model->addMenu($this->input->post('menu'));
			}
			
		}

		// edit menu
		public function editMenu()
		{
			// get user information
			$data['user'] = $this->Auth->getUserByEmail($this->session->userdata('email'));
	
			$data['menu'] = $this->Menu_model->getMenu();
			$data['title'] = 'Menu Management';
	
			$this->form_validation->set_rules('menu', 'Menu', 'required|trim|alpha_numeric_spaces', [
				'alpha_numeric_spaces' => 'Menu name must contains alpha numeric only!'
			]);
			if ($this->form_validation->run() == FALSE) {
				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar', $data);
				$this->load->view('templates/topbar', $data);
				$this->load->view('menu/index', $data);
				$this->load->view('templates/footer');
			}else{
				$this->Menu_model->editMenu($this->input->post());
			}
		}
		
		public function subMenu()
		{
			// get user information
			$data['user'] = $this->Auth->getUserByEmail( $this->session->userdata('email') );
			
			// get menu
			$data['menu'] = $this->Menu_model->getMenu();
			
			// get submenu
			$data['subMenu'] = $this->Menu_model->getSubMenu();
			
			// form validation
			$this->form_validation->set_rules('title', 'Title', 'required|trim|alpha_numeric_spaces', [
				'alpha_numeric_spaces' => 'Menu name must contains alpha numeric only!'
			]);
			$this->form_validation->set_rules('menu_id', 'Menu', 'required|trim');
			$this->form_validation->set_rules('url', 'Url', 'required|trim');
			$this->form_validation->set_rules('icon', 'Icon', 'required|trim');

			if ($this->form_validation->run() == FALSE){
				$data['title'] = 'Submenu Management';
				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar', $data);
				$this->load->view('templates/topbar', $data);
				$this->load->view('menu/subMenu', $data);
				$this->load->view('templates/footer');
			}else{
				$data = [
					'title' => $this->input->post('title'),
					'menu_id' => $this->input->post('menu_id'),
					'url' => $this->input->post('url'),
					'icon' => $this->input->post('icon'),
					'is_active' => $this->input->post('is_active')
				];

				// send submenu data to model
				$this->Menu_model->addSubMenu($data);
			}
		}

	public function editSubmenu()
	{
		// get user information
		$data['user'] = $this->Auth->getUserByEmail($this->session->userdata('email'));

		// get menu
		$data['menu'] = $this->Menu_model->getMenu();

		// get submenu
		$data['subMenu'] = $this->Menu_model->getSubMenu();

		// form validation
		$this->form_validation->set_rules('title', 'Title', 'required|trim|alpha_numeric_spaces', [
			'alpha_numeric_spaces' => 'Submenu name must contains alpha numeric only!'
		]);
		$this->form_validation->set_rules('menu_id', 'Menu', 'required|trim');
		$this->form_validation->set_rules('url', 'Url', 'required|trim|alpha_numeric');
		$this->form_validation->set_rules('icon', 'Icon', 'required|trim');

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Submenu Management';
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('menu/subMenu', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'id' => $this->input->post('id'),
				'title' => $this->input->post('title'),
				'menu_id' => $this->input->post('menu_id'),
				'url' => $this->input->post('url'),
				'icon' => $this->input->post('icon'),
				'is_active' => $this->input->post('is_active')
			];

			// send submenu data to model
			$this->Menu_model->editSubmenu($data);
		}
	}

	// this function can delete from various table
	public function delete($type = null, $id = null)
	{
		if (is_null($id) || is_null($type))
		{
			redirect('menu');
		}
		switch ($type) :
			case 'menu':
				$this->Menu_model->deleteMenu($id);
				break;

			case 'submenu':
				$this->Menu_model->deleteSubmenu($id);				
				break;
		endswitch;
	}

	public function getMenuEdit()
	{
		$id = $this->input->post('id');
		echo json_encode($this->Menu_model->getMenuById($id));
	}

	public function getSubmenuEdit()
	{
		$id = $this->input->post('id');
		echo json_encode($this->Menu_model->getSubmenuById($id));
	}
}
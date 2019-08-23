<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model{

	// MENU SECTION

	// get all menu
	public function getMenu()
	{
		return $this->db->get('user_menu')->result_array();
	}

	// get all menu except admin column
	public function getMenuExceptAdmin()
	{
		$this->db->where('id !=',1);
		return $this->db->get('user_menu')->result_array();
	}
	
	// get menu by id
	public function getMenuById($id)
	{
		return $this->db->get_where('user_menu', ['id', $id])->row_array();
	}

	// add new menu
	public function addMenu($menu)
	{
		$this->db->insert('user_menu', ['menu' => $menu]);
		message('New menu added!','success','menu');
	}

	// delete menu by id
	public function deleteMenu($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('user_menu');
		message('Menu has been deleted!', 'success', 'menu');
	}

	// edit menu
	public function editMenu($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->update('user_menu', $data);

		message('Menu has been edited!', 'success', 'menu');
	}

	// SUBMENU SECTION 

	// get submenu
	public function getSubMenu()
	{
		$query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
				  FROM `user_sub_menu` JOIN `user_menu`
				  ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
		";

		return $this->db->query($query)->result_array();
	}

	// get submenu by id
	public function getSubMenuById($id)
	{
		return $this->db->get_where('user_sub_menu', ['id' => $id])->row_array();
	}

	// add submenu
	public function addSubMenu($data)
	{
		$this->db->insert('user_sub_menu', $data);
		message('New Submenu has been added!', 'success', 'menu/subMenu');
	}

	// delete submenu
	public function deleteSubmenu($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('user_sub_menu');

		message('Submenu has been deleted!', 'success', 'menu/subMenu');
	}

	// edit submenu
	public function editSubmenu($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->update('user_sub_menu', $data);

		message('Submenu has been edited!', 'success', 'menu/subMenu');
	}
}	
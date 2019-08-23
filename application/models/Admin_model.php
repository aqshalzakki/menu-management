<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model{

	// ROLE SECTION
	public function getRole()
	{
		return $this->db->get('user_role')->result_array();
	}

	public function getRoleById($id)
	{
		return $this->db->get_where('user_role', ['id' => $id])->row_array();
	}

	public function addRole($data)
	{
		$this->db->insert('user_role', $data);
		message('New role has been added!', 'success', 'admin/role');
	}

	public function deleteRole($id)
	{
		$this->db->delete('user_role',['id' => $id]);
		message('Role has been deleted!', 'success', 'admin/role');
	}

	public function editRole($data)
	{
		$this->db->update('user_role', $data, ['id' => $data['id']]);
		message('Role has been updated!', 'success', 'admin/role');
	}

	// USER ACCESS SECTION
	public function getUserAccess()
	{
		return $this->db->get('user_access_menu')->result_array();
	}

	public function getUserAccessById($role_id, $menu_id, $true = null)
	{
		if ($true == 1)
		{
			return $this->db->get_where('user_access_menu', ['role_id' => $role_id, 'menu_id' => $menu_id])->row_array();
		}
		
		return $this->db->get_where('user_access_menu', ['role_id' => $role_id, 'menu_id' => $menu_id])->num_rows();
	}

	public function addUserAccess($data)
	{
		$this->db->insert('user_access_menu', $data);
		message('Access granted!', 'success');
	}
	public function deleteUserAccess($data)
	{
		$this->db->delete('user_access_menu', $data);
		message('Access removed!', 'warning');
	}
}
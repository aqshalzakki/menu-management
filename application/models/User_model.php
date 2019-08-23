<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model{
    private $user;
    public function __construct()
    {
        parent::__construct();

        $this->user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    }

    // UNFINISHED CODE... SOMEONE PLEASE HELP ME :(
    public function editUser($data)
    {
        // if user upload file
        if ($data['image']){
            // configuration
            $config['allowed_types']        = 'gif|jpg|png';
            $config['upload_path']          = './assets/img/profile/';
            $config['max_size']             = 100000;

            $this->load->library('upload');
            $this->upload->initialize($config);
           
            if ($this->upload->do_upload('image')){
                
                $old_image = $this->user['image'];
                // hapus gambar sebelumnya kecuali gambar default
               if ($old_image != 'default.jpg'){
                    // var_dump( FCPATH . 'assets/img/profile/' . $old_image);die;
                    unlink(FCPATH . 'assets/img/profile/' . $old_image);
               }

                $this->db->set('image', $data['image']);
            }else{
                message($this->upload->display_errors(), 'danger', 'user/edit');
            }
        }

        $this->db->set('username', $data['username']);
        $this->db->where('email', $data['email']);
        $this->db->update('user');

        message('Your profile has been updated!', 'success', 'user');
    }
    // ---------------
    
    public function changePassword($data)
    {
        $current_password = $data['current_password'];
        $new_password = $data['new_password'];

        // cek password
        if (password_verify($current_password, $this->user['password'])){
            // cek jika password sebelumnya sama dengan password sekarang
            if ($current_password == $new_password){
                message('Current password cannot be the same as new password!', 'danger', 'user/changepassword');
            }else{
                // hash password lalu update ke database
                $new_password = password_hash($new_password, PASSWORD_DEFAULT);
                
                $this->db->set('password', $new_password);
                $this->db->where('email', $this->user['email']);
                $this->db->update('user');
                message('Password has been updated!', 'success', 'user/changepassword');
            }

        }else{
            message('Invalid current password!', 'danger', 'user/changepassword');
        }
    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model{

	public function registration_user($data = [])
	{
		$this->db->insert('user', $data);
		
		// send email
		$this->_sendEmail('verify', 'Email verification');
		message('Congratulations! your account has been created. Please activate your account before 24 hours!', 'success', 'auth');
	}

	private function _sendEmail($type, $subject)
	{
		// prepare the token
		$token = base64_encode(random_bytes(32));
		$email = $this->input->post('email');
		$user_token = [
			'token' => $token,
			'email' => $email,
			'date_created' => time()
		];
		$this->db->insert('user_token', $user_token);
		// -------------

		$config = [
			'protocol'  => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'ci.app22222@gmail.com',
			'smtp_pass' =>  SMTP_PASS,
			'smtp_port' =>  465,
			'mailtype'  => 'html',
			'charset'   => 'utf-8',
			'newline'   => "\r\n"
		];
		$this->email->initialize($config);

		$this->email->from('ci.app22222@gmail.com', 'Codeigniter app');
		$this->email->to($email);
		
		$this->email->subject($subject);
		$this->email->message($this->_templateEmail($user_token, $type));

		if ($this->email->send()) {
			return true;
		} else {
			echo $this->email->print_debugger();
			die;
		}
	}

	// untuk verifikasi
	public function run_verify()
	{
		$token = $this->input->get('token');
		$email = $this->input->get('email');

		$user_token = $this->db->get_where('user_token', ['email' => $email])->row_array();

		// cek apakah email yg dikirim ada di database
		if ($user_token) {

			// cek user token 
			if ($user_token['token'] == $token){
				
				// jika belum di verifikasi melebihi batas waktu 24 jam 
				if (time() - $user_token['date_created'] > (60*60*24)){
					
					// hapus user dan user token 
					$this->db->delete('user', ['email' => $email]);
					$this->db->delete('user_token', ['email' => $email]);
					
					message('Account activation failed! token is expired!', 'danger', 'auth');

					// jika masih sempat verifikasi / berhasil
				}else{

					$this->db->set('is_active', 1);
					$this->db->where('email', $email);
					$this->db->update('user');
					
					$this->db->delete('user_token', ['email' => $email]);
					
					message( $email . ' has been activated! please login.', 'success', 'auth');
				}
			}else{
				message('Account activation failed! token is invalid!', 'danger', 'auth');
			}
		} else {
			message('Account activation failed! email is invalid!', 'danger', 'auth');
		}
	}

	public function run_forgot_password()
	{
		$email = $this->input->post('email');
		$user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();

		// cek apakah email ada di tabel user 
		if ($user)
		{
			// jalankan fungsi send email
			$this->_sendEmail('reset_password', 'Reset password');
			message('The password reset link has been sent to your email!', 'success', 'auth/forgotPassword');

		}else{
			message('Email is not registered or activated!', 'danger', 'auth/forgotPassword');
		}
	}

	// untuk template email 
	private function _templateEmail($user_token, $type)
	{
		if ($type == 'verify'){
			return '
				<!DOCTYPE html>
				<html lang="en">
				<head>
					<meta charset="UTF-8">
					<meta name="viewport" content="width=device-width, initial-scale=1.0">
					<meta http-equiv="X-UA-Compatible" content="ie=edge">
					<title></title>
				</head>
				<body>
					Click this link to activate your account : <a href="' . base_url() . 'auth/verify?email=' . $user_token['email'] . '&token=' . urlencode($user_token['token']) . '">Activate</a>
				</body>
				</html>
			';
		}elseif ($type == 'reset_password'){
			return '
				<!DOCTYPE html>
				<html lang="en">
				<head>
					<meta charset="UTF-8">
					<meta name="viewport" content="width=device-width, initial-scale=1.0">
					<meta http-equiv="X-UA-Compatible" content="ie=edge">
					<title></title>
				</head>
				<body>
					Click this link to reset your password : <a href="' . base_url() . 'auth/resetPassword?email=' . $user_token['email'] . '&token=' . urlencode($user_token['token']) . '">Reset password</a>
				</body>
				</html>
			';
		}
	}

	public function login_user()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->getUserByEmail($email);

		// if email has found in the user table
		if ($user){

			// check if user's email is active
			if ($user['is_active'] == 1){
				
				// check password
				if (password_verify($password, $user['password'])){
					
					// set session
					$data = [
						'email' => $user['email'],
						'role_id' => $user['role_id']
					];
					$this->session->set_userdata($data);
					// if role id = 1 (admin)
					if ($user['role_id'] == 1){
						message('Login successful!', 'success', 'admin');	
					}else{
						message('Login successful!', 'success', 'user');
					}
					
				}else{
					message('Wrong email/password', 'danger', 'auth');
				}
			}else{
				message('The email has not been activated!','danger', 'auth');
			}
		}else{
			message('Email is not registered! ', 'danger', 'auth');
		}
	}

	public function reset_password()
	{
		$email = $this->session->userdata('email_reset_password');
		$password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);

		$this->db->set('password', $password);
		$this->db->where('email', $email);
		$this->db->update('user');

		// hapus tokennya
		$this->db->delete('user_token', ['email' => $email]);

		$this->session->unset_userdata('email_reset_password');
		message('Password was reset successfully!', 'success', 'auth');
	}

	public function getUserByEmail($email)
	{
		return $this->db->get_where('user', ['email' => $email])->row_array();
	}
}
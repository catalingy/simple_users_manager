<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class send_mail extends CI_Model{
		public function send_email($user,$mail)
		{
			$query = $this->db->query('Select username,email from all_users where username="'.$user.'" and email="'.$mail.'"');
			if ($query->num_rows() == 1){
				$this->load->helper('security');
				$this->load->library('email');
				$this->email->set_newLine("\r\n");
				$this->email->from('User management website');
				$this->email->to($mail);
				$this->email->subject("Password recover!");
				$this->load->model("random_password");
				$password = $this->random_password->get_password();
				$passhash = do_hash($password, 'md5');
				$query = $this->db->query('UPDATE all_users SET password ="'.$passhash.'" WHERE username ="'.$user.'";');
				$this->email->message("As you requested, we sent you the new password for the user: <b>".$user." </b> ".". It is <b>".$password.'</b>');
				if ($this->email->send()){
					return "1"; // new password sent
				}else {
					return "2";// something went wrong
				}
			}
			else
			{
				return "3";//Username and email not registered
			}
		}
	}
?>
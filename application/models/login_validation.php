<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class login_validation extends CI_Model{
		public function login_val($user,$pass)
		{
			$this->load->helper('security');
			$passhash = do_hash($pass, 'md5');
			$query = $this->db->query('Select type from all_users where username="'.$user.'" and password="'.$passhash.'"');
			if ($query->num_rows() == 1)
			{
				$row = $query->row_array(); 
				return $row['type'];
			}
			else
			{
				return "0";
			}
		}
	}
?>
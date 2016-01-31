<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class edit_users extends CI_Model{
		
		//Add new user
		
		public function add($user,$type,$pass,$name,$email,$phone,$descr)
		{
			
			$query = $this->db->query('Select username from all_users where username="'.$user.'"');
			if ($query->num_rows() == 1){
				return "1"; //user already exists
			}
			else
			{
				if (preg_match("/[A-Z]+/", $pass) && preg_match("/[`'\"~!@# $*()<>,:;{}\|1234567890]/", $pass) )
				{
					$this->load->helper('security');
					$passhash = do_hash($pass, 'md5');
					$query = $this->db->query('INSERT INTO all_users(username,type,password,name,email,phone_number,description) VALUES("'.$user.'","'.$type.'","'.$passhash.'","'.$name.'","'.$email.'","'.$phone.'","'.$descr.'")');
					return "2"; //user added succesfully
				}
				else
				{
					return "7";
				}
				
			}
			
		}
		
		//Edit user's information
		
		public function edit($user,$type,$pass,$name,$email,$phone,$descr)
		{
			$this->load->helper('security');
			if($pass=="")
			{
				$query = $this->db->query('UPDATE all_users SET type="'.$type.'", name="'.$name.'", email="'.$email.'", phone_number="'.$phone.'", description="'.$descr.'" WHERE username="'.$user.'"');

			}
			else
			{
				if (preg_match("/[A-Z]+/", $pass) && preg_match("/[`'\"~!@# $*()<>,:;{}\|1234567890]/", $pass) )
				{
					$this->load->helper('security');
					$passhash = do_hash($pass, 'md5');
					$query = $this->db->query('UPDATE all_users SET type="'.$type.'", password="'.$passhash.'", name="'.$name.'", email="'.$email.'", phone_number="'.$phone.'", description="'.$descr.'" WHERE username="'.$user.'"');
				}
				else
				{
					return "8";
				}
				
			}
			
			if ($this->db->affected_rows() == 1){
				return "3"; //The user's information was updated
			}
			else
			{
				return "4"; //Could not update user's information
			}
			
		}
		public function delete_usr($user)
		{
			
			$query = $this->db->query('DELETE FROM all_users WHERE username="'.$user.'"');
		
			if ($this->db->affected_rows() == 1){
				return "5"; //The user's information was updated
			}
			else
			{
				return "6"; //Could not delete the user
			}
			
		}
	}
?>
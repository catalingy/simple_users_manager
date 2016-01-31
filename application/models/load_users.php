<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class load_users extends CI_Model{
		public function users_list($type,$user,$filter,$order,$usr_type)
		{
			if($type == 'a')
			{
				if($filter ==''){
						if($usr_type != "all")
						{
							$query = $this->db->query('Select * from all_users where type="'.$usr_type.'" ORDER BY username '.$order);
						}
						else
						{
							$query = $this->db->query('Select * from all_users ORDER BY username '.$order);
						}
				}
				else
				{	
					if($usr_type != "all")
					{
						$query = $this->db->query('Select * from all_users where username like "'.$filter.'%" and type="'.$usr_type.'" ORDER BY username '.$order);
					}
					else
					{
						$query = $this->db->query('Select * from all_users where username like "'.$filter.'%" ORDER BY username '.$order);
					}
				}
			}
			if($type == 'u')
			{
				$query = $this->db->query('Select * from all_users where username="'.$user.'"');
				
			}
			foreach($query->result() as $row)
			{    
			 $users[] = $row->username; 
			 $names[] = $row->name; 
			 $email[] = $row->email; 
			 $types[] = $row->type; 
			 $phone[] = $row->phone_number; 
			 $description[] = $row->description;
			}
			
			if(isset($users)){
				$rows['username'] = $users;
				$rows['email'] = $email;
				$rows['phone'] = $phone;
				$rows['type'] =  $types;
				$rows['name'] =  $names;
				$rows['description'] = $description;
				return $rows;	
			}
		}
	}
?>
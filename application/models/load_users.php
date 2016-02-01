<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class load_users extends CI_Model{
		public function users_list($type,$user,$filter,$order,$usr_type,$age_option)
		{
			if($type == 'a')
			{
				if($filter ==''){
						if($usr_type != "all")
						{
							if($age_option == "all")
							{
								$query = $this->db->query('Select all_users.username,all_users.type,all_users.password,all_users.name,all_users.email,all_users.phone_number,all_users.description,age.category from all_users INNER JOIN age ON all_users.age_id=age.ID where type="'.$usr_type.'" ORDER BY username '.$order);
							}
							else
							{	
								$query = $this->db->query('Select all_users.username,all_users.type,all_users.password,all_users.name,all_users.email,all_users.phone_number,all_users.description,age.category from all_users INNER JOIN age ON all_users.age_id=age.ID where type="'.$usr_type.'" and category="'.$age_option.'" ORDER BY username '.$order);
							}
						}
						else
						{
							if($age_option == "all")
							{
								$query = $this->db->query('Select all_users.username,all_users.type,all_users.password,all_users.name,all_users.email,all_users.phone_number,all_users.description,age.category from all_users INNER JOIN age ON all_users.age_id=age.ID ORDER BY username '.$order);
							}
							else
							{
								$query = $this->db->query('Select all_users.username,all_users.type,all_users.password,all_users.name,all_users.email,all_users.phone_number,all_users.description,age.category from all_users INNER JOIN age ON all_users.age_id=age.ID where category="'.$age_option.'" ORDER BY username '.$order);

							}
						}
				}
				else
				{	
					if($usr_type != "all")
					{
						if($age_option == "all")
						{
							$query = $this->db->query('Select all_users.username,all_users.type,all_users.password,all_users.name,all_users.email,all_users.phone_number,all_users.description,age.category from all_users INNER JOIN age ON all_users.age_id=age.ID where username like "'.$filter.'%" and type="'.$usr_type.'" ORDER BY username '.$order);
						}
						else
						{
							$query = $this->db->query('Select all_users.username,all_users.type,all_users.password,all_users.name,all_users.email,all_users.phone_number,all_users.description,age.category from all_users INNER JOIN age ON all_users.age_id=age.ID where username like "'.$filter.'%" and type="'.$usr_type.'" and category="'.$age_option.'" ORDER BY username '.$order);
						}
					}
					else
					{
						if($age_option == "all")
						{
							$query = $this->db->query('Select all_users.username,all_users.type,all_users.password,all_users.name,all_users.email,all_users.phone_number,all_users.description,age.category from all_users INNER JOIN age ON all_users.age_id=age.ID where username like "'.$filter.'%" ORDER BY username '.$order);
						}
						else
						{
							$query = $this->db->query('Select all_users.username,all_users.type,all_users.password,all_users.name,all_users.email,all_users.phone_number,all_users.description,age.category from all_users INNER JOIN age ON all_users.age_id=age.ID where category="'.$age_option.'" and username like "'.$filter.'%" ORDER BY username '.$order);
						}
					}
				}
			}
			if($type == 'u')
			{
				$query = $this->db->query('Select all_users.username,all_users.type,all_users.password,all_users.name,all_users.email,all_users.phone_number,all_users.description,age.category from all_users INNER JOIN age ON all_users.age_id=age.ID where username="'.$user.'"');
				
			}
			foreach($query->result() as $row)
			{    
			 $users[] = $row->username; 
			 $names[] = $row->name; 
			 $email[] = $row->email; 
			 $types[] = $row->type; 
			 $phone[] = $row->phone_number; 
			 $description[] = $row->description;
			 $ages[] = $row->category;
			}
			
			if(isset($users)){
				$rows['username'] = $users;
				$rows['email'] = $email;
				$rows['phone'] = $phone;
				$rows['type'] =  $types;
				$rows['name'] =  $names;
				$rows['description'] = $description;
				$rows['ages'] = $ages;
				return $rows;	
			}
		}
	}
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class age_cat extends CI_Model{
		function load()
		{
			$query = $this->db->query('Select * from age');
			foreach($query->result() as $row)
			{    
				$age[] = $row->category;
			}
			return $age;
		}
		function add_new_age_cat($age_cat)
		{
			$query = $this->db->query('Select * from age where category="'.$age_cat.'"');
			if($query->num_rows() == 0){
				$query = $this->db->query('INSERT INTO age(category) VALUES("'.$age_cat.'")');
			}

		}
		function delete_age_cat($age_cat)
		{
			$query = $this->db->query('DELETE FROM age WHERE category="'.$age_cat.'"');
		}
	}
?>
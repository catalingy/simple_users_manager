<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
	class random_password extends CI_Model{
		function get_password()
		{
			$use_upper_case = true;
			$length = rand(5,9);
			$selection = strtoupper('aeuoyibcdfghjklmnpqrstvwxz');
			$selection1 = '1234567890!@\"#$%&[]{}?|';
			$password = "";
			for($i=0; $i<$length; $i++) {
				$current_letter = $use_upper_case ? (rand(0,1) ? strtoupper($selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))];            
				$password .=  $current_letter;
			}
			$current_letter = $use_upper_case ? (rand(0,1) ? strtoupper($selection1[(rand() % strlen($selection1))]) : $selection1[(rand() % strlen($selection1))]) : $selection1[(rand() % strlen($selection1))];			
			$password .=  $current_letter;
			return $password;
		}
	}
?>
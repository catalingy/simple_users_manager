<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	/* This is the Login page Controller */
	public function index()
	{
		if(!$this->session->userdata('logged_in'))
		{
			redirect('Login', 'refresh');
		}
		else
		{
			$data['title']="Home Page"; /* Pages's title*/
			$data['usr_type'] = $this->session->userdata('type');			
			$this->load->model("load_users");
			$rows = $this->load_users->users_list($this->session->userdata('type'),$this->session->userdata('username'),'','ASC','all','all');
			$data['usernames'] = $rows['username'];
			$data['email'] = $rows['email'];
			$data['phone'] = $rows['phone'];
			$data['type'] = $rows['type'];
			$data['name'] = $rows['name'];
			$data['description'] = $rows['description'];
			$data['ages'] = $rows['ages'];
			$this->load->view('Home',$data); /* Load Home View */
		}
	}
	
	// function for filtering the users list
	
	public function filter_user()
	{	
		$this->load->model("load_users");
		$rows = $this->load_users->users_list($this->session->userdata('type'),$this->session->userdata('user'),$_POST['filter'],$_POST['order'],$_POST['usr_type'],$_POST['age_option']);
		$usernames = $rows['username'];
		$email = $rows['email'];
		$phone = $rows['phone'];
		$type = $rows['type'];
		$name = $rows['name'];
		$description = $rows['description'];
		$ages = $rows['ages'];
		if(isset($usernames))
		{
			foreach($usernames as $user)
			{
				echo  '<a 	class="list-group-item" 
							data-toggle="popover" 
							title="User\'s information" 
							data-html = "true"
							data-content="<p name=\'name_'.$user.'\'> Name: '.array_shift($name).' </p><p name=\'email_'.$user.'\'> Email :'.array_shift($email).' </p><p name=\'phone_'.$user.'\'> Phone no: '.array_shift($phone).'</p><p name=\'desc_'.$user.'\'> Description: '.array_shift($description).'</p><p name=\'age_'.$user.'\'> Age: '.array_shift($ages).'</p>';
							if(array_shift($type) == 'a') echo '<p name=\'type_'.$user.'\'> Type: Admin </p>';
							else echo '<p name=\'type_'.$user.'\'> Type: User </p>';
							echo ' ">'.$user.'<button class="btn btn-info pull-right" data-toggle="modal" name="'.$user.'" id="usr_edit_btn" data-target="#edit_user"></button>
						</a>';
			}
		}
	}
	
	//function for logout from the user manager
	
	public function logout()
	{	
		$newdata = array(
			   'username'  => "",
			   'email'     => "",
			   'type' => "",
			   'logged_in' => FALSE
		   );

		$this->session->set_userdata($newdata);
		redirect('Login', 'refresh');
	}
	
	//function for adding users
	
	public function user_add()
	{	
		$this->load->model("edit_users");
		$add_user_resp = $this->edit_users->add($_POST['user'],$_POST['type'],$_POST['password'],$_POST['name'],$_POST['email'],$_POST['phone'],$_POST['desc'],$_POST['age_cat']);
		echo $add_user_resp;
	}
	
	//function for editing users

	public function user_edit()
	{	
		$this->load->model("edit_users");
		$edit_user_resp = $this->edit_users->edit($_POST['user'],$_POST['type'],$_POST['password'],$_POST['name'],$_POST['email'],$_POST['phone'],$_POST['desc'],$_POST['age_cat']);
		echo $edit_user_resp;
	}

	//function for deleting users
	
	public function delete_user()
	{	
		$this->load->model("edit_users");
		$edit_user_resp = $this->edit_users->delete_usr($_POST['user']);
		echo $edit_user_resp;
	}
	
	//function for loading age categories into form

	public function load_age_cat()
	{
		$this->load->model("age_cat");
		$load_age_resp = $this->age_cat-> load();
		foreach($load_age_resp as $age){
			echo '<button class="list-group-item" name="'.$age.'" id="age_category">'.$age.' ages <a class="btn btn-info pull-right" name="'.$age.'" id="delete_age_cat">x</a></button>';
		}
	}
	public function add_new_age_cat()
	{
		$this->load->model("age_cat");
		$load_age_resp = $this->age_cat->add_new_age_cat($_POST['age_cat']);
	}
	public function delete_age_cat()
	{
		$this->load->model("age_cat");
		$load_age_resp = $this->age_cat->delete_age_cat($_POST['age_cat']);
	}
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */
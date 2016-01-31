<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	/* This is the Login page Controller */
	public function index()
	{
		if($this->session->userdata('logged_in'))
		{
			redirect('Home', 'refresh');
		}
		else
		{
			$data['title']="Login Page"; /* Pages's title*/		
			$this->load->view('Login',$data); /* Load Login View */
		}
		
	}
	public function validation()
	{
		$this->form_validation->set_rules('login_pass', 'Password','callback_userValidation');
		
		if($this->form_validation->run() == false)
		{
			$this->index();
		}
		else 
		{
			redirect('Home', 'refresh');
		}
	}
	public function userValidation(){
		$this->load->model("login_validation");
		$login_message = $this->login_validation->login_val($_POST["login_user"],$_POST["login_pass"]);
		if ($login_message == '0')
		{
			$this->form_validation->set_message('userValidation','The Username or Password you entered are incorrect!');
			return FALSE;
		}
		else
		{
			$newdata = array(
                   'username'  => $_POST["login_user"],
                   'email'     => $_POST["login_pass"],
				   'type' => $login_message,
				   'logged_in' => TRUE
               );

			$this->session->set_userdata($newdata);
			return true;
		}
	}
	public function reset_pass(){
		$this->load->model("send_mail");
		$sent_message = $this->send_mail->send_email($_POST["userrec"],$_POST["emailrec"]);
		echo $sent_message;	
	}
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->load->model('login_model', 'login');
			
		}
	public function index()
	{
			 if($this->session->userdata('username')==true)
			 {
        		redirect(base_url().'courses');
         	}

            $this->load->view('login_view.php');
            $this->load->view('footer.php');
	}

	public function auth()
	{
		
			 $this->form_validation->set_rules('username','username','required');
			 $this->form_validation->set_rules('password','password','required');
			
			$user_name = $this->input->post('username');
			$password = $this->input->post('password');

			$data =  Array('username' =>$user_name ,'password' => $password );

			
			if($this->form_validation->run() !== FALSE)
			{
				$res = $this->login->verify_user($user_name,$password);
				if($res !== false)
				{
					$this->session->set_userdata('username', $user_name);
					
					if($user_name=='admin'){
						$this->session->set_userdata('editMode', true);	
					}else{
						$this->session->set_userdata('editMode', false);
					}
					
					redirect(base_url().'courses');

				}else{

					$loginError =  "wrong username/password";
					
					$data =Array (
						'loginError' => $loginError
					);
					$this->load->view('login_view.php',$data);
					$this->load->view('footer.php');
					
					
				}
			
			
			}else{
				$this->load->view('login_view.php');
				$this->load->view('footer.php');
				
				
			}
			
			
		}

		function register(){
			$first_name = $this->input->post('fname') ;
			$last_name = $this->input->post('lname');
			$email = $this->input->post('email');
			$username =$this->input->post('username') ;
			$password = $this->input->post('passwd');
			
			
			$data = array(
			'username' => $username,
			'password' => $password,
			'email' => $email,
			'first_name' => $first_name,
			'last_name' => $last_name
			
			
			);
			
			if($this->login->register($data)>0){
				
				$data = array('registered'=>true);
				$this->load->view('login_view.php',$data);
				$this->load->view('footer.php');
				
			}
			
		}
		
		function logout()
		{
			$this->session->unset_userdata('username');
			redirect(base_url().'login');
		}
}
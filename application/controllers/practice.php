<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Practice extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			$this->load->library('Usercheck');
			$this->load->library('form_validation');
			$this->load->model('Lessons_model','lessons');
			$this->load->model('Courses_model','courses');
			$this->load->model('Login_model','users');
			
		}
	public function index()
	{
		$this->load->view('header.php'); 
		$this->load->view('practice_view.php'); 
		$this->load->view('footer.php');
		
	}
	
	
	
	

	
}
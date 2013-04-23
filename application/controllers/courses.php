<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Courses extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			$this->load->library('Usercheck');
			$this->load->library('form_validation');
			$this->load->model('login_model', 'login');
			$this->load->model('Courses_model','courses');
			
			
		}
	public function index()
	{
			$editMode = $this->session->userdata('editMode');
			$courses = $this->courses->getCourses();
			
			$data = array(
			'editMode' => $editMode,
			'courses' => $courses
			);
			
			$this->load->view('header.php'); 
			$this->load->view('courses_view.php',$data); 
			$this->load->view('footer.php'); 
	}
	
	public function edit($id)
	{
		$img = $this->input->post('img');
		$title = $this->input->post('title');
		$desc = $this->input->post('desc');
		
		$data = array (
		'img' => $img,
		'title' => $title,
		'desc' => $desc
		);
		if ($this->courses->edit($data,$id) !== FALSE)
		{
			redirect(base_url().'courses');
		}
		
	}

	public function delete($id)
	{
		if ($this->courses->delete($id) !== FALSE)
		{
			redirect(base_url().'courses');
		}
	}
	
	public function add()
	{
		$img  = $this->input->post('img');
		$title = $this->input->post('title');
		$desc = $this->input->post('desc');
		
		$data = array(
		'img' => $img,
		'title' => $title,
		'desc' => $desc
		
		);
		
		
		if ($this->courses->add($data))
		{
			redirect(base_url().'courses');
		}
	}
	
	

	
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Videos extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			$this->load->library('Usercheck');
			$this->load->library('form_validation');
			$this->load->model('Lessons_model','lessons');
			$this->load->model('Courses_model','courses');
			$this->load->model('Videos_model','videos');
			$this->load->model('Notes_model','notes');
			$this->load->model('Login_model','users');
			
			
		}
	public function index()
	{
			
	}
	
	public function editVideo($video_ID,$lesson_ID,$course_ID)
	{
		$title = $this->input->post('title');
		$desc = $this->input->post('desc');
		$min = $this->input->post('min');
		$sec = $this->input->post('sec');
		$embedUrl = $this->input->post('embedUrl');
		
		$data = array(
		'title' =>$title,
		'desc' => $desc,
		'embed_url' => $embedUrl,
		'duration_min' => $min,
		'duration_sec' =>$sec
		);
		
		if($this->videos->editVideo($video_ID,$data)!== FALSE)
		{
			redirect(base_url().'lessons/lessonExplorer/'.$lesson_ID.'/'.$course_ID);
		}
		
	}
	
	public function delete($video_ID,$lesson_ID,$course_ID)
	{
		if($this->videos->delete($video_ID)!== FALSE)
		{
			redirect(base_url().'lessons/lessonExplorer/'.$lesson_ID.'/'.$course_ID);
		}
	}
	
	public function view($video_ID,$lesson_ID,$course_ID)
	{
		$username = $this->session->userdata('username');
		$userData = $this->users->getUser($username);
		$user_ID = $userData[0]->user_ID;
		$video = $this->videos->viewVideo($video_ID);
		$editMode = $this->session->userdata('editMode');
		$lessons = $this->lessons->getLessonsByLessonID($lesson_ID);
		$course = $this->courses->getCourses($course_ID);
		$note = $this->notes->getNotesByVideoID($video_ID,$user_ID);
		
		$data = array(
		'editMode' => $editMode,
		'video' => $video,
		'lessons' => $lessons,
		'course' => $course,
		'note' => $note,
		'user' => $userData
		);
		
		$this->load->view('header.php'); 
		$this->load->view('video_view.php',$data); 
		$this->load->view('footer.php'); 
		
	}

	
}
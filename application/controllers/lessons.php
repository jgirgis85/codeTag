<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lessons extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			$this->load->library('Usercheck');
			$this->load->library('form_validation');
			$this->load->model('Lessons_model','lessons');
			$this->load->model('Courses_model','courses');
			$this->load->model('Videos_model','videos');
			$this->load->model('Quizzes_model','quizzes');
			
			
		}
	public function index()
	{
			
	}
	
	public function view($id)
	{
		$editMode = $this->session->userdata('editMode');
		$lessons = $this->lessons->getLessons($id);
		$course = $this->courses->getCourses($id);
			
			$data = array(
			'editMode' => $editMode,
			'lessons' => $lessons,
			'course' => $course
			);
			
			$this->load->view('header.php'); 
			$this->load->view('lessons_view.php',$data); 
			$this->load->view('footer.php'); 
	}
	
	public function edit($id,$course_ID)
	{
		$img = $this->input->post('img');
		$title = $this->input->post('title');
		$desc = $this->input->post('desc');
		
		$data = array (
		'img' => $img,
		'title' => $title,
		'desc' => $desc
		);
		if ($this->lessons->edit($data,$id) !== FALSE)
		{
			redirect(base_url().'lessons/view/'.$course_ID);
		}
		
	}

	public function delete($id,$course_ID)
	{
		if ($this->lessons->delete($id) !== FALSE)
		{
			redirect(base_url().'lessons/view/'.$course_ID);
		}
	}
	
	public function add($id)
	{
		$img  = $this->input->post('img');
		$title = $this->input->post('title');
		$desc = $this->input->post('desc');
		
		$data = array(
		'img' => $img,
		'title' => $title,
		'desc' => $desc,
		'course_ID' => $id
		
	);
		
		
		if ($this->lessons->add($data))
		{
			redirect(base_url().'lessons/view/'.$id);
		}
	}
	
	public function lessonExplorer($lesson_ID,$course_ID)
	{
		// search in the videos table for video lessons
		$videos = $this->videos->getVideos($lesson_ID);
		$quizzes = $this->quizzes->getQuizzes($lesson_ID);
		
		
		//call a single lesson view send the data to this view
			$editMode = $this->session->userdata('editMode');
			$lessons = $this->lessons->getLessonsByLessonID($lesson_ID);
			$course = $this->courses->getCourses($course_ID);
			
			$data = array(
			'editMode' => $editMode,
			'lessons' => $lessons,
			'course' => $course,
			'videos' => $videos,
			'quizzes' => $quizzes
			);
			$this->load->view('header.php'); 
			$this->load->view('sgl_lesson_view.php',$data); 
			$this->load->view('footer.php'); 
	}
	
	public function addVideo($lesson_ID,$course_ID)
	{
		$title = $this->input->post('title');
		$desc = $this->input->post('desc');
		$embedUrl = $this->input->post('embedUrl');
		$min = $this->input->post('min');
		$sec = $this->input->post('sec');
		
		$data = array(
		"title" => $title,
		"desc" =>$desc,
		"embed_url" => $embedUrl,
		"duration_min" => $min,
		"duration_sec" => $sec,
		"lesson_ID" => $lesson_ID
		);
		
		if($this->lessons->addVideo($data))
		{
			redirect(base_url().'lessons/lessonExplorer/'.$lesson_ID.'/'.$course_ID);
		}
	}
	
	
	
	

	
}
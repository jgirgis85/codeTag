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
			$this->load->model('Practice_model','practice');
			
		}
	public function index()
	{
		
		
	}
	
	public function practice_view($course_ID,$lesson_ID,$practice_ID)
	{
		$lessons = $this->lessons->getLessonsByLessonID($lesson_ID);
		$course = $this->courses->getCourses($course_ID);
		$practice = $this->practice->getPracticeByPracticeID($practice_ID);
		
		$data = array(
			'lessons' => $lessons,
			'course' => $course,
			'practice' => $practice
			 );
		$this->load->view('header.php'); 
		$this->load->view('practice_view.php',$data); 
		$this->load->view('practice_footer.php');	
	}
	public function edit($course_ID,$lesson_ID,$practice_ID)
	{
		$lessons = $this->lessons->getLessonsByLessonID($lesson_ID);
		$course = $this->courses->getCourses($course_ID);
		$practice = $this->practice->getPracticeByPracticeID($practice_ID);
		
		$data = array(
			'lessons' => $lessons,
			'course' => $course,
			'practice' => $practice
			 );
		$this->load->view('header.php'); 
		$this->load->view('practice_edit.php',$data); 
		$this->load->view('practice_footer.php');	
	}
	
	public function addPractice($lesson_ID,$course_ID)
	{
		$title = $this->input->post('title');
		$task = $this->input->post('task');
		
		$data = array(
		'lesson_ID'=>$lesson_ID,
		'title' =>$title,
		'task'=>$task
		);
		
		if($this->practice->addPractice($data))
		{
			// if add succeded redirect to the lesson page
			redirect(base_url().'lessons/lessonExplorer/'.$lesson_ID.'/'.$course_ID);
		}
	}
	
	
}
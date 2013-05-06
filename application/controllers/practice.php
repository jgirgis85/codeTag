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
		$rules = $this->practice->getRules($practice_ID);
		
		$data = array(
			'lessons' => $lessons,
			'course' => $course,
			'practice' => $practice,
			'rules'=>$rules
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
	
	
	
	public function editPractice($lesson_ID,$course_ID,$practice_ID)
	{
		$title = $this->input->post('title');
		$task = $this->input->post('task');
		
		$data = array(
		'title' =>$title,
		'task'=>$task
		);
		
		if($this->practice->editPractice($data,$practice_ID) != FALSE)
		{
			// if update succeded redirect to the lesson page
			redirect(base_url().'practice/edit/'.$course_ID.'/'.$lesson_ID.'/'.$practice_ID);
		}
	}
	
	
	public function editRule($lesson_ID,$course_ID,$practice_ID,$rule_ID)
	{
		$priority = $this->input->post('priority');
		$rule = $this->input->post('rule');
		$error = $this->input->post('error');
		
		$data = array(
		'priority' =>$priority,
		'rule'=>$rule,
		'error'=>$error
		);
		
		if($this->practice->editRule($data,$rule_ID) != FALSE)
		{
			// if update succeded redirect to the practice edit page
			redirect(base_url().'practice/edit/'.$course_ID.'/'.$lesson_ID.'/'.$practice_ID);
		}
	}
	
	public function deleteRule($lesson_ID,$course_ID,$practice_ID,$rule_ID)
	{
		if($this->practice->deleteRule($rule_ID) != FALSE)
		{
			// if delete succeded redirect to the practice edit page
			redirect(base_url().'practice/edit/'.$course_ID.'/'.$lesson_ID.'/'.$practice_ID);
		}
	}
	public function addRule($lesson_ID,$course_ID,$practice_ID)
	{
		$rule = $this->input->post('rule');
		$error = $this->input->post('error');
		$priority = $this->input->post('priority');
		
		$data = array(
		'rule'=>$rule,
		'error' =>$error,
		'priority'=>$priority,
		'practice_ID'=>$practice_ID
		);
		
		if($this->practice->addRule($data))
		{
			// if add succeded redirect to the lesson page
			redirect(base_url().'practice/edit/'.$course_ID.'/'.$lesson_ID.'/'.$practice_ID);
		}
	}
	
	public function getHighestPriorityCount()
	{
		$practice_ID = $this->input->post('practice_ID');
		
		if($priority = $this->practice->getHighestRulePriority($practice_ID)){
				
			$result = array(
			'status' =>'success',
			'priority'=>$priority[0]->priority
			
			);
			
			echo json_encode($result);
		}
		
	}
	
	public function getRules()
	{
		$currentPriority = $this->input->post('currentPriority');
		// get rules for the current priority
		$currentRules = $this->practice->getRulesByPriority($currentPriority);
		
	}
	
	
}
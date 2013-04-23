<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quizzes extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			$this->load->library('Usercheck');
			$this->load->library('form_validation');
			$this->load->model('Quizzes_model','quizzes');
			$this->load->model('Lessons_model','lessons');
			$this->load->model('Courses_model','courses');
			
		}
	public function index()
	{
			
	}
	
	public function view($quiz_ID,$lesson_ID,$course_ID)
	{
		$lessons = $this->lessons->getLessonsByLessonID($lesson_ID);
		$course = $this->courses->getCourses($course_ID);
		$quiz = $this->quizzes->getQuiz($quiz_ID);
		$questions = $this->quizzes->getQuestions($quiz_ID);
		
		$data = array(
		'lessons' => $lessons,
		'course' => $course,
		'quiz' => $quiz,
		'questions' => $questions
		);
		
		$this->load->view('header.php'); 
		$this->load->view('question_view.php',$data); 
		$this->load->view('footer.php');
	}
	
	// function to add quiz and the first question with answers
	public function add($lesson_ID,$course_ID)
	{
		$title = $this->input->post('title');
		$question = $this->input->post('question');
		$rAns = $this->input->post('rAns');
		$wAns1 = $this->input->post('wAns1');
		$wAns2 = $this->input->post('wAns2');
		$wAns3 = $this->input->post('wAns3');
		
		
		$data = array(
		'title' =>$title,
		'lesson_ID' => $lesson_ID,
		'pass_count' => '1'
		);
		
		if($quiz_ID = $this->quizzes->addQuiz($data))
		{
			$data = array(
			'quiz_ID' =>$quiz_ID,
			'question' => $question,
			'position' => '1'
			);
			
			if($question_ID = $this->quizzes->addQuestion($data)){
				
				$data = array(
				   array(
				      'question_ID' =>  $question_ID,
				      'answer' => $rAns ,
				      'status' => 'right'
				   ),
				   array(
				      'question_ID' => $question_ID ,
				      'answer' => $wAns1 ,
				      'status' => 'wrong'
				   ),
				   array(
				      'question_ID' =>  $question_ID,
				      'answer' => $wAns2 ,
				      'status' => 'wrong'
				   ),
				   array(
				      'question_ID' => $question_ID,
				      'answer' => $wAns3 ,
				      'status' => 'wrong'
				   )
				);
				
				if($this->quizzes->addAnswers($data)){
				
					redirect(base_url().'lessons/lessonExplorer/'.$lesson_ID.'/'.$course_ID);
				}
			}
		}
		
	}

	// function to add extra question
	public function addQuestion($lesson_ID,$course_ID,$quiz_ID)
	{
		$question = $this->input->post('question');
		$rAns = $this->input->post('rAns');
		$wAns1 = $this->input->post('wAns1');
		$wAns2 = $this->input->post('wAns2');
		$wAns3 = $this->input->post('wAns3');
		
		$positions = $this->quizzes->getHighestPosition($quiz_ID);
		
		$highestPosition = $positions[0]->position;
		
		
			$data = array(
			'quiz_ID' =>$quiz_ID,
			'question' => $question,
			'position' => $highestPosition+1
			);
			
			if($question_ID = $this->quizzes->addQuestion($data)){
				
				$data = array(
				   array(
				      'question_ID' =>  $question_ID,
				      'answer' => $rAns ,
				      'status' => 'right'
				   ),
				   array(
				      'question_ID' => $question_ID ,
				      'answer' => $wAns1 ,
				      'status' => 'wrong'
				   ),
				   array(
				      'question_ID' =>  $question_ID,
				      'answer' => $wAns2 ,
				      'status' => 'wrong'
				   ),
				   array(
				      'question_ID' => $question_ID,
				      'answer' => $wAns3 ,
				      'status' => 'wrong'
				   )
				);
				
				if($this->quizzes->addAnswers($data)){
				
					redirect(base_url().'quizzes/edit/'.$quiz_ID.'/'.$lesson_ID.'/'.$course_ID);
				}
			}
		
		
	}


	public function countQuestions($quiz_ID)
	{
		if($questionCount = $this->quizzes->countQuestions($quiz_ID)){
				
			$return = array( 'count'    => $questionCount,'status' => 'success' );
		 
			}    
		 			// print out the JSON encoded output
		            echo json_encode($return);
		
		
	}


	public function deleteQuestion($question_ID,$quiz_ID,$lesson_ID,$course_ID)
	{
		
		//get question position
		
		$positionArray = $this->quizzes->questionPosition($question_ID);
		$questionPosition = $positionArray[0]->position;
		// delete answers
		if($this->quizzes->deleteAnswers($question_ID) !== FALSE)
		
		{
			//delete question
			if($this->quizzes->deleteQuestion($question_ID) !== FALSE)
				{
					//loop that shifts the other questions positions
					$questionsArray = $this->quizzes->getQuestions($quiz_ID);
					foreach ($questionsArray as $question) {
						
						$positionArray = $this->quizzes->questionPosition($question->question_ID);
						$nextQuestionPosition = $positionArray[0]->position;
						if($nextQuestionPosition>$questionPosition)
						{
							$data = array(
							'position' => $nextQuestionPosition-1
							
							);
							// decrease position by one
							$this->quizzes->updateQuestion($question->question_ID,$data);
						}
						
						
					}
					//return success json to the ajax call
					$return = array( 'status' => 'success' );
					echo json_encode($return);
					
				}
			
		}
		
		
		
		
		
		
			
	}

	public function sortQuestions()
	{
		$questionID = $_GET['questionID'];
		
		foreach($questionID as $key=>$value) {
			
			//set position to key where  id equal value
			$data = array (
			'position' => $key+1
			
			);
			$this->quizzes->updateQuestion($value,$data);
			
		}
		$return = array( 'status' => 'success');
		echo json_encode($return);
	}



	public function edit($quiz_ID,$lesson_ID,$course_ID)
	{
		$editMode = $this->session->userdata('editMode');
		$lessons = $this->lessons->getLessonsByLessonID($lesson_ID);
		$course = $this->courses->getCourses($course_ID);
		$quiz = $this->quizzes->getQuiz($quiz_ID);
		$questionsCount = $this->quizzes->countQuestions($quiz_ID);
		$questions = $this->quizzes->getQuestions($quiz_ID);
		
		$data = array(
		'editMode' =>$editMode,
		'lessons' => $lessons,
		'course' => $course,
		'quiz' => $quiz,
		'questions_count' => $questionsCount,
		'questions' => $questions
		);
		
		$this->load->view('header.php'); 
		$this->load->view('quiz_edit_view.php',$data); 
		$this->load->view('footer.php'); 
	}


	public function editQuestion($question_ID,$lesson_ID,$course_ID,$quiz_ID)
	{
		//updating the question title
		$question = $this->input->post('question');
		$data = array(
		'question' =>$question
		);
		$this->quizzes->updateQuestion($question_ID,$data);
		
		// updating answers
		$answers = $this->quizzes->getAnswers($question_ID);
		
		foreach ($answers as $answer) {
			$ans_ID = $answer->answer_ID;
			$answer = $this->input->post('answer-'.$ans_ID);
			$data= array(
			'answer' =>$answer
			);
			$this->quizzes->updateAnswer($ans_ID,$data);
		}
		
		redirect(base_url().'quizzes/edit/'.$quiz_ID.'/'.$lesson_ID.'/'.$course_ID);
	}
	
	

	
}
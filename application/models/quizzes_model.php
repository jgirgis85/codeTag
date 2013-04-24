<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


	class Quizzes_model extends CI_Model{

	
		
	function addQuiz($data)
	{
	    $this->db->insert('quizzes', $data);
	    return $this->db->insert_id();
	}
	function addQuestion($data)
	{
	    $this->db->insert('questions', $data);
	    return $this->db->insert_id();
	}
	function addAnswersToTemp($tempData)
	{
	    $this->db->insert('anstemptbl', $tempData);
	    return $this->db->insert_id();
	}
	
	function countQuestions($quiz_ID)
	{
		$this->db->like('quiz_ID', $quiz_ID);
		$this->db->from('questions');
		return $this->db->count_all_results();
	}
	function addAnswers($data)
	{
	    $this->db->insert_batch('answers', $data);
	    return $this->db->insert_id();
	}
	
	function addResult($resultData)
	{
	    $this->db->insert('results', $resultData);
	    return $this->db->insert_id();
	}
	
	
	function getQuizzes($lesson_ID)
	{
	    $this->db->select('lesson_ID,quiz_ID,title,pass_count');
	    $this->db->from('quizzes');
		$this->db->where('lesson_ID', $lesson_ID);
	    $this->db->order_by('quiz_ID', 'asc');
	    return $this->db->get()->result();
	}

	function getResults($quiz_ID,$user_ID)
	{
	    $this->db->select('result_ID,quiz_ID,user_ID,wrong_count,right_count');
	    $this->db->from('results');
		$this->db->where('user_ID', $user_ID);
		$this->db->where('quiz_ID', $quiz_ID);
	    $this->db->order_by('quiz_ID', 'asc');
	    return $this->db->get()->result();
	}
	
	function getQuestions($quiz_ID)
	{
	    $this->db->select('question_ID,question,quiz_ID,position');
	    $this->db->from('questions');
		$this->db->where('quiz_ID', $quiz_ID);
	    $this->db->order_by('position', 'asc');
	    return $this->db->get()->result();
	}
	function getQuestion($position)
	{
	    $this->db->select('question_ID,question,quiz_ID,position');
	    $this->db->from('questions');
		$this->db->where('position', $position);
	    $this->db->order_by('position', 'asc');
	    return $this->db->get()->result();
	}
	function questionPosition($question_ID)
	{
	    $this->db->select('position');
	    $this->db->from('questions');
		$this->db->where('question_ID', $question_ID);
	    $this->db->order_by('position', 'asc');
	    return $this->db->get()->result();
	}
	
	
	function deleteQuestion($question_ID)
	{
	    $this->db->where('question_ID', $question_ID);
	    $this->db->delete('questions');
	    return $this->db->affected_rows();
	}
	
	function deleteTempAns()
	{
	    $this->db->empty_table('anstemptbl');
	    return $this->db->affected_rows();
	}
	
	public function getAllTemps()
	{
		$this->db->select('*');
	    $this->db->from('anstemptbl');
	    return $this->db->get()->result();
	}
	
	
	function getHighestPosition($quiz_ID)
	{
	    $this->db->select('position');
	    $this->db->from('questions');
		$this->db->where('quiz_ID', $quiz_ID);
	    $this->db->order_by('position', 'desc');
	    return $this->db->get()->result();
	}
	function getAnswers($question_ID)
	{
	    $this->db->select('question_ID,answer_ID,answer,status');
	    $this->db->from('answers');
		$this->db->where('question_ID', $question_ID);
	    $this->db->order_by('answer_ID', 'asc');
	    return $this->db->get()->result();
	}
	
	function getAnswerStatus($answer_ID)
	{
	    $this->db->select('status');
	    $this->db->from('answers');
		$this->db->where('answer_ID', $answer_ID);
	    $this->db->order_by('answer_ID', 'asc');
	    return $this->db->get()->result();
	}
	function getRandomAnswers($question_ID)
	{
	    $this->db->select('answer_ID,answer,status');
	    $this->db->from('answers');
		$this->db->where('question_ID', $question_ID);
	    $this->db->order_by('RAND()');
	    return $this->db->get()->result();
	}

	function deleteAnswers($question_ID)
	{
	    $this->db->where('question_ID', $question_ID);
	    $this->db->delete('answers');
	    return $this->db->affected_rows();
	}
	
	function getQuiz($quiz_ID)
	{
	    $this->db->select('lesson_ID,quiz_ID,title,pass_count');
	    $this->db->from('quizzes');
		$this->db->where('quiz_ID', $quiz_ID);
	    $this->db->order_by('quiz_ID', 'asc');
	    return $this->db->get()->result();
	}

	function updateQuestion($question_ID,$data)
	{
		 $this->db->where('question_ID', $question_ID);
	    $this->db->update('questions', $data);
	    return $this->db->affected_rows();
	}
	
	function updateResult($quiz_ID,$user_ID,$resultData)
	{
		 $this->db->where('quiz_ID', $quiz_ID);
		 $this->db->where('user_ID', $user_ID);
	     $this->db->update('results', $resultData);
	     return $this->db->affected_rows();
	}
	
	function updateAnswer($answer_ID,$data)
	{
		 $this->db->where('answer_ID', $answer_ID);
	    $this->db->update('answers', $data);
	    return $this->db->affected_rows();
	}

}
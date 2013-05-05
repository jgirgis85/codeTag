<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


	class Practice_model extends CI_Model{

	
		
	function addPractice($data)
	{
	    $this->db->insert('practice', $data);
	    return $this->db->insert_id();
	}
	
	function getPractice($lesson_ID)
	{
		$this->db->select('practice_ID,title,task');
		$this->db->from('practice');
		$this->db->where('lesson_ID',$lesson_ID);
		$this->db->order_by('practice_ID','asc');
		return $this->db->get()->result();
	}
	
	function getPracticeByPracticeID($practice_ID)
	{
		$this->db->select('lesson_ID,practice_ID,title,task');
		$this->db->from('practice');
		$this->db->where('practice_ID',$practice_ID);
		$this->db->order_by('practice_ID','asc');
		return $this->db->get()->result();
	}
	

}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


	class Practice_model extends CI_Model{

	
		
	function addPractice($data)
	{
	    $this->db->insert('practice', $data);
	    return $this->db->insert_id();
	}
	function addRule($data)
	{
	    $this->db->insert('rules', $data);
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
	
	function getRules($practice_ID)
	{
		$this->db->select('rule_ID,rule,error,priority');
		$this->db->from('rules');
		$this->db->where('practice_ID',$practice_ID);
		$this->db->order_by('priority','asc');
		return $this->db->get()->result();
	}
	
	function getHighestRulePriority($practice_ID)
	{
		$this->db->select('priority');
		$this->db->from('rules');
		$this->db->where('practice_ID',$practice_ID);
		$this->db->order_by('priority','desc');
		return $this->db->get()->result();
	}
	function deleteRule($rule_ID) 
	{
	    $this->db->where('rule_ID', $rule_ID);
	    $this->db->delete('rules');
	    return $this->db->affected_rows();
	}
	function editPractice($data,$practice_ID)
	{
		$this->db->where('practice_ID', $practice_ID);
	    $this->db->update('practice', $data);
	    return $this->db->affected_rows();
	}
	function editRule($data,$rule_ID)
	{
		$this->db->where('rule_ID', $rule_ID);
	    $this->db->update('rules', $data);
	    return $this->db->affected_rows();
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
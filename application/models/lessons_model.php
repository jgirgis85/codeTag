<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


	class Lessons_model extends CI_Model{

	
		
	function getLessons($id = null)
	{
	    $this->db->select('lesson_ID,course_ID,title,desc,img');
	    $this->db->from('lessons');
		$this->db->where('course_ID', $id);
	    $this->db->order_by('lesson_ID', 'asc');
	    return $this->db->get()->result();
	}
	function getLessonsByLessonID($id = null)
	{
	    $this->db->select('lesson_ID,course_ID,title,desc,img');
	    $this->db->from('lessons');
		$this->db->where('lesson_ID', $id);
	    $this->db->order_by('lesson_ID', 'asc');
	    return $this->db->get()->result();
	}
	
	function edit($data, $id)
	{
	    $this->db->where('lesson_ID', $id);
	    $this->db->update('lessons', $data);
	    return $this->db->affected_rows();
	}
	
	function delete($id)
	{
	    $this->db->where('lesson_ID', $id);
	    $this->db->delete('lessons');
	    return $this->db->affected_rows();
	}
	
	function add($data)
	{
	    $this->db->insert('lessons', $data);
	    return $this->db->insert_id();
	}
	
	function addVideo($data)
	{
	    $this->db->insert('videos', $data);
	    return $this->db->insert_id();
	}



	}
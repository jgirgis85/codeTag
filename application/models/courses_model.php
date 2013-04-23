<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


	class Courses_model extends CI_Model{

	
		
	function getCourses($id = null)
	{
	    $this->db->select('course_ID,title,desc,img');
	    $this->db->from('courses');
	    if (!is_null($id)) $this->db->where('course_ID', $id);
	    $this->db->order_by('course_ID', 'asc');
	    return $this->db->get()->result();
	}
	
	function edit($data, $id)
	{
	    $this->db->where('course_ID', $id);
	    $this->db->update('courses', $data);
	    return $this->db->affected_rows();
	}
	
	function delete($id)
	{
	    $this->db->where('course_ID', $id);
	    $this->db->delete('courses');
	    return $this->db->affected_rows();
	}
	
	function add($data)
	{
	    $this->db->insert('courses', $data);
	    return $this->db->insert_id();
	}



	}
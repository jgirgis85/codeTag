<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


	class Notes_model extends CI_Model{

	
		
	function getNotesByVideoID($video_ID,$user_ID)
	{
	    $this->db->select('video_ID,user_ID,note_ID,body');
	    $this->db->from('notes');
		$this->db->where('video_ID', $video_ID);
		$this->db->where('user_ID', $user_ID);
	    $this->db->order_by('note_ID', 'asc');
	    return $this->db->get()->result();
	}
	
		function update($video_ID,$user_ID,$data)
		{
		    $this->db->where('video_ID', $video_ID);
			$this->db->where('user_ID', $user_ID);
		    $this->db->update('notes', $data);
		    return $this->db->affected_rows();
		
		}
		
		function add($data)
	{
	    $this->db->insert('notes', $data);
	    return $this->db->insert_id();
	}
	
}
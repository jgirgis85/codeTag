<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


	class Videos_model extends CI_Model{

	
		
	function getVideos($lesson_ID)
	{
	    $this->db->select('lesson_ID,video_ID,embed_url,duration_min,duration_sec,title,desc');
	    $this->db->from('videos');
		$this->db->where('lesson_ID', $lesson_ID);
	    $this->db->order_by('video_ID', 'asc');
	    return $this->db->get()->result();
	}
	function viewVideo($video_ID)
	{
	    $this->db->select('lesson_ID,video_ID,embed_url,duration_min,duration_sec,title,desc');
	    $this->db->from('videos');
		$this->db->where('video_ID', $video_ID);
	    $this->db->order_by('video_ID', 'asc');
	    return $this->db->get()->result();
	}
	
	function editVideo($video_ID,$data)
	{
	    $this->db->where('video_ID', $video_ID);
	    $this->db->update('videos', $data);
	    return $this->db->affected_rows();
	
	}
	
	function delete($video_ID)
	{
		$this->db->where('video_ID', $video_ID);
	    $this->db->delete('videos');
	    return $this->db->affected_rows();
	}

}
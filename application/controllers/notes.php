<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notes extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			$this->load->library('Usercheck');
			$this->load->model('Notes_model','notes');
			
			
		}
	public function index()
	{
			
	}
	
	public function update()
	{
			$video_ID = $this->input->post('video_ID');
			$user_ID = $this->input->post('user_ID');
			$body = $this->input->post('body');
			
			$data= array(
			'body' => $body
			
			);			
			
			if($this->notes->update($video_ID,$user_ID,$data)!== FALSE){			
						
					$return = array(
		 
		                'status'    =>      'success'
		 
		            );
		 
			}    
		 			// print out the JSON encoded output
		            echo json_encode($return);
	}
	public function add()
	{
			$body = $this->input->post('body');
			$user_ID = $this->input->post('user_ID');
			$video_ID = $this->input->post('video_ID');
			
			$data= array(
			'body' => $body,
			'user_ID' => $user_ID,
			'video_ID' => $video_ID
			
			);			
			
			if($note_ID = $this->notes->add($data)){			
						
					$return = array(
		 
		                'status'    =>      'success',
		                'note_ID' => $note_ID
		 
		            );
		 
			}    
		 			// print out the JSON encoded output
		            echo json_encode($return);
	}
	
	

	
}
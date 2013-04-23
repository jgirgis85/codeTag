<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usercheck  {
	
	

	function __construct()
	{
		
		$CI =& get_instance();
		 $CI->load->library("session");
		
		if($CI->session->userdata('username')==false){
		redirect('login');
		
		
	}else{
		if($CI->session->userdata('username')== 'admin'){
			
		}
	}
	}
	

	
}


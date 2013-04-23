<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


	class Login_model extends CI_Model{

	
		function verify_user($user_name,$password)
	{
	    $this->db->from('users');
	    $this->db->where('username', $user_name);
		$this->db->where('password', $password);
		$this->db->limit(1);
	    $q = $this->db->get();
		if($q->num_rows > 0){
			return $q->row();
		}
		return FALSE;
	}
	
	function register($data){
		$this->db->insert('users', $data);
		return $this->db->insert_id();
	}
	
	function getUser($username)
	{
		$this->db->select('user_ID');
	    $this->db->from('users');
		$this->db->where('username', $username);
	    $this->db->order_by('user_ID', 'asc');
	    return $this->db->get()->result();
	}




	}
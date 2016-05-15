<?php 
class Login extends CI_Model{
	function check_account($username, $password){
		$this->db->where('uauthename',$username);
		$this->db->where('password',$password);
		return $this->db->get('users');
	}
}
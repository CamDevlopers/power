<?php 
class Login extends CI_Model{
	function check_account($username, $password){
		$this->db->where('uauthename',$username);
		$this->db->where('password',$password);
		return $this->db->get('users');
	}

	function get_profile($uid){
		$this->db->where('uid',$uid);
		return $this->db->get('users');
	}

	function check_old_password($id,$pass){
		$this->db->where('uid',$id);
		$this->db->where('password',$pass);
		return $this->db->get('users');
	}

	function update_profile($id,$data){
		$this->db->where('uid',$id);
		return $this->db->update('users',$data);
	}
}
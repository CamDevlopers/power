<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logins extends CI_Controller{

	function index(){
		is_login();
		$this->load->view('login/login.php');
	}

	function check_account(){
		is_login();
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password','required|min_length[5]');
		if($this->form_validation->run()==FALSE){
			$this->load->view('login/login.php');
		}else{
			$check_account = $this->Login->check_account($username,$password);
			if($check_account->num_rows() > 0){
				$this->session->set_userdata('uid',$check_account->row()->uid);
				echo json_encode(array('status' => TRUE, 'message'=>"You have success login, System is redirecting!!"));
			}else{
				echo json_encode(array('status' => FALSE, 'message'=>"Username or Password don't match!"));
			}
		}
	}

	function sign_out(){
		$this->session->unset_userdata('uid');
		redirect('logins');
	}

	function profile($id){
		is_notlogined();
		$data['save'] = '';
		$data['profile'] = $this->Login->get_profile($id)->row(); 
		$this->load->view('login/profile',$data);
	}

	function update_profile($id){
		is_notlogined();
		$data['profile'] = $this->Login->get_profile($id)->row(); 
		$data['save'] = '';
		$this->form_validation->set_rules('fullname','Full Name','required|min_length[3]');
		$this->form_validation->set_rules('username','User Name','required|min_length[3]');
		$this->form_validation->set_rules('old_pass','Old Password','min_length[5]|callback_check_old_password');
		$this->form_validation->set_rules('new_pass','New Password','min_length[5]');
		$this->form_validation->set_rules('con_pass','Confirm Password','min_length[5]|matches[new_pass]');

		if($this->form_validation->run()==FALSE){
			$this->load->view('login/profile',$data);
		}else{
			$data['save'] = 'Success update your profile!';
			$arr['uname'] = $this->input->post('fullname');
			$arr['uauthename'] = $this->input->post('username');
			if($this->input->post('new_pass')!=''){
				$arr['password'] = md5($this->input->post('new_pass'));
			}
			$this->Login->update_profile($id,$arr);
			$this->load->view('login/profile',$data);
		}
	}

	function check_old_password($str){
		$pass = md5($str);
		$check = $this->Login->check_old_password($this->session->userdata('uid'),$pass);
		if($check->num_rows() >0){
			return true;
		}else{
			if($str==''){
				return true;
			}else{
				$this->form_validation->set_message('check_old_password', 'The %s field is not correct!');
				return false;
			}
			
		}
	}

}
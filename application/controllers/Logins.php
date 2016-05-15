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
				echo json_encode(array('status' => FALSE, 'message'=>"Email or Password don't match!"));
			}
		}
	}

	function sign_out(){
		$this->session->unset_userdata('uid');
		redirect('logins');
	}

}
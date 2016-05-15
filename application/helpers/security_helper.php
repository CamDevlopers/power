<?php 
	function is_notlogined(){
		$CI = & get_instance();
		if(!$CI->session->userdata('uid')){
			redirect('Logins');
		}
	}

	function is_login(){
		$CI = & get_instance();
		if($CI->session->userdata('uid')){
			redirect('manages/remotes');
		}
	}
?>
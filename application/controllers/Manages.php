<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manages extends CI_Controller{
	function index(){
		$this->remotes();
	}

	function remotes(){
		is_notlogined();
		$data['floors'] = $this->Manage->get_all_floor();;
		// var_dump($floors);
		$this->load->view('pages/remotes',$data);
	}

	function remoter(){
		$data['equipments'] = $this->Manage->get_all_equipments();
		$this->load->view('pages/remoter',$data);
	}

	function update_lamp(){
		$status = $this->input->post('status');
		$id = $this->input->post('id');
		if($status==1){
			$data['eremote'] = 1;
			$data['eremoter'] = 1;
		}else{
			$data['eremote'] = 0;
			$data['eremoter'] = 0;
		}
		if($this->Manage->update_lame($id,$data)){
			echo json_encode(array('status' => true,'message'=>'Updated device #'.$id));
		}else{
			echo json_encode(array('status' => false,'message'=>'Could not update device #'.$id));
		}
	}

	function update_air(){
		$status = $this->input->post('status');
		$id = $this->input->post('id');
		$data['eremoter'] = 1;
		
		if($this->Manage->update_lame($id,$data)){
			echo json_encode(array('status' => true,'message'=>'Updated device #'.$id));
		}else{
			echo json_encode(array('status' => false,'message'=>'Could not update device #'.$id));
		}
	}

	function air_off(){
		$id = $this->input->post('id');
		$data['eremoter'] = 0;
		if($this->Manage->update_lame($id,$data)){
			echo json_encode(array('status' => true,'message'=>'Updated device #'.$id));
		}else{
			echo json_encode(array('status' => false,'message'=>'Could not update device #'.$id));
		}
	}

	function get_remoter(){
		$remoter = $this->Manage->get_remoter();
		if($remoter->num_rows()>0){
			$text = '';
			foreach ($remoter->result() as $val) {
				$text .= $val->eid.',';
			}
			$output = trim($text,',');
			echo json_encode(array('status' => true,'message'=>$output));	
		}else{
			echo json_encode(array('status' => false,'message'=>'No turn on device!'));
		}
	}

	function get_remote(){
		$remote = $this->Manage->get_remote();
		if($remote->num_rows()>0){
			$text = '';
			foreach ($remote->result() as $val) {
				$text .= $val->eid.',';
			}
			$output = trim($text,',');
			echo json_encode(array('status' => true,'message'=>$output));	
		}else{
			echo json_encode(array('status' => false,'message'=>'No turn on device!'));
		}
	}

	function update_entry(){
		$status = $this->input->post('status');
		$id = $this->input->post('id');
		if($status==1){
			$data['eremote'] = 1;
		}else{
			$data['eremote'] = 0;
		}
		
		if($this->Manage->update_lame($id,$data)){
			echo json_encode(array('status' => true,'message'=>'Updated device #'.$id));
		}else{
			echo json_encode(array('status' => false,'message'=>'Could not update device #'.$id));
		}
	}
}
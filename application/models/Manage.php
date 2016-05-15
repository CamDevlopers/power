<?php 
class Manage extends CI_Model{

	function get_all_floor(){
		return $this->db->get('floors');
	}

	function get_room_by_floor_id($fid){
		$this->db->from('rooms');
		$this->db->join('floors','floors.fid=rooms.fid');
		$this->db->where('rooms.fid',$fid);
		return $this->db->get();
	}


	function get_all_equipments_by_room_id($rid){
		$this->db->from('equipments');
		$this->db->join('rooms','rooms.rid = equipments.rid');
		$this->db->where('equipments.rid',$rid);
		return $this->db->get();
	}

	function get_all_equipments(){
		$this->db->from('equipments');
		$this->db->join('rooms','rooms.rid = equipments.rid');
		$this->db->join('floors','floors.fid = rooms.fid');
		return $this->db->get();
	}

	function update_lame($id, $data){
		$this->db->where('eid',$id);
		return $this->db->update('equipments',$data);
	}

	function get_remoter(){
		$this->db->where('eremoter',1);
		return $this->db->get('equipments');
	}

	function get_remote(){
		$this->db->where('eremote',1);
		// $this->db->where('etype',2);
		return $this->db->get('equipments');
	}
}

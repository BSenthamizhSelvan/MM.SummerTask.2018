<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class forum_model extends CI_Model{

	public function create_thread($data = array()) {
		$insert = $this->db->insert('forum', $data);
		if($insert){
			return $this->db->insert_id();
		}else{
			return false;
		}
	}

	public function add_data($data = array()) {
		$insert = $this->db->insert('forum_data', $data);
		if($insert){
			return $this->db->insert_id();
		}else{
			return false;
		}
	}

	public function getuser($id = "")
	{
			$query = $this->db->get('users');
			return $query->result_array();
	}

	public function getforum($id = "")
	{
		if(!empty($id)){
			$query = $this->db->get_where('forum', array('id' => $id));
			return $query->row_array();
		}else{
			$query = $this->db->get_where('forum', array('approved' => '1'));
			return $query->result_array();
		}
	}

	public function getinfo()
	{
			$query = $this->db->get('forum_data');
			return $query->result_array();
	}

	public function info($id)
	{
			$query = $this->db->get_where('forum_data', array('thread_id' => $id));
			return $query->result_array();
	}

	public function update_thread($data, $id)
    {
         $update = $this->db->update('forum', $data, array('id'=>$id));
            return $update?true:false;
    }

}
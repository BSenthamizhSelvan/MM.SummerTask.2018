<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class api_model extends CI_Model{


	public function getRows($id = ""){
        if(!empty($id)){
            $query = $this->db->get_where('articles', array('id' => $id));
            return $query->row_array();
        }else{
            $query = $this->db->get('articles');
            return $query->result_array();
        }
    }

    public function editors_pick()
	{
		$this->db->order_by('views', 'DESC');
		$query = $this->db->limit(1)->get('articles');
		return $query->row_array();
	}

	public function getpoll(){

		$query = $this->db->get_where('poll', array('id' => '1'));
		return $query->row_array();
	}

}
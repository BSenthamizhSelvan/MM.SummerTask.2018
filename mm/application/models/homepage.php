<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends CI_Model{

	public function editors_pick()
	{
		$this->db->order_by('views', 'DESC');
		$query = $this->db->limit(1)->get('articles');
		return $query->row_array();
	}

	public function latest_articles()
	{
		$this->db->order_by('date', 'DESC');
		$query = $this->db->get('articles');
		return $query->result_array();
	}

	public function getrow($id = ""){

		$query = $this->db->get_where('articles', array('id' => $id));
		return $query->row_array();
	}
}
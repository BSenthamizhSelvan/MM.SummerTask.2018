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

	public function getpoll(){

		$query = $this->db->get_where('poll', array('id' => '1'));
		return $query->row_array();
	}

	 public function user_update($data, $id)
    {
         $update = $this->db->update('users', $data, array('id'=>$id));
            return $update?true:false;
    }

    public function getuser($id = "")
    {
        if(!empty($id)){
            $query = $this->db->get_where('users', array('id' => $id));
            return $query->row_array();
        }else{
            $query = $this->db->get('users');
            return $query->result_array();
        }
    }

    public function article_update($data, $id)
    {
         $update = $this->db->update('articles', $data, array('id'=>$id));
            return $update?true:false;
    }

    public function update_poll($data) 
    {
        if(!empty($data)){
            $update = $this->db->update('poll', $data, array('id'=>'1'));
            return $update?true:false;
        }else{
            return false;
        }
    }

    public function insert_comment($data = array()) {
        $insert = $this->db->insert('article_comments', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

    public function get_comments($id)
    {
            $query = $this->db->get_where('article_comments', array('article_id','approved' => $id,'1'));
            return $query->result_array();
    }

    public function create_question($data = array()) {
        $insert = $this->db->insert('question', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

    public function update_question($data, $id)
    {
         $update = $this->db->update('question', $data, array('id'=>$id));
            return $update?true:false;
    }

    public function get_question($id)
    {
            $query = $this->db->get_where('question', array('id' => $id));
            return $query->row_array();
    }

}
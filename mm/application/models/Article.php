<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends CI_Model{

	//For get posts

	public function getRows($id = ""){
        if(!empty($id)){
            $query = $this->db->get_where('articles', array('id' => $id));
            return $query->row_array();
        }else{
            $query = $this->db->get('articles');
            return $query->result_array();
        }
    }

    //insert posts

    public function insert($data = array()) {
        $insert = $this->db->insert('article', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
    
    // update posts

    public function update($data, $id) {
        if(!empty($data) && !empty($id)){
            $update = $this->db->update('article', $data, array('id'=>$id));
            return $update?true:false;
        }else{
            return false;
        }
    }

	// delete posts    

    public function delete($id){
        $delete = $this->db->delete('article',array('id'=>$id));
        return $delete?true:false;
    }

}
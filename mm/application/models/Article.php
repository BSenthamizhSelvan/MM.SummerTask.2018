<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Model{


	public function getRows($id = ""){
        if(!empty($id)){
            $query = $this->db->get_where('articles', array('id' => $id));
            return $query->row_array();
        }else{
            $query = $this->db->get('articles');
            return $query->result_array();
        }
    }


    public function insert($data = array()) {
        $insert = $this->db->insert('articles', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
    

    public function update($data, $id) {
        if(!empty($data) && !empty($id)){
            $update = $this->db->update('articles', $data, array('id'=>$id));
            return $update?true:false;
        }else{
            return false;
        }
    }
  

    public function delete($id){
        $delete = $this->db->delete('articles',array('id'=>$id));
        return $delete?true:false;
    }

}
<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends CI_Model{

    public function update($data, $id) 
    {
        if(!empty($data) && !empty($id)){
            $update = $this->db->update('poll', $data, array('id'=>$id));
            return $update?true:false;
        }else{
            return false;
        }
    }

    public function getpoll($id)
    {
        $query = $this->db->get_where('poll', array('id' => $id));
        return $query->row_array();
    }

    public function getusers($id = "")
    {
        if(!empty($id)){
            $query = $this->db->get_where('users', array('id' => $id));
            return $query->row_array();
        }else{
            $query = $this->db->get('users');
            return $query->result_array();
        }
    }

    public function del_user($id)
    {
        $delete = $this->db->delete('users',array('id'=>$id));
        return $delete?true:false;
    }

    public function user_update($data, $id)
    {
         $update = $this->db->update('users', $data, array('id'=>$id));
            return $update?true:false;
    }

}
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

    public function getarticle($id = "")
    {
        if(!empty($id))
        {
            $query = $this->db->get_where('articles', array('id' => $id));
            return $query->row_array();
        }
        else
        {
            $query = $this->db->get('articles');
            return $query->result_array();
        }
    }

    public function getcomments($id = "")
    {   
        if(empty($id))
        {
            $query = $this->db->get_where('article_comments', array('approved' => '0'));
            return $query->result_array();  
        }
        else
        {
            $query = $this->db->get_where('article_comments', array('id' => $id));
            return $query->row_array();
        }
    }

    public function comment_update($data, $id)
    {
         $update = $this->db->update('article_comments', $data, array('id'=>$id));
            return $update?true:false;
    }

    public function del_comment($id)
    {
        $delete = $this->db->delete('article_comments',array('id'=>$id));
        return $delete?true:false;
    }

    public function getquestion($id = "")
    {   
        if(empty($id))
        {
            $query = $this->db->get_where('question', array('approved' => '0'));
            return $query->result_array(); 
        }
            else
        {
            $query = $this->db->get_where('question', array('id' => $id));
            return $query->row_array();
        }
    } 

    public function questionupdate($data, $id)
    {
         $update = $this->db->update('question', $data, array('id'=>$id));
            return $update?true:false;
    }

    public function delquestion($id)
    {
        $delete = $this->db->delete('question',array('id'=>$id));
        return $delete?true:false;
    }

    public function getquestion_final($id = "")
    {   
        if(empty($id))
        {
            $query = $this->db->get_where('question', array('approved' => '1'));
            return $query->result_array(); 
        }
            else
        {
            $query = $this->db->get_where('question', array('id' => $id));
            return $query->row_array();
        }
    } 
    
    public function getthread($id = "")
    {   
        if(empty($id))
        {
            $query = $this->db->get_where('forum', array('approved' => '0'));
            return $query->result_array();  
        }
        else
        {
            $query = $this->db->get_where('forum', array('id' => $id));
            return $query->row_array();
        }
    }

    public function getinfo($id = "")
    {   
        if(empty($id))
        {
            $this->db->distinct('thread_id');
            $query = $this->db->get_where('forum_data', array('approved' => '0'));
            return $query->result_array();  
        }
        else
        {
            $query = $this->db->get_where('forum_data', array('id' => $id));
            return $query->row_array();
        }
    }

    public function forumupdate($data, $id)
    {
         $update = $this->db->update('forum', $data, array('id'=>$id));
            return $update?true:false;
    }

    public function delforum($id)
    {
        $delete = $this->db->delete('forum',array('id'=>$id));
        return $delete?true:false;
    }

     public function get_thread()
    {   
            $query = $this->db->get('forum');
            return $query->result_array();  
    }

    public function replyupdate($data, $id)
    {
         $update = $this->db->update('forum_data', $data, array('id'=>$id));
            return $update?true:false;
    }

    public function delreply($id)
    {
        $delete = $this->db->delete('forum_data',array('id'=>$id));
        return $delete?true:false;
    }

    public function count($id)
    {
        $query = $this->db->get_where('forum_data', array('thread_id','approved' => $id,'1'));
        return $query->num_rows();
    }

}
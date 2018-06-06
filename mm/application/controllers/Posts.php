<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('post');
	}

	public function index(){
		$data = array();

        //get messages from the session
		if($this->session->userdata('success_msg')){
			$data['success_msg'] = $this->session->userdata('success_msg');
			$this->session->unset_userdata('success_msg');
		}
		if($this->session->userdata('error_msg')){
			$data['error_msg'] = $this->session->userdata('error_msg');
			$this->session->unset_userdata('error_msg');
		}
		$data['posts'] = $this->post->getRows();
        $data['title'] = 'Post Archive';
        $this->load->view('templates/header', $data);
        $this->load->view('posts/index', $data);
        $this->load->view('templates/footer');
    }

    	//post details

    public function view($id){
        $data = array();
        
        //check whether post id is not empty
        if(!empty($id)){
            $data['post'] = $this->post->getRows($id);
            $data['title'] = $data['post']['title'];
            
            //load the details page view
            $this->load->view('templates/header', $data);
            $this->load->view('posts/view', $data);
            $this->load->view('templates/footer');
        }else{
            redirect('/posts');
        }
    }


    //add new post

    public function add(){
        $data = array();
        $postData = array();
        
        //if add request is submitted
        if($this->input->post('postSubmit')){
            //form field validation rules
            $this->form_validation->set_rules('title', 'post title', 'required');
            $this->form_validation->set_rules('content', 'post content', 'required');
            
            //prepare post data
            $postData = array(
                'title' => $this->input->post('title'),
                'content' => $this->input->post('content')
            );
            
            //validate submitted form data
            if($this->form_validation->run() == true){
                //insert post data
                $insert = $this->post->insert($postData);

                if($insert){
                    $this->session->set_userdata('success_msg', 'Post has been added successfully.');
                    redirect('/posts');
                }else{
                    $data['error_msg'] = 'Some problems occurred, please try again.';
                }
            }
        }
        
        $data['post'] = $postData;
        $data['title'] = 'Create Post';
        $data['action'] = 'Add';
        
        //load the add page view
        $this->load->view('templates/header', $data);
        $this->load->view('posts/add-edit', $data);
        $this->load->view('templates/footer');
    }

    //updating post content

    public function edit($id){
        $data = array();
        
        //get post data
        $postData = $this->post->getRows($id);
        
        //if update request is submitted
        if($this->input->post('postSubmit')){
            //form field validation rules
            $this->form_validation->set_rules('title', 'post title', 'required');
            $this->form_validation->set_rules('content', 'post content', 'required');
            
            //prepare cms page data
            $postData = array(
                'title' => $this->input->post('title'),
                'content' => $this->input->post('content')
            );
            
            //validate submitted form data
            if($this->form_validation->run() == true){
                //update post data
                $update = $this->post->update($postData, $id);

                if($update){
                    $this->session->set_userdata('success_msg', 'Post has been updated successfully.');
                    redirect('/posts');
                }else{
                    $data['error_msg'] = 'Some problems occurred, please try again.';
                }
            }
        }

        
        $data['post'] = $postData;
        $data['title'] = 'Update Post';
        $data['action'] = 'Edit';
        
        $this->load->view('templates/header', $data);
        $this->load->view('posts/add-edit', $data);
        $this->load->view('templates/footer');
    }
    

    //delete posts

    public function delete($id){
        //check whether post id is not empty
        if($id){
            //delete post
            $delete = $this->post->delete($id);
            
            if($delete){
                $this->session->set_userdata('success_msg', 'Post has been removed successfully.');
            }else{
                $this->session->set_userdata('error_msg', 'Some problems occurred, please try again.');
            }
        }

        redirect('/posts');
    }
}
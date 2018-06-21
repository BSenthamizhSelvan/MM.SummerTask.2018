<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Articles extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('article');
	}

	public function index() {
		$data = array();

        if (!($this->session->userdata('isloggedin'))) {
            redirect(site_url('users/login'));
        } elseif (!$this->session->userdata('privilege')) {
            redirect(site_url('home'));
        } else {
            $data['userid'] = $this->session->userdata('userid');
        }

        if($this->session->userdata('success_msg')){
           $data['success_msg'] = $this->session->userdata('success_msg');
           $this->session->unset_userdata('success_msg');
       }
       if($this->session->userdata('error_msg')){
           $data['error_msg'] = $this->session->userdata('error_msg');
           $this->session->unset_userdata('error_msg');
       }

       $data['article'] = $this->article->getRows();
       $data['title'] = 'Article Archive';



       $this->load->view('admin_common/head', $data);
       $this->load->view('admin_common/header', $data);
       $this->load->view('articles/article_index', $data);
       $this->load->view('admin_common/footer');
   }


   public function view($id){
    $data = array();

    if (!($this->session->userdata('isloggedin'))) {
        redirect(site_url('users/login'));
    } elseif (!$this->session->userdata('privilege')) {
        redirect(site_url('home'));
    } else {
        $data['userid'] = $this->session->userdata('userid');
    }

    if(!empty($id)){
        $data['article'] = $this->article->getRows($id);
        $data['title'] = $data['article']['title'];

        
        $this->load->view('admin_common/head', $data);
        $this->load->view('admin_common/header', $data);
        $this->load->view('articles/view_article', $data);
        $this->load->view('admin_common/footer');
    }else{
        redirect('/articles'); 
    }
}



public function add(){
    $data = array();
    $articleData = array();

    if (!($this->session->userdata('isloggedin'))) {
        redirect(site_url('users/login'));
    } elseif (!$this->session->userdata('privilege')) {
        redirect(site_url('home'));
    } else {
        $data['userid'] = $this->session->userdata('userid');
    }

    if($this->input->post('submit')){

        $this->form_validation->set_rules('title', 'Article title', 'required');
        $this->form_validation->set_rules('content', 'Article content', 'required');
        $this->form_validation->set_rules('summary', 'Article summary', 'required');
        $this->form_validation->set_rules('ctg', 'Category', 'required');
        $this->form_validation->set_rules('reptr_name', 'Reporter Name', 'required');

        if(!empty($_FILES['picture']['name'])){
            $config['upload_path'] = 'assets/img/uploads';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['picture']['name'];

            $this->load->library('upload',$config);
            $this->upload->initialize($config);

            if($this->upload->do_upload('picture')){
                $uploadData = $this->upload->data();
                $picture = $uploadData['file_name'];
            }else{
                $picture = '';
            }
        }else{
            $picture = '';
        }

        $articleData = array(
            'title' => $this->input->post('title'),
            'content' => $this->input->post('content'),
            'summary' => $this->input->post('summary'),
            'date' => date('Y-m-d'),
            'ctg' => $this->input->post('ctg'),
            'reptr_name' => $this->input->post('reptr_name'),
            'modified' => date('Y-m-d H:i:s'),
            'user_id' => $this->session->userdata('userid'),
            'img' => $picture

        );

        if($this->form_validation->run() == true){

            $insert = $this->article->insert($articleData);

            if($insert){
                $this->session->set_userdata('success_msg', 'Post has been added successfully.');
                redirect('/articles');
            }else{
                $data['error_msg'] = 'Some problems occurred, please try again.';
            }
        }
    }

    $data['post'] = $articleData;
    $data['title'] = 'New Article';
    $data['action'] = 'Add';

    $this->load->view('admin_common/head', $data);
    $this->load->view('admin_common/header', $data);
    $this->load->view('articles/add_edit_article', $data);
    $this->load->view('admin_common/footer');
}

public function edit($id){
    $data = array();

    if (!($this->session->userdata('isloggedin'))) {
        redirect(site_url('users/login'));
    } elseif (!$this->session->userdata('privilege')) {
        redirect(site_url('home'));
    } else {
        $data['userid'] = $this->session->userdata('userid');
    }

    $articleData = $this->article->getRows($id);


    if($this->input->post('submit')){

        $this->form_validation->set_rules('title', 'Article title', 'required');
        $this->form_validation->set_rules('content', 'Article content', 'required');
        $this->form_validation->set_rules('summary', 'Article summary', 'required');
        $this->form_validation->set_rules('ctg', 'Category', 'required');
        $this->form_validation->set_rules('reptr_name', 'Reporter Name', 'required');

        if(!empty($_FILES['picture']['name'])){
            $config['upload_path'] = 'assets/img/uploads';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['picture']['name'];

            $this->load->library('upload',$config);
            $this->upload->initialize($config);

            if($this->upload->do_upload('picture')){
                $uploadData = $this->upload->data();
                $picture = $uploadData['file_name'];
            }else{
                $picture = '';
            }
        }else{
            $picture = '';
        }

        $articleData = array(
            'title' => $this->input->post('title'),
            'content' => $this->input->post('content'),
            'summary' => $this->input->post('summary'),
            'date' => date('Y-m-d'),
            'ctg' => $this->input->post('ctg'),
            'reptr_name' => $this->input->post('reptr_name'),
            'modified' => date('Y-m-d H:i:s'),
            'user_id' => $this->session->userdata('userid'),
            'img' => $picture

        );

        if($this->form_validation->run() == true){

            $update = $this->article->update($articleData, $id);

            if($update){
                $this->session->set_userdata('success_msg', 'Post has been updated successfully.');
                redirect('/articles');
            }else{
                $data['error_msg'] = 'Some problems occurred, please try again.';
            }
        }
    }


    $data['article'] = $articleData;
    $data['title'] = 'Edit Article';
    $data['action'] = 'Edit';

    $this->load->view('admin_common/head', $data);
    $this->load->view('admin_common/header', $data);
    $this->load->view('articles/add_edit_article', $data);
    $this->load->view('admin_common/footer');
}




public function delete($id){

    if($id){

        $delete = $this->article->delete($id);

        if($delete){
            $this->session->set_userdata('success_msg', 'Post has been removed successfully.');
        }else{
            $this->session->set_userdata('error_msg', 'Some problems occurred, please try again.');
        }
    }

    redirect('/articles');


}
}
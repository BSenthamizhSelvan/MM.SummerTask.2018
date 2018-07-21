<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class api extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('api_model');
	}

	public function getpost()
	{
		$value=$this->uri->segment(3);
		$article=$this->api_model->getRows($value);		
		$return = new stdClass();
		if($article){
			$return->success=true;
			$return->data=$article;	
		} else {
			$return->success=false;
			$return->error_log='Incorrect keyword/No date found';
		}
		$data['articles']=json_encode($return);
		$this->load->view('api',$data);
	}

	public function getposts()
	{
		$article=$this->api_model->getRows();		
		$return = new stdClass();
		if($article){
			$return->success=true;
			$return->data=$article;	
		} else {
			$return->success=false;
			$return->error_log='Incorrect keyword/No date found';
		}
		$data['articles']=json_encode($return);
		$this->load->view('api',$data);
	}

	public function editorspick()
	{
		$article=$this->api_model->editors_pick();		
		$return = new stdClass();
		if($article){
			$return->success=true;
			$return->data=$article;	
		} else {
			$return->success=false;
			$return->error_log='Incorrect keyword/No date found';
		}
		$data['articles']=json_encode($return);
		$this->load->view('api',$data);
	}

	public function getpoll()
	{
		$article=$this->api_model->getpoll();		
		$return = new stdClass();
		if($article){
			$return->success=true;
			$return->data=$article;	
		} else {
			$return->success=false;
			$return->error_log='Incorrect keyword/No date found';
		}
		$data['articles']=json_encode($return);
		$this->load->view('api',$data);
	}

}
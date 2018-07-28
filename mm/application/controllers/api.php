<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class api extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('article');
		$this->load->model('homepage');
		$this->load->model('user');
		$this->load->model('admin');
	}

	public function getpost()
	{
		$value=$this->uri->segment(3);
		$article=$this->article->getRows($value);		
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
		$article=$this->article->getRows();		
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
		$article=$this->homepage->editors_pick();		
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
		$article=$this->homepage->getpoll();		
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

	public function getcomments()
	{
		$value=$this->uri->segment(4);
		$article=$this->homepage->get_comments($value);		
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

	public function signin(){
		$username=$this->input->post('username',TRUE);	
		$password=$this->input->post('password',TRUE);
		$return = new stdClass();
		$con['returnType'] = 'single';
		$con['conditions'] = array(
			'username'=>strip_tags($this->input->post('username')),
			'password' => md5($this->input->post('password'))
		);
		
		if($user=$this->user->getRows($con))
		{
			$return->success=true;
			$return->data=$user;	

		} else {
			$return->success=false;
			$return->error_log='Incorrect keyword/No date found';
		}
		$data['articles']=json_encode($return);
		$this->load->view('api',$data);

	}

	public function register(){
		$return = new stdClass();
		$con['returnType'] = 'single';
		$con['conditions'] = array(
			'username'=>strip_tags($this->input->post('username')),
			'password' => md5($this->input->post('password')),
			'email' => $this->input->post('email')
		);
		
		if($user=$this->user->getRows($con))
		{
			$return->success=true;
			$return->data=$user;	

		} else {
			$return->success=false;
			$return->error_log='Incorrect keyword/No date found';
		}
		$data['articles']=json_encode($return);
		$this->load->view('api',$data);

	}

	public function submitpoll(){
		$poll=$this->homepage->getpoll();
		$option=$this->input->post('poll',TRUE);
		if ($option=='1') {
			++$poll['count1'];
		} elseif ($option=='2') {
			++$poll['count2'];
		} elseif ($option=='3') {
			++$poll['count3'];
		}		

		$return = new stdClass();
		if($this->homepage->update_poll($poll)){
			$poll=$this->homepage->getpoll();
			$return->success=true;
			$return->data=$poll;			
		} else {
			$return->success=false;
		}
		$data['articles']=json_encode($return);
		$this->load->view('api',$data);
	}

	public function submitcomment(){
		$comment=$this->input->post('comment',TRUE);	
		$article_id=$this->input->post('article_id',TRUE);
		$user_id=$this->input->post('user_id',TRUE);
		$privilege=$this->input->post('privilege',TRUE);
		$privilege=$this->input->post('privilege');
		$return = new stdClass();

		if ($privilege) {

			$comment = array(
				'content' => $this->input->post('comment'),
				'article_id' => $this->input->post('article_id'),
				'user_id' => $this->input->post('user_id'),
				'date' => date('Y-m-d H:i:s'),
				'approved' => '1'
			);

		} else {

			$comment = array(
				'content' => $this->input->post('comment'),
				'article_id' => $this->input->post('article_id'),
				'user_id' => $this->input->post('user_id'),
				'date' => date('Y-m-d H:i:s'),
				'approved' => '0'
			);
		}
		
		if($insert=$this->homepage->insert_comment($comment))
		{
			$return->success=true;
			$return->data=$comment;	

		} else {
			$return->success=false;
			$return->error_log='Incorrect keyword/No date found';
		}
		$data['articles']=json_encode($return);
		$this->load->view('api',$data);

	}

	public function question(){
		$question=$this->input->post('question',TRUE);	
		$person=$this->input->post('person',TRUE);

		$question = array(
			'question' => $this->input->post('question'),
			'person' => $this->input->post('person')
		);

		$return = new stdClass();
		if($this->homepage->create_question($question)){
			$return->success=true;
			$return->data=$question;			
		} else {
			$return->success=false;
		}
		$data['articles']=json_encode($return);
		$this->load->view('api',$data);
	}

	public function search()
	{
		$value=$this->uri->segment(3);
		$article=$this->homepage->search($value);		
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
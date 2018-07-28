<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class forum extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('forum_model');
	}

	public function index()
	{
		$data = array();

		if($this->session->userdata('success_msg')){
			$data['success_msg'] = $this->session->userdata('success_msg');
			$this->session->unset_userdata('success_msg');
		}
		if($this->session->userdata('error_msg')){
			$data['error_msg'] = $this->session->userdata('error_msg');
			$this->session->unset_userdata('error_msg');
		}

		if($this->input->post('check'))
		{
			$this->form_validation->set_rules('search', 'Search', 'required');
			$search=$this->input->post('search');
			redirect('home/search/'.$search);

		}

		$data['forum'] = $this->forum_model->getforum();
		$data['user'] = $this->forum_model->getuser();
		$data['title'] = 'Forum';

		$this->load->view('common/head',$data);
		$this->load->view('css/forum',$data);
		$this->load->view('common/header',$data);
		$this->load->view('forum/forum',$data);
		$this->load->view('common/footer');

	}

	public function new_thread()
	{

		$data = array();
		$thread = array();

		if($this->input->post('check'))
		{
			$this->form_validation->set_rules('search', 'Search', 'required');
			$search=$this->input->post('search');
			redirect('home/search/'.$search);

		}

		if($this->input->post('submit'))
		{
			$this->form_validation->set_rules('topic', 'Topic', 'required');
			$this->form_validation->set_rules('content', 'Descripition', 'required');

			if ($this->session->userdata('privilege')) {

				$thread = array(
					'topic' => $this->input->post('topic'),
					'content' => $this->input->post('content'),
					'user_created' =>  $this->session->userdata('userid'),
					'created_date' => date('Y-m-d H:i:s'),
					'last_id' =>  $this->session->userdata('userid'),
					'last_date' => date('Y-m-d H:i:s'),
					'approved' => '1'
				);

			} else {

				$thread = array(
					'topic' => $this->input->post('topic'),
					'content' => $this->input->post('content'),
					'user_created' =>  $this->session->userdata('userid'),
					'created_date' => date('Y-m-d H:i:s'),
					'last_id' =>  $this->session->userdata('userid'),
					'last_date' => date('Y-m-d H:i:s')
				);
			}
			if($this->form_validation->run() == true)
			{

				$insert = $this->forum_model->create_thread($thread);		

				if($insert){
					if ($this->session->userdata('privilege')) {

						$this->session->set_userdata('success_msg', 'New thread added');

					} else {

						$this->session->set_userdata('success_msg', 'Your Thread is awaiting moderation');
					}
					redirect('forum');
				}else{
					$data['error_msg'] = 'Some problems occurred, please try again.';
				}

			}
		}

		$data['title'] = 'New Thread';

		$this->load->view('common/head',$data);
		$this->load->view('css/forum',$data);
		$this->load->view('common/header',$data);
		$this->load->view('forum/new',$data);
		$this->load->view('common/footer');

	}

	public function view($id)
	{
		$data = array();
		$thread = $this->forum_model->getforum($id);
		$info = $this->forum_model->info($id);

		if($this->input->post('check'))
		{
			$this->form_validation->set_rules('search', 'Search', 'required');
			$search=$this->input->post('search');
			redirect('home/search/'.$search);

		}

		if($this->session->userdata('success_msg')){
			$data['success_msg'] = $this->session->userdata('success_msg');
			$this->session->unset_userdata('success_msg');
		}
		if($this->session->userdata('error_msg')){
			$data['error_msg'] = $this->session->userdata('error_msg');
			$this->session->unset_userdata('error_msg');
		}

		++$thread['views'];
		$this->forum_model->update_thread($thread, $id);

		if($this->input->post('submit'))
		{
			$this->form_validation->set_rules('content', 'Reply', 'required');

			if ($this->session->userdata('privilege')) {

				$reply = array(
					'content' => $this->input->post('content'),
					'user_id' =>  $this->session->userdata('userid'),
					'thread_id' => $id,
					'date' => date('Y-m-d H:i:s'),
					'approved' => '1'
				);

			} else {

				$reply = array(
					'content' => $this->input->post('content'),
					'user_id' =>  $this->session->userdata('userid'),
					'thread_id' => $id,
					'date' => date('Y-m-d H:i:s')
				);

			}

			if($this->form_validation->run() == true)
			{

				$insert = $this->forum_model->add_data($reply);
				if($insert){

					$thread['views']=$thread['views']-'2';
					$this->forum_model->update_thread($thread, $id);

					if ($this->session->userdata('privilege')) {

						$this->session->set_userdata('success_msg', 'Reply Submitted');

						$reply=$thread['replies'] + '1';

						$thread = array(
							'last_id' =>  $this->session->userdata('userid'),
							'last_date' => date('Y-m-d H:i:s'),
							'replies' => $reply
						);

						$this->forum_model->update_thread($thread, $id);

					} else {

						$this->session->set_userdata('success_msg', 'Your Reply is awaiting moderation');
					}
					redirect('forum/view/'.$id);
				}else{
					$data['error_msg'] = 'Some problems occurred, please try again.';
				}

			}
		}

		$data['forum'] = $thread;
		$data['user'] = $this->forum_model->getuser();
		$data['info'] = $info;
		$data['title'] = 'Forum';

		$this->load->view('common/head',$data);
		$this->load->view('css/forum',$data);
		$this->load->view('common/header',$data);
		$this->load->view('forum/view',$data);
		$this->load->view('common/footer');

	}

}
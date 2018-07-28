<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('homepage');
	}

	public function index()
	{
		$data = array();
		$poll=$this->homepage->getpoll();

		if($this->session->userdata('success_msg')){
			$data['success_msg'] = $this->session->userdata('success_msg');
			$this->session->unset_userdata('success_msg');
		}
		if($this->session->userdata('error_msg')){
			$data['error_msg'] = $this->session->userdata('error_msg');
			$this->session->unset_userdata('error_msg');
		}

		$this->session->unset_userdata('question');

		if($this->input->post('check'))
		{
			$this->form_validation->set_rules('search', 'Search', 'required');
			$search=$this->input->post('search');
			redirect('home/search/'.$search);

		}

		$data['articles']=$this->homepage->latest_articles();
		$data['pick']=$this->homepage->editors_pick();
		$data['title'] = 'The news as it should be';

		$total=$poll['count1']+$poll['count2']+$poll['count3'];
		$data['a']=$poll['count1']*'100'/$total;
		$data['b']=$poll['count2']*'100'/$total;
		$data['c']=$poll['count3']*'100'/$total;

		$userdata=$this->homepage->getuser($this->session->userdata('userid'));

		if ($this->session->userdata('isloggedin')) 
		{
			if(!$userdata['vote'])
			{
				if ($this->input->post('submit')) 
				{
					$this->form_validation->set_rules('poll', 'poll', 'required');

					$option=$this->input->post('poll');

					if($this->form_validation->run() == true){


						$userdata['vote']='1';
						$this->homepage->user_update($userdata,$this->session->userdata('userid'));

						if ($option=='1') {
							++$poll['count1'];
						} elseif ($option=='2') {
							++$poll['count2'];
						} elseif ($option=='3') {
							++$poll['count3'];
						}

						$this->homepage->update_poll($poll);

						redirect('');
					}
					else{
						$data['error_msg'] = 'No option Selected';
					}
				}
				$data['poll']=$poll;

				$this->load->view('common/head',$data);
				$this->load->view('common/header',$data);
				$this->load->view('homesite/editors_pick',$data);
				$this->load->view('homesite/poll',$data);
				$this->load->view('homesite/latest_articles',$data);
				$this->load->view('common/footer');
			}

		}		

		$data['poll']=$poll;

		$this->load->view('common/head',$data);
		$this->load->view('common/header',$data);
		$this->load->view('homesite/editors_pick',$data);
		$this->load->view('homesite/poll_result',$data);
		$this->load->view('homesite/latest_articles',$data);
		$this->load->view('common/footer');
	}

	public function article($id)
	{
		$data = array();
		$comment = array();

		if($this->session->userdata('success_msg')){
			$data['success_msg'] = $this->session->userdata('success_msg');
			$this->session->unset_userdata('success_msg');
		}
		if($this->session->userdata('error_msg')){
			$data['error_msg'] = $this->session->userdata('error_msg');
			$this->session->unset_userdata('error_msg');
		}

		$this->session->unset_userdata('question');

		$select=$this->homepage->getrow($id);

		if($this->input->post('check'))
		{
			$this->form_validation->set_rules('search', 'Search', 'required');
			$search=$this->input->post('search');
			redirect('home/search/'.$search);

		}


		if (!$this->session->userdata('$id')) 
		{
			$this->session->set_userdata('$id',TRUE);
			++$select['views'];
			$this->homepage->article_update($select, $id);
		}

		if($this->input->post('submit'))
		{
			$this->form_validation->set_rules('comment', 'Comment', 'required');

			if ($this->session->userdata('privilege')) {
				
				$comment = array(
					'content' => $this->input->post('comment'),
					'article_id' => $id,
					'user_id' => $this->session->userdata('userid'),
					'date' => date('Y-m-d H:i:s'),
					'approved' => '1'
				);

			} else {

				$comment = array(
					'content' => $this->input->post('comment'),
					'article_id' => $id,
					'user_id' => $this->session->userdata('userid'),
					'date' => date('Y-m-d H:i:s'),
					'approved' => '0'
				);

			}

			if($this->form_validation->run() == true)
			{

				$insert = $this->homepage->insert_comment($comment);
				if($insert){
					if ($this->session->userdata('privilege')) {

						$this->session->set_userdata('success_msg', 'Comment has been added successfully.');

					} else {

						$this->session->set_userdata('success_msg', 'Your comment is awaiting moderation');
					}
					redirect('home/article/'.$id);
				}else{
					$data['error_msg'] = 'Some problems occurred, please try again.';
				}

			}
		}


		$data['comments']=$this->homepage->get_comments($id);
		$data['users']=$this->homepage->getuser();
		$data['articles']=$this->homepage->latest_articles();
		$data['select']=$select;
		$data['title'] = $data['select']['title'];

		$this->load->view('common/head',$data);
		$this->load->view('css/view',$data);
		$this->load->view('common/header',$data);
		$this->load->view('homesite/view_article',$data);
		$this->load->view('homesite/comments',$data);
		$this->load->view('homesite/latest_articles',$data);
		$this->load->view('common/footer');
	}

	public function search($search)
	{
		$data = array();
		$question = array();

		if($this->input->post('check'))
		{
			$this->form_validation->set_rules('search', 'Search', 'required');
			$search=$this->input->post('search');
			redirect('home/search/'.$search);

		}


		$data['articles']=$this->homepage->latest_articles();
		$data['check']= $search;
		$data['search'] = $this->homepage->search($search);

		$data['title'] = $search;
		$this->load->view('common/head',$data);
		$this->load->view('css/view',$data);
		$this->load->view('common/header',$data);
		$this->load->view('homesite/search',$data);
		$this->load->view('homesite/latest_articles',$data);
		$this->load->view('common/footer');
	}

	public function category($ctg)
	{
		$data = array();
		$question = array();

		$data['articles']=$this->homepage->latest_articles();
		$data['category'] = $this->homepage->getctg($ctg);

		if($this->input->post('check'))
		{
			$this->form_validation->set_rules('search', 'Search', 'required');
			$search=$this->input->post('search');
			redirect('home/search/'.$search);

		}

		$data['title'] = $ctg;
		$data['ctg'] = $ctg;

		$this->load->view('common/head',$data);
		$this->load->view('css/view',$data);
		$this->load->view('common/header',$data);
		$this->load->view('homesite/ctg',$data);
		$this->load->view('homesite/latest_articles',$data);
		$this->load->view('common/footer');
	}

	public function question()
	{
		$data = array();
		$question = array();

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

		if ($this->session->userdata('question')) 
		{

			$question = $this->homepage->get_question($this->session->userdata('question'));

			if($this->input->post('submit'))
			{
				$this->form_validation->set_rules('question', 'Question', 'required');
				$this->form_validation->set_rules('person', 'Person', 'required');

				$question = array(
					'question' => $this->input->post('question'),
					'person' => $this->input->post('person')
				);

				if($this->form_validation->run() == true)
				{

					$insert = $this->homepage->update_question($question,$this->session->userdata('question'));
					if($insert){
						$this->session->set_userdata('success_msg', 'Question has been updated successfully!!');
						redirect('home/question');
					}else{
						$data['error_msg'] = 'Some problems occurred, please try again.';
					}

				}
			}
		} 
		else 
		{
			if($this->input->post('submit'))
			{
				$this->form_validation->set_rules('question', 'Question', 'required');
				$this->form_validation->set_rules('person', 'Person', 'required');

				$question = array(
					'question' => $this->input->post('question'),
					'person' => $this->input->post('person')
				);

				if($this->form_validation->run() == true)
				{

					$insert = $this->homepage->create_question($question);
					$this->session->set_userdata('question',$insert);
					if($insert){
						$this->session->set_userdata('success_msg', 'Question has been submitted successfully!!');
						redirect('home/question');
					}else{
						$data['error_msg'] = 'Some problems occurred, please try again.';
					}

				}
			}
		}

		$data['title'] = 'Ask A Question';
		$data['question'] = $question;

		$this->load->view('common/head',$data);
		$this->load->view('css/view',$data);
		$this->load->view('common/header',$data);
		$this->load->view('homesite/question',$data);
		$this->load->view('common/footer');
	}

}

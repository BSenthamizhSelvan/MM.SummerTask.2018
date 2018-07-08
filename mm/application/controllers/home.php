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
		
		$data['poll']=$this->homepage->getpoll();
		$data['articles']=$this->homepage->latest_articles();
		$data['pick']=$this->homepage->editors_pick();
		$data['title'] = 'The news as it should be';

		$this->load->view('common/head',$data);
		$this->load->view('common/header',$data);
		$this->load->view('homesite/editors_pick',$data);
		$this->load->view('homesite/poll',$data);
		$this->load->view('homesite/latest_articles',$data);
		$this->load->view('common/footer');
	}
	
	public function article($id)
	{
		$data = array();
		
		$select=$this->homepage->getrow($id);
		

		if (!$this->session->userdata('$id')) 
		{
			$this->session->set_userdata('$id',TRUE);
			++$select['views'];
			$this->homepage->article_update($select, $id);
		}

		$data['articles']=$this->homepage->latest_articles();
		$data['select']=$select;
		$data['title'] = $data['select']['title'];

		$this->load->view('common/head',$data);
		$this->load->view('common/header',$data);
		$this->load->view('homesite/view_article',$data);
		$this->load->view('homesite/latest_articles',$data);
		$this->load->view('common/footer');
	}

	public function pool()
	{
		$data['poll']=$this->homepage->getpoll();

		if($this->input->post('submit'))
		{
			$this->form_validation->set_rules('poll', 'poll', 'required');

			$option=$this->input->post('poll');

			if($this->form_validation->run() == true){

				$userdata=$this->homepage->getuser($this->session->userdata('userid'));
				$userdata['vote']='1';
				$this->homepage->user_update($userdata,$this->session->userdata('userid'));
				
				if ($option=='1') {
					++$data['poll']['count1'];
				} elseif ($option=='2') {
					++$data['poll']['count2'];
				} elseif ($option=='3') {
					++$data['poll']['count3'];
				}
			}
		}
	}

}

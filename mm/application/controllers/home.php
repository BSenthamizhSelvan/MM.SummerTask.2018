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
		$data['articles']=$this->homepage->latest_articles();
		$data['pick']=$this->homepage->editors_pick();
		$data['title'] = 'The news as it should be';

		$this->load->view('common/head',$data);
		$this->load->view('common/header',$data);
		$this->load->view('homesite/editors_pick',$data);
		$this->load->view('homesite/pool',$data);
		$this->load->view('homesite/latest_articles',$data);
		$this->load->view('common/footer');
	}
	
	public function article($id)
	{
		$data = array();
		$data['articles']=$this->homepage->latest_articles();
		$data['select']=$this->homepage->getrow($id);
		$data['title'] = $data['select']['title'];

		$this->load->view('common/head',$data);
		$this->load->view('common/header',$data);
		$this->load->view('homesite/view_article',$data);
		$this->load->view('homesite/pool',$data);
		$this->load->view('homesite/latest_articles',$data);
		$this->load->view('common/footer');
	}
}

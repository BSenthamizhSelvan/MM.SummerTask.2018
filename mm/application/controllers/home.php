<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$data['title'] = 'The news as it should be';

		$this->load->view('common/head',$data);
		$this->load->view('common/header');
		$this->load->view('home');
		$this->load->view('common/footer');
	}
	
}

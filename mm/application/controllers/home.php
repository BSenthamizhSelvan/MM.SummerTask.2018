<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->load->view('common/head');
		$this->load->view('common/header');
		$this->load->view('home');
		$this->load->view('common/footer');
	}
	
}
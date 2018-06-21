<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_panel extends CI_Controller {

	public function index()
	{
		if (!($this->session->userdata('isloggedin'))) {
			redirect(site_url('users/login'));
		} elseif (!$this->session->userdata('privilege')) {
			redirect(site_url('home'));
		} else {
			$data['userid'] = $this->session->userdata('userid');
		}

		$data['title'] = 'Admin Panel';

		$this->load->view('admin_common/head',$data);
		$this->load->view('admin_common/header');
		$this->load->view('admin_common/footer');
	}
	
}

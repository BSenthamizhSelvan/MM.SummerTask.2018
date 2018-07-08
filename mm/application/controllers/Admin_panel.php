<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_panel extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('admin');
	}

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

	public function poll()
	{

		$data = array();
		$polldata = array();

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

		$polldata = $this->admin->getpoll('1');

		if($this->input->post('pollsubmit'))
		{

			$this->form_validation->set_rules('question', 'poll Question', 'required');
			$this->form_validation->set_rules('1', 'Option 1', 'required');
			$this->form_validation->set_rules('2', 'Option 2', 'required');
			$this->form_validation->set_rules('3', 'Option 3', 'required');

			$polldata = array(
				'question' => $this->input->post('question'),
				'option1' => $this->input->post('1'),
				'option2' => $this->input->post('2'),
				'option3' => $this->input->post('3')
			);

			if($this->form_validation->run() == true){

				$poll = $this->admin->update($polldata,'1');

				if($poll){
					$this->session->set_userdata('success_msg', 'Poll has been updated successfully.');
					redirect('/admin_panel/poll');
				}else{
					$data['error_msg'] = 'Some problems occurred, please try again.';
				}
			}
		}


		$data['title'] = 'Poll';
		$data['poll'] = $polldata;


		$this->load->view('admin_common/head',$data);
		$this->load->view('admin_common/header',$data);
		$this->load->view('admin/poll',$data);
		$this->load->view('admin_common/footer');
	}

	public function new_poll()
	{

		$data = array();
		$polldata = array();

		if (!($this->session->userdata('isloggedin'))) {
			redirect(site_url('users/login'));
		} elseif (!$this->session->userdata('privilege')) {
			redirect(site_url('home'));
		} else {
			$data['userid'] = $this->session->userdata('userid');
		}
		
		if($this->input->post('pollsubmit'))
		{

			$this->form_validation->set_rules('question', 'poll Question', 'required');
			$this->form_validation->set_rules('1', 'Option 1', 'required');
			$this->form_validation->set_rules('2', 'Option 2', 'required');
			$this->form_validation->set_rules('3', 'Option 3', 'required');

			$polldata = array(
				'question' => $this->input->post('question'),
				'option1' => $this->input->post('1'),
				'option2' => $this->input->post('2'),
				'option3' => $this->input->post('3')
			);

			if($this->form_validation->run() == true){

				$poll = $this->admin->update($polldata,'1');

				if($poll){
					$this->session->set_userdata('success_msg', 'New Poll has been added successfully.');
					redirect('/admin_panel/poll');
				}else{
					$data['error_msg'] = 'Some problems occurred, please try again.';
				}
			}
		}


		$data['title'] = 'New Poll';
		$data['poll'] = $polldata;


		$this->load->view('admin_common/head',$data);
		$this->load->view('admin_common/header',$data);
		$this->load->view('admin/new_poll',$data);
		$this->load->view('admin_common/footer');
	}

	public function users() {
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

		$data['users'] = $this->admin->getusers();
		$data['title'] = 'User Data';



		$this->load->view('admin_common/head', $data);
		$this->load->view('admin_common/header', $data);
		$this->load->view('admin/users', $data);
		$this->load->view('admin_common/footer');
	}

	public function delete_user($id)
	{

		if($id){

			$delete = $this->admin->del_user($id);

			if($delete){
				$this->session->set_userdata('success_msg', 'User has been removed successfully.');
			}else{
				$this->session->set_userdata('error_msg', 'Some problems occurred, please try again.');
			}
		}

		redirect('admin_panel/users');
	}

	public function admin($id)
	{

		if($id){

			$user = $this->admin->getusers($id);

			$user['privilege']='1';

			$update=$this->admin->user_update($user,$id);

			if($update){
				$this->session->set_userdata('success_msg', 'Admin Access granted');
			}else{
				$this->session->set_userdata('error_msg', 'Some problems occurred, please try again.');
			}
		}
		
		$this->session->set_userdata('privilege',$user['privilege']);

		redirect('admin_panel/users');
	}

	public function non_admin($id)
	{

		if($id){

			$user = $this->admin->getusers($id);

			$user['privilege']='0';

			$update=$this->admin->user_update($user,$id);

			if($update){
				$this->session->set_userdata('success_msg', 'Admin Access removed');
			}else{
				$this->session->set_userdata('error_msg', 'Some problems occurred, please try again.');
			}
		}

		$this->session->set_userdata('privilege',$user['privilege']);

		redirect('admin_panel/users');
	}

}

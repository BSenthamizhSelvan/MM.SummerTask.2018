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

		$this->session->unset_userdata('question');

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

		$total=$polldata['count1']+$polldata['count2']+$polldata['count3'];
		$data['a']=$polldata['count1']*'100'/$total;
		$data['b']=$polldata['count2']*'100'/$total;
		$data['c']=$polldata['count3']*'100'/$total;

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
		$this->load->view('homesite/poll_result',$data);
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
				'option3' => $this->input->post('3'),
				'count1' => '0',
				'count2' => '0',
				'count3' => '0'
			);

			if($this->form_validation->run() == true){

				$poll = $this->admin->update($polldata,'1');

				if($poll){

					$users=$this->admin->getusers();

					foreach ($users as $user) {
						$user['vote']='0';
						$this->admin->user_update($user, $user['id']);
					}

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
		
		redirect('admin_panel/users');
	}

	public function author($id)
	{

		if($id){

			$user = $this->admin->getusers($id);

			$user['privilege']='2';

			$update=$this->admin->user_update($user,$id);

			if($update){
				$this->session->set_userdata('success_msg', 'Author Access granted');
			}else{
				$this->session->set_userdata('error_msg', 'Some problems occurred, please try again.');
			}
		}

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

		redirect('admin_panel/users');
	}

	public function article_comment() {
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

		$data['comments']=$this->admin->getcomments();
		$data['article']=$this->admin->getarticle();
		$data['user']=$this->admin->getusers();

		$data['title']='Comments Approval';

		$this->load->view('admin_common/head', $data);
		$this->load->view('admin_common/header', $data);
		$this->load->view('admin/article_comments', $data);
		$this->load->view('admin_common/footer');
	}

	public function approve_article_comment($id)
	{

		if($id){

			$comment = $this->admin->getcomments($id);

			$comment['approved']='1';

			$update=$this->admin->comment_update($comment,$id);

			if($update){
				$this->session->set_userdata('success_msg', 'Comment Approved');
			}else{
				$this->session->set_userdata('error_msg', 'Some problems occurred, please try again.');
			}
		}

		redirect('admin_panel/article_comment');
	}

	public function article_comment_delete($id)
	{

		if($id){

			$delete = $this->admin->del_comment($id);

			if($delete){
				$this->session->set_userdata('success_msg', 'Comment removed');
			}else{
				$this->session->set_userdata('error_msg', 'Some problems occurred, please try again.');
			}
		}

		redirect('admin_panel/article_comment');
	}

	public function question() {
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

		$data['question']=$this->admin->getquestion();

		$data['title']='Question Approval';

		$this->load->view('admin_common/head', $data);
		$this->load->view('admin_common/header', $data);
		$this->load->view('admin/question', $data);
		$this->load->view('admin_common/footer');
	}

	public function question_final() {
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

		$data['question']=$this->admin->getquestion_final();

		$data['title']='Approved Question';

		$this->load->view('admin_common/head', $data);
		$this->load->view('admin_common/header', $data);
		$this->load->view('admin/question_final', $data);
		$this->load->view('admin_common/footer');
	}

	public function approve_question($id)
	{

		if($id){

			$comment = $this->admin->getquestion($id);

			$comment['approved']='1';

			$update=$this->admin->questionupdate($comment,$id);

			if($update){
				$this->session->set_userdata('success_msg', 'Question Approved');
			}else{
				$this->session->set_userdata('error_msg', 'Some problems occurred, please try again.');
			}
		}

		redirect('admin_panel/question');
	}

	public function delete_question($id)
	{

		if($id){

			$delete = $this->admin->delquestion($id);

			if($delete){
				$this->session->set_userdata('success_msg', 'Question removed');
			}else{
				$this->session->set_userdata('error_msg', 'Some problems occurred, please try again.');
			}
		}

		redirect('admin_panel/question');
	}

	public function delete_question_final($id)
	{

		if($id){

			$delete = $this->admin->delquestion($id);

			if($delete){
				$this->session->set_userdata('success_msg', 'Question removed');
			}else{
				$this->session->set_userdata('error_msg', 'Some problems occurred, please try again.');
			}
		}

		redirect('admin_panel/question_final');
	}

	public function forum() {

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

		$data['thread']=$this->admin->getthread();
		$data['user']=$this->admin->getusers();
		$data['id']='0';
		$data['title']='Thread Approval';

		$this->load->view('admin_common/head', $data);
		$this->load->view('admin_common/header', $data);
		$this->load->view('admin/forum', $data);
		$this->load->view('admin_common/footer');
	}

	public function approve_thread($id)
	{

		if($id){

			$thread = $this->admin->getthread($id);

			$thread['approved']='1';

			$update=$this->admin->forumupdate($thread,$id);

			if($update){
				$this->session->set_userdata('success_msg', 'Thread Approved');
			}else{
				$this->session->set_userdata('error_msg', 'Some problems occurred, please try again.');
			}
		}

		redirect('admin_panel/forum');
	}

	public function delete_thread($id)
	{

		if($id){

			$delete = $this->admin->delforum($id);

			if($delete){
				$this->session->set_userdata('success_msg', 'Thread removed');
			}else{
				$this->session->set_userdata('error_msg', 'Some problems occurred, please try again.');
			}
		}

		redirect('admin_panel/forum');
	}

	public function reply() {

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

		$data['thread']=$this->admin->get_thread();
		$data['reply']=$this->admin->getinfo();
		$data['user']=$this->admin->getusers();
		$data['count']=$this->admin->count('1');
		$data['title']='Thread Reply Approval';

		$this->load->view('admin_common/head', $data);
		$this->load->view('admin_common/header', $data);
		$this->load->view('admin/reply', $data);
		$this->load->view('admin_common/footer');
	}

	public function approve_reply($id)
	{

		if($id){

			$info = $this->admin->getinfo($id);

			$post = $info['thread_id'];

			$info['approved']='1';

			$update=$this->admin->replyupdate($info,$id);

			if($update){

				$thread = $this->admin->getthread($post);

				$thread['replies'] = $this->admin->count($post);

				$this->admin->forumupdate($thread,$post);

				$this->session->set_userdata('success_msg', 'Reply Approved');
			}else{
				$this->session->set_userdata('error_msg', 'Some problems occurred, please try again.');
			}
		}

		redirect('admin_panel/reply');
	}

	public function delete_reply($id)
	{

		if($id){

			$delete = $this->admin->delreply($id);

			if($delete){
				$this->session->set_userdata('success_msg', 'Reply removed');
			}else{
				$this->session->set_userdata('error_msg', 'Some problems occurred, please try again.');
			}
		}

		redirect('admin_panel/reply');
	}

}

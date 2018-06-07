<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Users extends CI_Controller 
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('user');
    }

    public function register()
    {
        $data = array();
        $userdata = array();
        $data['title'] = 'Registration';
        if($this->input->post('regsubmit'))
        {
            $this->form_validation->set_rules('username', 'User Name', 'trim|required|alpha|min_length[3]|max_length[20]|is_unique[users.username]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[20]');
            $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]|min_length[6]|max_length[20]');

            $userdata = array(
                'username' => strip_tags($this->input->post('username')),
                'email' => strip_tags($this->input->post('email')),
                'password' => md5($this->input->post('password')),
            );

            if($this->form_validation->run() == true){
                $insert = $this->user->insert($userdata);
                if($insert){
                    $this->session->set_flashdata('msg_success','Registration Successful!');
                    redirect('users/login');
                }else{
                    $data['error_msg'] = 'Some problems occured, please try again.';
                }
            }
        }
        $data['user'] = $userdata;
        
        $this->load->view('users/registration', $data);
    }
}
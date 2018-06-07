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
        $this->load->view('common/head');
        $this->load->view('common/header');
        $this->load->view('users/register', $data);
        $this->load->view('common/footer');

    }

    public function login()
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
        if($this->input->post('lgn')){
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $this->form_validation->set_rules('username', 'User Name', 'trim|required|alpha|min_length[3]|max_length[20]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[20]');        

            $data['title'] = 'Login';

            if ($this->form_validation->run() == true) {
                $con['returnType'] = 'single';
                $con['conditions'] = array(
                    'username'=>strip_tags($this->input->post('username')),
                    'password' => md5($this->input->post('password'))
                );
                $checkLogin = $this->user->getRows($con);
                if($checkLogin){
                    $this->session->set_userdata('isloggedin',TRUE);
                    $this->session->set_userdata('userid',$checkLogin['id']);
                    $this->session->set_userdata('username',$checkLogin['username']);
                    $this->session->set_flashdata('msg_success','Login Successful!');
                    redirect('home');

                }else{
                    $data['error_msg'] = 'Wrong email or password, please try again.';
                }
            }
        }

        $this->load->view('common/head');
        $this->load->view('common/header');
        $this->load->view('users/login', $data);
        $this->load->view('common/footer');

    }

    public function logout(){
        $this->session->unset_userdata('isloggedin');
        $this->session->unset_userdata('userId');
        $this->session->unset_userdata('username');
        $this->session->sess_destroy();
        redirect('home');
    }
}
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
        if (($this->session->userdata('isloggedin'))) {
            redirect(site_url('home'));
        }
        
        $userdata = array();
        $data['title'] = 'Registration';
        if($this->input->post('regsubmit'))
        {
            $this->form_validation->set_rules('username', 'User Name', 'trim|required|alpha|min_length[3]|max_length[20]|callback_namecheck');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_emailcheck');
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
                    $this->session->set_userdata('success_msg', 'Registration Successful!');
                    redirect('users/login');
                }else{
                    $data['error_msg'] = 'Some problems occured, please try again.';
                }
            }
        }
        $data['user'] = $userdata;

        $this->load->view('common/head', $data);
        $this->load->view('css/register', $data);
        $this->load->view('common/header', $data);
        $this->load->view('users/register', $data);
        $this->load->view('common/footer');

    }

    public function login()
    {
        $data = array();
        if (($this->session->userdata('isloggedin'))) {
            redirect(site_url('home'));
        }


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
                    $this->session->set_userdata('privilege',$checkLogin['privilege']);
                    redirect('home');

                }else{
                    $data['error_msg'] = 'Wrong Username or password, please try again.';
                }
            }
        }
        $data['title'] = 'Login';

        $this->load->view('common/head', $data);
        $this->load->view('common/header', $data);
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

    public function emailcheck($str){
        $con['returnType'] = 'count';
        $con['conditions'] = array('email'=>$str);
        $checkEmail = $this->user->getRows($con);
        if($checkEmail > 0){
            $this->form_validation->set_message('emailcheck', 'Email already exists.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function namecheck($str){
        $con['returnType'] = 'count';
        $con['conditions'] = array('username'=>$str);
        $checkname = $this->user->getRows($con);
        if($checkname > 0){
            $this->form_validation->set_message('namecheck', 'User name already exists.');
            return FALSE;
        } else {
            return TRUE;
        }
        
    }
}
<?php
    defined('BASEPATH') OR exit('No direct script access allowed');  
    class Auth extends CI_Controller {
        public function __construct() {
            parent::__construct();
            $this->load->library('form_validation');
            $this->load->model('Auth_model');
            
        }
        public function login() {
            if($this->session->userdata('email')){
                redirect('user/index');
            }
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required|trim');


            if($this->form_validation->run() == false){
                $data['judul'] =  'Login';
                $this->load->view('templates/auth_header', $data);
                $this->load->view('auth/login');
                $this->load->view('templates/auth_footer');
            }
            else{
                // echo base_url('auth/registration');
                $this->Auth_model->_login();
            }
        }
        public function blocked(){
            $data['judul'] =  'Access Forbidden';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/denied');
            $this->load->view('templates/auth_footer');
        }
        public function logout(){
            $this->session->unset_userdata('email');
            $this->session->unset_userdata('role_id');
            $this->session->set_flashdata('email_message', '<div class="alert alert-success" role="alert">You have been logged out! </div>');
            redirect('auth/login');
        }

        public function forgotpassword() {
            $data['judul'] =  'Forgot Password';
            $data['user'] = $this->Auth_model->getUser();
            
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
                'required' => 'Email is required!',
                'valid_email' => 'Email is not valid!'
            ]);
            

            if($this->form_validation->run() == false){
                $this->load->view('templates/auth_header', $data);
                $this->load->view('auth/forgot');
                $this->load->view('templates/auth_footer');
            }else{
                $this->Auth_model->_forgotPassword();
            }

            
        }   
        public function registration() {
            if($this->session->userdata('email')){
                redirect('user/index');
            }
            $this->form_validation->set_rules('fullname', 'Fullname', 'required|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
                'is_unique' => 'This email has already registered!'
            ]);
            $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[4]', [
                'required' => 'Password is required!',
                'min_length' => 'Password too short!'
            ]);

            $this->form_validation->set_rules('password2', 'Password', 'trim|matches[password1]', [
                'matches' => 'Password dont match!',
                
            ]);
            
            if($this->form_validation->run() == false){

                $data['judul'] =  'Registration';
                $this->load->view('templates/auth_header', $data);
                $this->load->view('auth/regis');
                $this->load->view('templates/auth_footer');
            }
            else{
                $this->Auth_model->_registration();
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! Your account has been created. Please activate your account!</div>');
                redirect('auth/login');

            }
            
        }
        public function resetpassword(){
           $this->Auth_model->_resetpassword();
        }
    
        public function verify(){
            $this->Auth_model->_verify();
        }
        
        public function changePassword(){
            if(!$this->session->userdata('reset_email')){
                redirect('auth/login');
            }
            $this->form_validation->set_rules('newpass', 'Password', 'required|trim|min_length[4]', [
                'required' => 'Password is required!',
                'min_length' => 'Password too short!'
            ]);

            $this->form_validation->set_rules('repass', 'Password', 'trim|matches[newpass]', [
                'matches' => 'Password dont match!',
                
            ]);
            if($this->form_validation->run() == false){
                $data['judul'] =  'Change Password';
                $this->load->view('templates/auth_header', $data);
                $this->load->view('auth/changePassword');
                $this->load->view('templates/auth_footer');
            }else{
               
                $this->Auth_model->_changePassword();
                $this->session->unset_userdata('reset_email');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password has been changed! Please login.</div>');
                redirect('auth/login');
            }
        }
    
    }
?>
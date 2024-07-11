<?php
    defined('BASEPATH') OR exit('No direct script access allowed');  
    class Auth extends CI_Controller {
        public function __construct() {
            parent::__construct();
            $this->load->library('form_validation');
            $this->load->model('Auth_model');
            
            
        }
        public function login() {
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
                $this->_login();
            }
        }
        public function _login(){
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $this->db->where('email', $this->input->post('email'));
            $user = $this->db->get('user')->row_array();

            if($user){
                if($user['is_active'] == 1){
                    if(password_verify($password, $user['password'])){
                        $data = [
                            'email' => $user['email'],
                            'role_id' => $user['role_id']
                        ];
                        $this->session->set_userdata($data);
                        if($user['role_id'] == 1){
                            // redirect('admin');
                        $this->session->set_flashdata('login_success', 'ok');
                            redirect('admin/index');
                        }else{
                            $this->session->set_flashdata('login_success', 'ok');
                            redirect('user/index');
                            // redirect('user/index');
                            // $this->session->set_flashdata('login_error', 'Wrong password!');  sdcvasd    
                        }
                    }else{
                        $this->session->set_flashdata('login_error', 'Wrong password!');
                        redirect('auth/login');
                    }
                }else{
                    $this->session->set_flashdata('email_message', '<div class="alert alert-danger" role="alert">This email has not been activated!</div>');
                    redirect('auth/login');
                }

            }else{
                $this->session->set_flashdata('email_message', '<div class="alert alert-danger" role="alert">This email is not registered! </div>');
                redirect('auth/login');
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

        public function forgot_password() {
            $data['judul'] =  'Forgot Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/forgot');
            $this->load->view('templates/auth_footer');
        }   
        public function registration() {

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
                $data = [
                    'name' => htmlspecialchars($this->input->post('fullname', true)),
                    'email' => htmlspecialchars($this->input->post('email', true)),
                    'image' => 'default.jpg',
                    'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                    'role_id' => 2,
                    'is_active' => 1,
                    'date_create' => time()
                ];
                $this->db->insert('user', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Congratulation! your account has been created. Please Login!</div>');
                redirect('auth/login');

            }

        }
    }
?>
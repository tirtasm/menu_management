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
                            'id_role' => $user['id_role']
                        ];
                        $this->session->set_userdata($data);
                        if($user['role_id'] == 1){
                            // redirect('admin');
                            
                            redirect('admin/index');
                        $this->session->set_flashdata('login_success', 'ok');
                        
                        }else{
                            redirect('user/index');
                            $this->session->set_flashdata('login_success', 'ok');
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
                $email = htmlspecialchars($this->input->post('email', true));
                $data = [
                    'name' => htmlspecialchars($this->input->post('fullname', true)),
                    'email' => htmlspecialchars($this->input->post('email', true)),
                    'image' => 'default.jpg',
                    'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                    'id_role' => 2,
                    'is_active' => 0,
                    'date_create' => time()
                ];
                $token = base64_encode(random_bytes(32));
                $userToken = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];
                $this->db->insert('user', $data);
                $this->db->insert('user_token', $userToken);

                $this->_sendEmail($token, 'verify');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! Your account has been created. Please activate your account!</div>');
                redirect('auth/login');

            }
            
        }
        private function _sendEmail($token, $type){
            $config = [
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_user' => 'akunsimpanan023@gmail.com',
                'smtp_pass' => 'afok etus dzrp aucp',
                'smtp_port' => 465,
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'newline' => "\r\n"
            ];
            $this->email->initialize($config);
            $this->email->from('akunsimpanan023@gmail.com', 'Akun Aktivasi');
            $this->email->to(htmlspecialchars($this->input->post('email')));


            if($type == 'verify'){
                $this->email->subject('Account Verification');
                $this->email->message('Click this link to activate your account : <a href="'.base_url().'auth/verify?email='.$this->input->post('email').'&token='.$token.'">Activate</a>');
            } 


            if($this->email->send()){
                return true;
            }else{
                echo $this->email->print_debugger();
                die;
            }
        }
        public function verify(){
            $email = $this->input->get('email');
            $token = $this->input->get('token');

            $user = $this->db->get_where('user', ['email' => $email])->row_array();
            
            if($user){
                $user_token = $this->db->get_where('user_token')->row_array();
                var_dump($user_token);
                if($user_token){
                    if(time() - $user_token['date_created'] < (60*60*24)){
                        $this->db->set('is_active', 1);
                        $this->db->where('email', $email);
                        $this->db->update('user');
                        
                        $this->db->delete('user_token', ['email' => $email]);
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">'.$email.' has been activated! Please login.</div>');
                        redirect('auth/login');
                    }
                    else{
                        $this->db->delete('user', ['email' => $email]);
                        $this->db->delete('user_token', ['email' => $email]);
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Token expired.</div>');
                        redirect('auth/login');
                    }
                }else{
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Token invalid.</div>');
                    redirect('auth/login');
                }
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Wrong email.</div>');
                redirect('auth/login');
            }
        } 
    }
?>
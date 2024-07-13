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
                        if($user['id_role'] == 1){
                            
                            $this->session->set_flashdata('login_success', 'ok');
                            redirect('admin/index');
                        }else{
                            
                            $this->session->set_flashdata('login_success', 'ok');
                            redirect('user/index');
                            
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
                $email = $this->input->post('email');
                $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();
                if($user){
                    $token = base64_encode(random_bytes(32));
                    $user_token = [
                        'email' => $email,
                        'token' => $token,
                        'date_created' => time()
                    ];
                    $this->db->insert('user_token', $user_token);
                    $this->_sendEmail($token, 'forgot');
                    $this->session->set_flashdata('check_email', '<div class="alert alert-success" role="alert">Please check your email to reset your password!</div>');
                    redirect('auth/forgotpassword');
                }else{
                    $this->session->set_flashdata('validasi', '<small class="text-danger pl-2">Email is not registered or activated!</small>');
                    redirect('auth/forgotpassword');
                }
                
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

            $this->email->from('akunsimpanan023@gmail.com', 'Akun Email');
            $this->email->to(htmlspecialchars($this->input->post('email')));


            if($type == 'verify'){
                $this->email->subject('Account Verification');
                $this->email->message('Click this link to verify your account : <a href="'.base_url().'auth/verify?email='.htmlspecialchars($this->input->post('email')).'&token='.urlencode($token).'">Activate</a>');
            }
            else if($type == 'forgot'){
                $this->email->subject('Reset Password');
                $this->email->message('Click this link to reset your password : <a href="'.base_url().'auth/resetpassword?email='.htmlspecialchars($this->input->post('email')).'&token='.urlencode($token).'">Reset Password</a>');
            }


            if($this->email->send()){
                return true;
            }else{
                echo $this->email->print_debugger();
                die;
            }
        }
        public function resetpassword(){
            $email = $this->input->get('email');
            $token = $this->input->get('token');

            $user = $this->db->get_where('user', ['email' => $email])->row_array();
            if($user){
                $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
                if($user_token){
                    $this->session->set_userdata('reset_email', $email);
                    $this->changePassword();
                }else{
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Wrong token.</div>');
                    redirect('auth/login');
                }
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Wrong email.</div>');
                redirect('auth/login');
            }
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
                $password = password_hash($this->input->post('newpass'), PASSWORD_DEFAULT);
                $email = $this->session->userdata('reset_email');
                $this->db->set('password', $password);
                $this->db->where('email', $email);
                $this->db->update('user');

                $this->session->unset_userdata('reset_email');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password has been changed! Please login.</div>');
                redirect('auth/login');
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
                        $this->db->delete('user', ['email' => $email]);
                    
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
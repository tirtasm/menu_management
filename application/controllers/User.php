<?php  
    defined('BASEPATH') OR exit('No direct script access allowed');
    class User extends CI_Controller {
        public function __construct() {
            parent::__construct();
            $this->load->model('User_model');
            $this->load->library('form_validation');
            check_login();
        }
        public function error_404() {
            $this->output->set_status_header('404');
            $data['judul'] =  '404 Page Not Found';
            $this->load->view('templates/header', $data);
            $this->load->view('user/404');
            $this->load->view('templates/footer');
        }


        public function index() {
            $data['user'] = $this->db->get_where('user',
            ['email' => $this->session->userdata['email']])->row_array();
            
            $data['judul'] =  'My Profile';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/index', $data);
            $this->load->view('templates/footer');
        }
        public function edit() {
            $data['user'] = $this->db->get_where('user',
            ['email' => $this->session->userdata['email']])->row_array();

            $this->form_validation->set_rules('name', 'Name', 'required|min_length[4]', [
                'required' => 'Name field is required!',
                'min_length' => 'Name field must be at least 4 characters in length.'
            ]);
            if($this->form_validation->run() == false){
                $data['judul'] =  'Edit Profile';
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('user/edit', $data);
                $this->load->view('templates/footer');
            }else{

                $this->User_model->editUser();
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated!</div>');
                redirect('user');
            }
        }
        public function changepassword() {
            $data['user'] = $this->db->get_where('user',
            ['email' => $this->session->userdata['email']])->row_array();
            
            $data['judul'] =  'Change Password';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/index', $data);
            $this->load->view('templates/footer');
        }
    }
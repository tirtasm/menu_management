<?php  
    defined('BASEPATH') OR exit('No direct script access allowed');
    class User extends CI_Controller {
        public function __construct() {
            parent::__construct();
            $this->load->model('User_model');
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
            
            $data['judul'] =  'Edit Profile';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/index', $data);
            $this->load->view('templates/footer');
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
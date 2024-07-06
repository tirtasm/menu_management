<?php  
    class User extends CI_Controller {
        public function __construct() {
            parent::__construct();
            $this->load->model('User_model');
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
            
            $data['judul'] =  'Dashboard';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/index', $data);
            $this->load->view('templates/footer');
        }
    }
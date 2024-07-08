<?php  
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Admin extends CI_Controller {
        public function __construct() {
            parent::__construct();
            $this->load->library('form_validation');
            // $this->load->model('Auth_model');
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
?>
<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Menu extends CI_Controller {
        public function __construct() {
            parent::__construct();
            $this->load->library('form_validation');
            // $this->load->model('Menu_model');
        }
        public function index() {
            
            $data['user'] = $this->db->get_where('user',
            ['email' => $this->session->userdata['email']])->row_array();
            
            $data['menu'] = $this->db->get('user_menu')->result_array();
            $data['judul'] =  'Menu Management';
            
            $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('menu/index', $data);
                $this->load->view('templates/footer');
          
        }
        public function add(){
            
            // echo $this->input->post('menu');
            
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('menu_flash', ' added!');
            redirect('menu');
        }
        public function delete($id){
            $this->db->delete('user_menu', ['id_menu' => $id]);
            $this->session->set_flashdata('menu_flash', ' deleted!');
            redirect('menu');
        }
        public function edit($id){
            $data['menu'] = $this->db->get_where('user_menu', ['id_menu' => $id])->row_array();
            $this->load->view('menu/edit', $data);



        }
    }
<?php  
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Admin extends CI_Controller {
        public function __construct() {
            parent::__construct();
            $this->load->library('form_validation');
            $this->load->model('Admin_model');
            // check_login();
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
        public function role(){
            $data['judul'] =  'Role';
            $data['user'] = $this->db->get_where('user',
            ['email' => $this->session->userdata['email']])->row_array();
            $data['role'] = $this->db->get('user_role')->result_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        }
    public function add(){
            $this->form_validation->set_rules('role', 'Role', 'required|trim|is_unique[user_role.role]', [
                'is_unique' => 'This role has already added!'
            ]);
            
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('role_failed', ' already exists!');
                redirect('admin/role');
            } else {
                $this->session->set_flashdata('role_added', ' added!');
                $this->Admin_model->addRole();
                redirect('admin/role');
            }
        }

        public function delete($id){
            $this->Admin_model->deleteRole($id);
            $this->session->set_flashdata('role_flash', ' deleted!');
            redirect('admin/role');
        }
        public function getEditRole(){
            echo json_encode($this->Admin_model->getRoleById($this->input->post('id_role')));
        }
        public function editRole(){
            $this->form_validation->set_rules('role', 'Role', 'required|trim|is_unique[user_role.role]', [
                'is_unique' => 'This role has already added!'
            ]);
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('role_failed', ' already exists!');
                redirect('admin/role');
            } else {
                $this->session->set_flashdata('role_flash', ' updated!');
                $this->Admin_model->updateRole();
                redirect('admin/role');
            }

        }
    }
?>
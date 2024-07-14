<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Admin_model');
        $this->load->model('Menu_model');
        check_login();
    }
    public function index()
    {
        $data['user'] = $this->Admin_model->getUser();
        $data['judul'] = 'Dashboard';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }
    public function role()
    {
        

        $data['judul'] = 'Role';
        $data['user'] = $this->Admin_model->getUser();
        $data['role'] = $this->Admin_model->getRole();
    
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }
    public function roleaccess($role_id)
    {
        $data['judul'] = 'Role Access';
        $data['user'] = $this->Admin_model->getUser();
        $data['role'] = $this->Admin_model->getRoleById($role_id);
        $this->db->where('id_menu !=', 1);

        $data['menu'] = $this->Menu_model->getMenu();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');

    }
    public function add()
    {
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

    public function delete($id)
    {
        $this->Admin_model->deleteRole($id);
        $this->session->set_flashdata('role_flash', ' deleted!');
        redirect('admin/role');
    }
    public function getEditRole()
    {
        echo json_encode($this->Admin_model->getRoleById($this->input->post('id_role')));
    }
    public function editRole()
    {
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
    public function changeaccess(){
        $data = [
			'role_id' => $this->input->post('roleId'),
            'id_menu' => $this->input->post('menuId')
		];

		$result = $this->db->get_where('user_access_menu', $data);


        if ($result->num_rows() < 1) {
            
            $this->session->set_flashdata('changeaccess', '<div class="alert alert-success" role="alert">Changed Access</div>');
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->session->set_flashdata('changeaccess', '<div class="alert alert-danger" role="alert">Delete Access</div>');
            $this->db->delete('user_access_menu', $data);
        }
    }
    
}
?>
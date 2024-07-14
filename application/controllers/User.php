<?php
defined('BASEPATH') or exit('No direct script access allowed');
class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Auth_model');
        $this->load->library('form_validation');
        check_login();
    }
    public function error_404()
    {
        $this->output->set_status_header('404');
        $data['judul'] = '404 Page Not Found';
        $this->load->view('templates/header', $data);
        $this->load->view('user/404');
        $this->load->view('templates/footer');
    }


    public function index()
    {
        $data['user'] = $this->User_model->getUser();

        $data['judul'] = 'My Profile';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }
    public function edit()
    {
        $data['user'] = $this->User_model->getUser();

        $this->form_validation->set_rules('name', 'Name', 'required|min_length[4]', [
            'required' => 'Name field is required!',
            'min_length' => 'Name field must be at least 4 characters in length.'
        ]);
        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Edit Profile';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {

            $this->User_model->editUser();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated!</div>');
            redirect('user');
        }
    }
    public function changepassword()
    {
        $data['user'] = $this->User_model->getUser();

        $this->form_validation->set_rules('currentpassword', 'Current Password', 'required|trim|is_unique[user.password]', [
            'required' => 'Current Password field is required!',
            'is_unique' => 'Current Password field does not match!'
        ]);
        $this->form_validation->set_rules('newpass', 'New Password', 'required|trim|min_length[4]', [
            'required' => 'Password field is required!',
            'min_length' => 'Password field must be at least 4 characters in length.'
        ]);
        $this->form_validation->set_rules('repass', 'Repeat Password', 'trim|matches[newpass]', [
            'required' => 'Repeat Password field is required!',
            'matches' => 'Repeat Password field does not match!'
        ]);

        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Change Password';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $this->User_model->changePassword();
        }

    }
}
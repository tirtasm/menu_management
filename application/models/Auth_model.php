<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Auth_model extends CI_Model{
        // public function _login(){
        //      $email = $this->input->post('email');
        //     $password = $this->input->post('password');

        //     $this->db->where('email', $this->input->post('email'));
        //     $user = $this->db->get('user')->row_array();

        //     if($user){
        //         if($user['is_active'] == 1){
        //             if(password_verify($password, $user['password'])){
        //                 $data = [
        //                     'email' => $user['email'],
        //                     'role_id' => $user['role_id']
        //                 ];
        //                 $this->session->set_userdata($data);
        //                 if($user['role_id'] == 1){
        //                     // redirect('admin');
        //                 $this->session->set_flashdata('login_success', 'ok');
        //                     redirect('admin/index');
        //                 }else{
        //                     $this->session->set_flashdata('login_success', 'ok');
        //                     redirect('user/index');
        //                     // redirect('user/index');
        //                     // $this->session->set_flashdata('login_error', 'Wrong password!');  sdcvasd    
        //                 }
        //             }else{
        //                 $this->session->set_flashdata('login_error', 'Wrong password!');
        //                 redirect('auth/login');
        //             }
        //         }else{
        //             $this->session->set_flashdata('email_message', '<div class="alert alert-danger" role="alert">This email has not been activated!</div>');
        //             redirect('auth/login');
        //         }

        //     }else{
        //         $this->session->set_flashdata('email_message', '<div class="alert alert-danger" role="alert">This email is not registered! </div>');
        //         redirect('auth/login');
        //     }
        // }
        // public function login($email, $password) {
        //     $this->db->where('email', $email);
        //     $user = $this->db->get('user')->row_array();
    
        //     if ($user) {
        //         if ($user['is_active'] == 1) {
        //             if (password_verify($password, $user['password'])) {
        //                 $data = [
        //                     'email' => $user['email'],
        //                     'role_id' => $user['role_id']
        //                 ];
        //                 $this->session->set_userdata($data);
        //                 if ($user['role_id'] == 1) {
        //                     redirect('admin/index');
        //                 } else {
        //                     redirect('user/index');
        //                 }
        //             } else {
        //                 $this->session->set_flashdata('login_error', 'Wrong password!');
        //                 redirect('auth/login');
        //             }
        //         } else {
        //             $this->session->set_flashdata('email_message', '<div class="alert alert-danger" role="alert">This email has not been activated!</div>');
        //             redirect('auth/login');
        //         }
        //     } else {
        //         $this->session->set_flashdata('email_message', '<div class="alert alert-danger" role="alert">This email is not registered! </div>');
        //         redirect('auth/login');
        //     }
        // }
}
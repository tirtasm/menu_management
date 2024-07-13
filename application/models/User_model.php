<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

    class User_model extends CI_Model{
        public function get_user(){
            $this->db->select('*');
            $this->db->from('user');
            $this->db->join('user_role', 'user.id_role = user_role.id_role');
            $this->db->where('email', $this->session->userdata('email'));
            return $this->db->get()->row_array();
        }

        public function editUser(){
            $this->db->set('name', $this->input->post('name'));
            $this->db->where('email', $this->session->userdata('email'));
            $this->db->update('user'); 
            $data['user'] = $this->get_user();
            $upload = $_FILES['image']['name'];
            if($upload){
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size'] = '2000';
                $config['upload_path'] = './assets/img/profile/';
                $this->load->library('upload', $config);
                if($this->upload->do_upload('image')){
                    $old_image = $data['user']['image'];
                    if($old_image != 'default.jpg'){
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');
                }else{
                    echo $this->upload->display_errors();
                }
            }

        }
        
    }
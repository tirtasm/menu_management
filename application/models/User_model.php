<?php 

    class User_model extends CI_Model{
        public function get_user(){
            $this->db->select('*');
            $this->db->from('user');
            $this->db->join('user_role', 'user.role_id = user_role.id');
            $this->db->where('email', $this->session->userdata('email'));
            return $this->db->get()->row_array();
        }
        
    }
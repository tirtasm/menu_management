<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Auth_model extends CI_Model{
        public function getUser (){
            $this->db->where('email', $this->input->post('email'));
            $user = $this->db->get('user')->row_array();
            return $user;
        }
}
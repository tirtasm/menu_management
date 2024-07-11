<?php  
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Admin_model extends CI_Model{
        public function getRoleById($id){
            return $this->db->get_where('user_role', ['id_role' => $id])->row_array();
        }
        public function addRole(){
            $data = [
                'role' => $this->input->post('role')
            ];
            echo $this->db->insert('user_role', $data);
        }
        public function deleteRole($id){
            $this->db->delete('user_role', ['id_role' => $id]);
        }
        public function updateRole(){
            $data = [
                'role' => $this->input->post('role')
            ];
            $this->db->where('id_role', $this->input->post('id_role'));
            $this->db->update('user_role', $data);
        }
    }
?>
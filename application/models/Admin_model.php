<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function getRoleById($id)
    {

        return $this->db->get_where('user_role', ['id_role' => $id])->row_array();
    }
    public function getRole()
    {

        return $this->db->get('user_role')->result_array();
    }
    public function addRole()
    {
        $data = [
            'role' => htmlspecialchars($this->input->post('role'))
        ];
        echo $this->db->insert('user_role', $data);
    }
    public function deleteRole($id)
    {
        $this->db->delete('user_role', ['id_role' => $id]);
    }
    public function updateRole()
    {
        $data = [
            'role' => htmlspecialchars($this->input->post('role'))
        ];
        $this->db->where('id_role', htmlspecialchars($this->input->post('id_role')));
        $this->db->update('user_role', $data);
    }
    public function getUser()
    {
        return $this->db->get_where(
            'user',
            ['email' => $this->session->userdata['email']]
        )->row_array();
    }
    
}
?>
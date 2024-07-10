<?php


class Menu_model extends CI_Model
{

    public function deleteMenu($id)
    {
        $this->db->delete('user_menu', ['id_menu' => $id]);
    }

    public function deleteSubMenu($id)
    {
        $this->db->delete('user_sub_menu', ['id' => $id]);
    }

    public function getMenuById($id)
    {
        return $this->db->get_where('user_menu', ['id_menu' => $id])->row_array();
    }

    public function updateMenu()
    {
        $data = [
            'menu' => $this->input->post('menu')
        ];
        $this->db->where('id_menu', $this->input->post('id_menu'));
        $this->db->update('user_menu', $data);
    }

    public function getSubMenuById($id)
    {
        return $this->db->get_where('user_sub_menu', ['id' => $id])->row_array();
    }

    public function updateSubMenu()
    {
        $data = [
            'title' => $this->input->post('title'),
            'menu_id' => $this->input->post('menu_id'),
            'url' => $this->input->post('url'),
            'icon' => $this->input->post('icon'),
            'is_active' => $this->input->post('is_active')
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user_sub_menu', $data);
    }

}
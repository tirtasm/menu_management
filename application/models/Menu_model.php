<?php


class Menu_model extends CI_Model
{

    //menu
    public function deleteMenu($id)
    {
        $this->db->delete('user_menu', ['id_menu' => $id]);
    }

    public function getMenuById($id)
    {
        return$this->db->get_where('user_menu', ['id_menu' => $id])->row_array();
    }
    
public function addMenu(){
        $data = [
            'menu' => $this->input->post('menu')
        ];
        $this->db->insert('user_menu', $data);    
}
    public function updateMenu()
    {
        $data = [
            'menu' => $this->input->post('menu')
        ];
        $this->db->where('id_menu', $this->input->post('id_menu'));
        $this->db->update('user_menu', $data);
    }

    

    //submenu
    public function getSubMenuById($id)
    {
        return $this->db->get_where('user_sub_menu', ['id_sub' => $id])->row_array();
    }

    public function getAllSubmenu(){
        $this->db->select('*');
        $this->db->from('user_sub_menu');
        $this->db->join('user_menu', 'user_menu.id_menu = user_sub_menu.menu_id');
        return $this->db->get()->result_array();
    }
    public function addSubMenu(){
        $is_active = 1;
        $is_active = $this->input->post('active');
        if($is_active == null){
            $is_active = 0;
        }
        $data = [
            'title' => $this->input->post('title'),
            'menu_id' => $this->input->post('menu_name'),
            'url' => $this->input->post('url'),
            'icon' => $this->input->post('icon'),
            'is_active' => $is_active
        ];
        $this->db->insert('user_sub_menu', $data);
    }
    public function deleteSubMenu($id)
    {
        $this->db->delete('user_sub_menu', ['id_sub' => $id]);
    }
    public function updateSubMenu(){
        $data = [
            'title' => $this->input->post('title'),
            'menu_id' => $this->input->post('menu_name'),
            'url' => $this->input->post('url'),
            'icon' => $this->input->post('icon'),
            'is_active' => $this->input->post('active')
        ];
        $this->db->where('id_sub', $this->input->post('id_sub'));
        $this->db->update('user_sub_menu', $data);
    }

    
}
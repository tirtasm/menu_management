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
        return$this->db->get_where('user_menu', ['id_menu' => $id])->row_array();
    }
    public function getEdit(){  
        echo json_encode($this->Menu_model->getMenuById($this->input->post('id_menu')));
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

    public function getSubMenuById($id)
    {
        return $this->db->get_where('user_sub_menu', ['id' => $id])->row_array();
    }

    public function getAllSubmenu(){
        $this->db->select('*');
        $this->db->from('user_sub_menu');
        $this->db->join('user_menu', 'user_menu.id_menu = user_sub_menu.menu_id');
        return $this->db->get()->result_array();

    }

    
}
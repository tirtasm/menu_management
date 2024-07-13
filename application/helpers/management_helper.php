<?php  
    function check_login(){
        $ci = get_instance();
        if(!$ci->session->userdata('email')){
            redirect('auth');
        }else{
            $role_id = $ci->session->userdata('id_role');
            $menu = $ci->uri->segment(1);   
            $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
            $menu_id = $queryMenu['id_menu'];
            $userAccess = $ci->db->get_where('user_access_menu', [
                'role_id' => $role_id,
                'id_menu' => $menu_id
            ]);
            if($userAccess->num_rows() < 1){
                // echo "Access Denied!";
                redirect('auth/blocked');
            }
        }
    }
     function check_access($role, $menu_id){
         $ci = get_instance();
         $ci->db->where('role_id', $role);
         $ci->db->where('id_menu', $menu_id);
         $result = $ci->db->get('user_access_menu');
         if($result->num_rows() > 0){
             return "checked='checked'";
        }
     }

?>
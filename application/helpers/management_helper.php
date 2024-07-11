<?php  
    function check_login(){
        get_instance();
        if(!get_instance()->session->userdata('email')){
            get_instance()->session->set_flashdata('login_failed', 'Login required!');
            redirect('auth/login');
        }else{
            $role_id = get_instance()->session->userdata('role_id');
            $menu = get_instance()->uri->segment(1);

            $queryMenu = get_instance()->db->get_where('user_menu', ['menu' => $menu])->row_array();
            $menu_id = $queryMenu['id_menu'];

            $userAccess = get_instance()->db->get_where('user_access_menu', [
                'role_id' => $role_id,
                'id_menu' => $menu_id
            ]);

            if($userAccess->num_rows() < 1){
                redirect('auth/blocked');
            }
        }
    }
?>
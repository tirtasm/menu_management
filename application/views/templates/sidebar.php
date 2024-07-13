<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">CodeIgninter</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">
    
    
    <!-- Query Menu -->
    <?php
    $role_id = $this->session->userdata('id_role');
    $query = "SELECT um.id_menu, um.menu
                FROM user_menu AS um JOIN user_access_menu AS uam
                ON um.id_menu = uam.id_menu
                WHERE uam.role_id = $role_id
                ORDER BY uam.id_menu ASC
                ";
    $menu = $this->db->query($query)->result_array();
    
    ?>
    <?php foreach ($menu as $m): ?>
        <div class="sidebar-heading">
            <?= $m['menu'] ?>
        </div>
        <?php
        $menuId = $m['id_menu'];
        $querySubMenu = "SELECT *
                            FROM user_sub_menu
                            WHERE menu_id = $menuId
                            AND is_active = 1
                            ";
        $subMenu = $this->db->query($querySubMenu)->result_array();
        ?>

        <div class="sidebar-heading">

        </div>
        <?php foreach ($subMenu as $sm): ?>
            <?php if ($judul == $sm['title']): ?>
                <li class="nav-item active">
                <?php else: ?>
                <li class="nav-item">
                <?php endif; ?>
                <a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>">
                    <i class="<?= $sm['icon']; ?>"></i>
                    <span><?= $sm['title']; ?></span></a>
                </li>
                <?php endforeach; ?>
                <hr class="sidebar-divider d-none d-md-block mt-2">
        <!-- Divider -->
        
    <?php endforeach; ?>
    <!-- Divider -->


    <div class="nav-item">
        <a class="nav-link" href="logout" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </div>



</ul>
<!-- End of Sidebar -->
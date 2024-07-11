
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $judul ?></h1>

    <div class="menu-flash" data-menuflash="<?= $this->session->flashdata('menu_flash'); ?>" data-submenu_added="<?=$this->session->flashdata('submenu_added');?>" data-submenu_failed="<?= $this->session->flashdata('submenu_failed'); ?>"></div>
    <div class="btn btn-primary mb-3 tombolTambah" data-toggle="modal" data-target="#formModal"
        >Add New Menu</div>
    <div class="row">
        <div class="col-lg-12 ">
            <table class="table table-hover table-responsive mx-4 ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tittle</th>
                        <th>Menu</th>
                        <th>URL</th>
                        <th>Icon</th>
                        <th>Active</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($sub_menu as $sm): ?>
                        <tr class="">
                            <th><?= $i ?></th>
                            <th><?= $sm['title'] ?></th>
                            <th><?= $sm['menu'] ?></th>
                            <th><?= $sm['url'] ?></th>
                            <th><?= $sm['icon'] ?></th>
                            <th class="text-center"><?= $sm['is_active'] ?></th>
                            <td class="d-flex align-items-center">
                                <a href="<?= base_url('menu/editsubmenu/') . $sm['id_sub'] ?>"
                                    class="badge mr-2 badge-success tampilModalEdit" data-toggle="modal" data-target="#formModal"
                                    data-id="<?= $sm['id_sub'] ?>">Edit</a>
                                <a href="<?= base_url('menu/deletesubmenu/') . $sm['id_sub'] ?>"
                                    class="badge mr-2 badge-danger delete">Delete</a>
                            </td>
                        </tr>
                        <?php $i++ ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Modal -->

<!-- Modal -->
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="judulModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel" >Add Sub Menu</h5>

                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?=base_url('menu/addsubmenu')?>" method="post">
                    <div class="row justify-content-center">

                        <div class="col-lg-10 align-items-center ">
                            <div class="mb-3">
                                <input type="hidden" id="id_sub" name="id_sub">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title">
                                <!-- <small class="form-text text-danger" id="menu-error"></small> -->
                            </div>
                            <div class="mb-3">
                                <label for="menu_name" class="form-label">Menu name</label>
                                <select name="menu_name" id="menu_name" class="form-control">
                                    <option value="">Select Menu</option>
                                    <?php foreach ($menu as $m): ?>
                                        <option value="<?= $m['id_menu'] ?>"><?= $m['menu'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <!-- <small class="form-text text-danger" id="menu-error"></small> -->
                            </div>
                            <div class="mb-3">
                                <label for="url" class="form-label">URL</label>
                                <input type="text" class="form-control" id="url" name="url">
                                <!-- <small class="form-text text-danger" id="menu-error"></small> -->
                            </div>
                            <div class="mb-3">
                                <label for="icon" class="form-label">Icon</label>
                                <input type="text" class="form-control" id="icon" name="icon">
                                <!-- <small class="form-text text-danger" id="menu-error"></small> -->
                            </div>
                            <div class="mb-3 ml-4">
                                <input type="checkbox" class="form-check-input" id="active" name="active" value="1">
                                <label for="active" class="form-check-label">Active</label>
                                <!-- <small class="form-text text-danger" id="menu-error"></small> -->
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
                <!-- <button type="button" id="editButton" class="btn btn-primary edit-button" data-id="" onclick="editMenu(this)" hidden>Edit</button> -->
            </div>
            </form>
        </div>
    </div>
</div>


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $judul ?></h1>

    
    <div class="menu-flash" data-menuflash="<?= $this->session->flashdata('menu_flash'); ?>" data-menuadded="<?=$this->session->flashdata('menu_added');?>" data-menufailed="<?= $this->session->flashdata('menu_failed'); ?>"></div>
    



    <div class="btn btn-primary mb-3 tombolTambah" data-toggle="modal" data-target="#formModal"
        >Add New Menu</div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-hover table-responsive mx-4 ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tittle</th>
                        <th>Menu</th>
                        <th>URL</th>
                        <th>Icon</th>
                        <th>Active</th>
                        
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
                            <th><?= $sm['is_active'] ?></th>
                            <td class="d-flex align-items-center">
                                <a href="<?= base_url('menu/edit/') . $sm['id_sub'] ?>"
                                    class="badge mr-2 badge-success tampilModalEdit" data-toggle="modal" data-target="#formModal"
                                    data-id="<?= $sm['id_sub'] ?>">Edit</a>
                                <a href="<?= base_url('menu/delete/') . $sm['id_sub'] ?>"
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
                <h5 class="modal-title" id="formModalLabel">Add New Menu</h5>

                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('menu/') ?>" method="post">
                    <div class="row justify-content-center">

                        <div class="col-lg-10 align-items-center ">
                            <div class="mb-3">
                                <input type="hidden" id="id_menu" name="id_menu">
                                <label for="menu" class="form-label">Menu name</label>
                                <input type="text" class="form-control" id="menu" name="menu" required>
                                <small class="form-text text-danger" id="menu-error"></small>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" >Add</button>
                <!-- <button type="button" id="editButton" class="btn btn-primary edit-button" data-id="" onclick="editMenu(this)" hidden>Edit</button> -->
            </div>
            </form>
        </div>
    </div>
</div>

<script>


</script>
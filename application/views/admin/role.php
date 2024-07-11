
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $judul ?></h1>

    
    <div class="role-flash" data-roleflash="<?= $this->session->flashdata('role_flash'); ?>" data-roleadded="<?=$this->session->flashdata('role_added');?>" data-rolefailed="<?= $this->session->flashdata('role_failed'); ?>"></div>
    



    <div class="btn btn-primary mb-3 btnAddRole" data-toggle="modal" data-target="#roleModal"
        >Add New Role</div>
    <div class="row">
        <div class="col-lg-10">
            <table class="table table-hover table-responsive mx-3">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($role as $rl): ?>
                        <tr>
                            <th scope="row"><?= $i ?></th>
                            <th scope="2"><?= $rl['role'] ?></th>
                            <td>
                                <a href="<?= base_url('admin/roleaccess/') . $rl['id_role'] ?>"
                                    class="badge badge-warning " 
                                    data-id="<?= $rl['id_role'] ?>">Access</a>
                                <a href="<?= base_url('admin/edit/') . $rl['id_role'] ?>"
                                    class="badge badge-success roleModalEdit" data-toggle="modal" data-target="#roleModal"
                                    data-id="<?= $rl['id_role'] ?>">Edit</a>
                                <a href="<?= base_url('admin/delete/') . $rl['id_role'] ?>"
                                    class="badge badge-danger delete">Delete</a>
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
<div class="modal fade" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="judulModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="roleModalLabel">Add New Role</h5>

                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/add') ?>" method="post">
                    <div class="row justify-content-center">

                        <div class="col-lg-10 align-items-center ">
                            <div class="mb-3">
                                <input type="hidden" id="id_role" name="id_role">
                                <label for="role" class="form-label">Role name</label>
                                <input type="text" class="form-control" id="role" name="role" required>
                                
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
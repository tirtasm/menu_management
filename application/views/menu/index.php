<div id="flashdata" data-login-success="<?= $this->session->flashdata('login_success'); ?>"
    data-login-error="<?= $this->session->flashdata('login_error'); ?>"></div>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $judul ?></h1>


    <div class="btn btn-primary mb-3" data-toggle="modal" data-target="#menuModal">Add New Menu</div>
    <div class="row">
        <div class="col-lg-6">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($menu as $m): ?>
                        <tr>
                            <th scope="row"><?= $i ?></th>
                            <th scope="2"><?= $m['menu'] ?></th>
                            <td>
                                <a href="" class="badge badge-success">Edit</a>
                                <a href="" class="badge badge-danger">Delete</a>
                            </td>
                        </tr>
                        <?php $i++ ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->


<!-- Modal -->


<div class="modal fade" id="menuModal" tabindex="-1" role="dialog" aria-labelledby="menuModal-Label"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="menuModal-Label">Add New Menu</h5>

                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="addMenuForm" action="<?= base_url('menu/add')?>" method="post">
                <div class="modal-body">
                    <div class="row justify-content-center">

                        <div class="col-lg-10 align-items-center ">
                            <div class="mb-3">
                                <label for="menu" class="form-label">Menu name</label>
                                <input type="text" class="form-control" id="menu" name="menu" >
                                <small class="form-text text-danger" id="menu-error"></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addMenu()">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function addMenu() {
        var menuInput = document.getElementById("menu");
        var menuError = document.getElementById("menu-error");

        if (menuInput.value.trim() === "") {
            menuError.textContent = "Menu name is required.";
        } else {
            menuError.textContent = ""; // Clear the error message
            document.getElementById("addMenuForm").submit();
        }
    }
</script>


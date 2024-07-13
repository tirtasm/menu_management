<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $judul ?></h1>

    <div class="ml-5 col-lg-3">

        <?=$this->session->flashdata('message');?>
    </div>
    <div class="row ml-5">
        <div class="col-lg-4">
            <form action="<?=base_url('user/changepassword')?>" method="post">
                <div class="mb-3">
                    <label for="currentpassword" class="form-label">Current Password</label>
                    <input type="password" class="form-control" id="currentpassword" name="currentpassword">
                    <?= form_error('currentpassword', '<small class="text-danger pl-2">', '</small>'); ?>
                </div>
                <div class="mb-3">
                    <label for="newpass" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="newpass" name="newpass">
                    <?= form_error('newpass', '<small class="text-danger pl-2">', '</small>'); ?>
                </div>
                <div class="mb-3">
                    <label for="repass" class="form-label">Repeat Password</label>
                    <input type="password" class="form-control" id="repass" name="repass">
                    <?= form_error('repass', '<small class="text-danger pl-2">', '</small>'); ?>
                </div>

                
                    <button type="submit" class="btn px-4 mt-1 btn-primary">Edit</button>
                
            </form>
        </div>
    </div>


</div>
<body class="bg-gradient-primary">
    
<div class="container min-vh-100 align-content-center">

    <!-- Outer Row -->
    <div class="row  justify-content-center">

<div class="col-lg-5">
    

        <div class="card p-5 border-0 shadow-lg">
        <?=$this->session->flashdata('message');?>            

            <!-- Nested Row within Card Body -->
                          
                    <div class="px-4 pt-3">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-2">Change Your Password for</h1>
                            <h5><?=$this->session->userdata('reset_email')?></h5>
                        </div>
                        <form action="<?=base_url('auth/changepassword')?>" method="post">
                            <div class="form-group">
                                <input type="password" class="form-control" id="newpass" name="newpass"
                                    aria-describedby="emailHelp" placeholder="Enter New Password...">
                                <?= form_error('newpass', '<small class="text-danger pl-2">', '</small>'); ?>
                                <?=$this->session->flashdata('validasi');?>
                                
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="repass" name="repass"
                                    aria-describedby="emailHelp" placeholder="Enter Repeat Password...">
                                <?= form_error('repass', '<small class="text-danger pl-2">', '</small>'); ?>
                                <?=$this->session->flashdata('validasi');?>
                                
                            </div>
                            <button type="submit" class="btn btn-primary  btn-block">
                                Reset Password
                            </button>
                        </form>
                       
                    </div>
                </div>
            </div>
    
    </div>
    
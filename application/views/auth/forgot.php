<body class="bg-gradient-primary">
    
<div class="container min-vh-100 align-content-center">

    <!-- Outer Row -->
    <div class="row  justify-content-center">

<div class="col-lg-5">
    

        <div class="card p-5 border-0 shadow-lg">
        <?=$this->session->flashdata('check_email');?>            

             
                    <div class="px-4 py-3">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                            <p class="mb-4">We get it, stuff happens. Just enter your email address below
                                and we'll send you a link to reset your password!</p>
                        </div>
                        <form action="<?=base_url('auth/forgotpassword')?>" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" id="email" name="email" value="<?= set_value('email'); ?>"
                                    aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                <?= form_error('email', '<small class="text-danger pl-2">', '</small>'); ?>
                                <?=$this->session->flashdata('validasi');?>
                                
                            </div>
                            <button type="submit" class="btn btn-primary  btn-block">
                                Reset Password
                            </button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="<?= base_url(); ?>auth/registration">Create an Account!</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="<?= base_url(); ?>auth/login">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
    
    </div>
    
<div class="container min-vh-100 align-content-center ">

        <div class="card o-hidden border-0 shadow-lg col-lg-5 mx-auto">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    
                    <div class="col">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
                            <form  method="post" action="<?=base_url('auth/registration');?>">
                                <div class=" row mb-3">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control " id="fullname" name="fullname" value="<?=set_value('fullname')?>"
                                            placeholder="Fullname">
                                        </div>
                                        <?=form_error('fullname', '<small class="text-danger mt-1 mx-3">',' </small>');?>
                                </div>
                                <div class=" row mb-3">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control form" id="email" name="email" value="<?=set_value('email')?>"
                                            placeholder="Email Address">
                                        </div>
                                        <?=form_error('email', '<small class="text-danger mt-1 mx-3">',' </small>');?>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control" name="password1" value="<?=set_value('password1')?>"
                                            id="password1" placeholder="Password">
                                            <?=form_error('password1', '<small class="text-danger  mt-1 mx-2">',' </small>');?>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control" name="password2" 
                                            id="password2" placeholder="Repeat Password">
                                            <?=form_error('password2', '<small class="text-danger  mt-1 mx-2 ">',' </small>');?>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">
                                    Register Account
                                </button>
                               
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="<?=base_url()?>auth/login">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
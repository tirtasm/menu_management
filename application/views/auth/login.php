<body class="bg-gradient-primary">
        <div class="container min-vh-100 align-content-center">
            <div class="row justify-content-center">

                <div class="col-lg-5">


                    <div class="card o-hidden border-0 shadow-lg">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                
                                <div class="col">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Login Page</h1>
                                        </div>
                                        
                                        <?=$this->session->flashdata('message')?>

                                        <div id="flashdata" data-login-success="<?= $this->session->flashdata('login_success'); ?>" data-login-error="<?= $this->session->flashdata('login_error'); ?>"></div>
                                        
                                            <?=$this->session->flashdata('email_message')?>
                                        
                                        <form class="user" method="post">
                                            <div class="form-group">

                                            <input type="text" class="form-control " id="email" name="email" value="<?=set_value('email')?>"
                                                placeholder="Email Address">
                                                <?=form_error('email', '<small class="text-danger mt-1 mx-2">',' </small>');?>
                                            </div>



                                            <div class="form-group">
                                                <input type="password" class="form-control" id="password" name="password" 
                                                    id="password" placeholder="Password">
                                                    <?=form_error('password', '<small class="text-danger mx-2">', '</small>')?>
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control mx-2 custom-checkbox small">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck">
                                                    <label class="custom-control-label " for="customCheck">Remember
                                                        Me</label>
                                                </div>
                                            </div>
                                            <button type="submit" id="btnLogin" class="btn btn-primary btn-block btnLogin" >
                                                Login
                                            </button>
                                            
                                        </form>
                                        
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="<?=base_url()?>auth/forgotpassword">Forgot Password?</a>
                                        </div>
                                        <div class="text-center">
                                            <a class="small" href="<?=base_url()?>auth/registration">Create an Account!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
        
    
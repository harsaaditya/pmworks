<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>PMWORKS | vci.3 b.0.1</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
  <meta content="Metamorfosis" name="author" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- App favicon -->
  <link rel="shortcut icon" href="<?php echo base_url('pmworks/assets'); ?>/images/favicon.ico">

  <!-- App css -->
  <link href="<?php echo base_url('pmworks/assets'); ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
  <link href="<?php echo base_url('pmworks/assets'); ?>/css/icons.min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('pmworks/assets'); ?>/css/app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet" />

</head>

<body class="authentication-bg bg-primary authentication-bg-pattern d-flex align-items-center pb-0 vh-100">

  <div class="account-pages w-100 mt-5 mb-5">
    <div class="container">

      <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
          <div class="card mb-0">

            <div class="card-body p-4">

              <div class="account-box">
                <div class="account-logo-box">
                  <div class="text-center">
                    <a href="index.html">
                      <img src="<?php echo base_url('pmworks/assets'); ?>/images/logo-dark.png" alt="" height="30">
                    </a>
                  </div>
                  <h5 class="text-uppercase mb-1 mt-4">Sign In</h5>
                  <p class="mb-0">Login to your Admin account</p>
                </div>

                <div class="account-content mt-4">
                  <?php $attributes = array('class' => 'form-horizontal');
                  echo form_open('mian/auth/login'); ?>

                  <div class="form-group row">
                    <div class="col-12">
                      <label for="emailaddress">Email address</label>
                      <?php $data = array(
                        'type' => 'email',
                        'name' => 'email',
                        'id' => 'emailaddress',
                        'class' => 'form-control',
                        'required' => '',
                        'placeholder' => 'Enter your email'
                      );
                      echo form_input($data); ?>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-12">
                      <a href="<?php echo base_url($system_settings->system_login . '/auth/forgot_password'); ?>" class="text-muted float-right"><small>Forgot your password?</small></a>
                      <label for="password">Password</label>
                      <?php $data = array(
                        'type' => 'password',
                        'name' => 'password',
                        'id' => 'password',
                        'class' => 'form-control',
                        'required' => '',
                        'placeholder' => 'Enter your password'
                      );
                      echo form_input($data); ?>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-12">

                      <div class="checkbox checkbox-success">
                        <?php $data = array(
                          'type' => 'checkbox',
                          'name' => 'remember_me',
                          'id' => 'remember'
                        );
                        echo form_input($data); ?>
                        <label for="remember">
                          Remember me
                        </label>
                      </div>

                    </div>
                  </div>

                  <div class="form-group row text-center mt-2">
                    <div class="col-12">
                      <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="submit">Sign In</button>
                    </div>
                  </div>

                  <?php echo form_close(); ?>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="text-center">
                        <button type="button" class="btn mr-1 btn-facebook waves-effect waves-light">
                          <i class="fab fa-facebook-f"></i>
                        </button>
                        <button type="button" class="btn mr-1 btn-googleplus waves-effect waves-light">
                          <i class="fab fa-google"></i>
                        </button>
                        <button type="button" class="btn mr-1 btn-twitter waves-effect waves-light">
                          <i class="fab fa-twitter"></i>
                        </button>
                      </div>
                    </div>
                  </div>

                  <div class="row mt-4 pt-2">
                    <div class="col-sm-12 text-center">
                      <p class="text-muted mb-0">&copy; 2020 <?php echo (date('Y') != '2020') ? '- ' . date('Y') : ''; ?> PMWORKS. by <a href="#" class="text-dark"><b>Mian</b></a></p>
                    </div>
                  </div>

                </div>
              </div>
            </div>

          </div>
          <!-- end card-body -->
        </div>
        <!-- end card -->
      </div>
      <!-- end row -->
    </div>
    <!-- end container -->
  </div>
  <!-- end page -->

  <!-- Vendor js -->
  <script src="<?php echo base_url('pmworks/assets'); ?>/js/vendor.min.js"></script>

  <!-- App js -->
  <script src="<?php echo base_url('pmworks/assets'); ?>/js/app.min.js"></script>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Cobra CMS | Beta 1.0</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="andreyansyah">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="<?= base_url('management') ?>/assets/images/logo.png">
    <link href="<?= base_url('management') ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('management') ?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('management') ?>/assets/css/app.min.css" rel="stylesheet" type="text/css" />

</head>

<body class="authentication-bg authentication-bg-pattern">

    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-pattern">

                        <div class="card-body p-4">

                            <div class="text-center w-75 m-auto">
                                <a href="">
                                    <span><img src="<?= base_url('management') ?>/assets/images/logo-dark.png" alt="" height="40"></span>
                                </a>
                                <p class="text-muted mb-4 mt-3">Change new password</p>
                            </div>
                            <?php $system_settings = $this->db->get_where('system_settings', array('id' => '1'))->row(); ?>
                            <?php echo form_open($system_settings->system_login.'/login/change_password/'.$token); ?>
                            <?php echo $this->session->flashdata('message');?>
                                <div class="form-group mb-3">
                                    <label>New Password</label>
                                    <input class="form-control" name="password_1" type="password" required="" autocomplete="off">
                                </div>

                                <div class="form-group mb-3">
                                    <label>Repeat New Password</label>
                                    <input class="form-control" name="password_2" type="password" required="" autocomplete="off">
                                </div>

                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-dark btn-block" type="submit"> Submit </button>
                                </div>

                                <?php echo form_close(); ?>

                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card -->

                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->
    <footer class="footer footer-alt text-white">
        2020 &copy; Cobra CMS by <a class="text-white" href="#">Andreyansyah</a>
    </footer>
    <script src="<?= base_url('management') ?>/assets/js/vendor.min.js"></script>
    <script src="<?= base_url('management') ?>/assets/js/app.min.js"></script>
</body>

</html>
</div>
<!-- END wrapper -->

<!-- Right Sidebar -->
<div class="right-bar">
  <div class="rightbar-title">
    <a href="javascript:void(0);" class="right-bar-toggle float-right">
      <i class="mdi mdi-close"></i>
    </a>
    <h4 class="font-16 m-0 text-white">Theme Customizer</h4>
  </div>
  <div class="slimscroll-menu">

    <div class="p-3">
      <div class="alert alert-warning" role="alert">
        <strong>Customize </strong> the overall color scheme, layout, etc.
      </div>
      <div class="mb-2">
        <img src="<?php echo base_url('pmworks/assets'); ?>/images/layouts/light.png" class="img-fluid img-thumbnail" alt="">
      </div>
      <div class="custom-control custom-switch mb-3">
        <input type="checkbox" class="custom-control-input theme-choice" id="light-mode-switch" checked />
        <label class="custom-control-label" for="light-mode-switch">Light Mode</label>
      </div>

      <div class="mb-2">
        <img src="<?php echo base_url('pmworks/assets'); ?>/images/layouts/dark.png" class="img-fluid img-thumbnail" alt="">
      </div>
      <div class="custom-control custom-switch mb-3">
        <input type="checkbox" class="custom-control-input theme-choice" id="dark-mode-switch" data-bsStyle="<?php echo base_url('pmworks/assets'); ?>/css/bootstrap-dark.min.css" data-appStyle="<?php echo base_url('pmworks/assets'); ?>/css/app-dark.min.css" />
        <label class="custom-control-label" for="dark-mode-switch">Dark Mode</label>
      </div>

      <div class="mb-2">
        <img src="<?php echo base_url('pmworks/assets'); ?>/images/layouts/rtl.png" class="img-fluid img-thumbnail" alt="">
      </div>
      <div class="custom-control custom-switch mb-3">
        <input type="checkbox" class="custom-control-input theme-choice" id="rtl-mode-switch" data-appStyle="<?php echo base_url('pmworks/assets'); ?>/css/app-rtl.min.css" />
        <label class="custom-control-label" for="rtl-mode-switch">RTL Mode</label>
      </div>

      <div class="mb-2">
        <img src="<?php echo base_url('pmworks/assets'); ?>/images/layouts/dark-rtl.png" class="img-fluid img-thumbnail" alt="">
      </div>
      <div class="custom-control custom-switch mb-5">
        <input type="checkbox" class="custom-control-input theme-choice" id="dark-rtl-mode-switch" data-bsStyle="<?php echo base_url('pmworks/assets'); ?>/css/bootstrap-dark.min.css" data-appStyle="<?php echo base_url('pmworks/assets'); ?>/css/app-dark-rtl.min.css" />
        <label class="custom-control-label" for="dark-rtl-mode-switch">Dark RTL Mode</label>
      </div>

      <a href="https://1.envato.market/y2YAD" class="btn btn-danger btn-block mt-3" target="_blank"><i class="mdi mdi-download mr-1"></i> Download Now</a>
    </div>
  </div>
  <!-- end slimscroll-menu-->
</div>
<!-- /Right-bar -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<a href="javascript:void(0);" class="right-bar-toggle demos-show-btn">
  <i class="mdi mdi-settings-outline mdi-spin"></i> &nbsp;Choose Demos
</a>

<!-- Vendor js -->
<script src="<?php echo base_url('pmworks/assets'); ?>/js/vendor.min.js"></script>

<!--C3 Chart-->
<script src="<?php echo base_url('pmworks/assets'); ?>/libs/d3/d3.min.js"></script>
<script src="<?php echo base_url('pmworks/assets'); ?>/libs/c3/c3.min.js"></script>

<script src="<?php echo base_url('pmworks/assets'); ?>/libs/echarts/echarts.min.js"></script>

<script src="<?php echo base_url('pmworks/assets'); ?>/js/pages/dashboard.init.js"></script>

<!-- App js -->
<script src="<?php echo base_url('pmworks/assets'); ?>/js/app.min.js"></script>

</body>

</html>
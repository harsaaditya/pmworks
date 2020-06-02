<?php
$ip      = $_SERVER['REMOTE_ADDR'];
$tanggal = date("Ymd");
$waktu   = time();
$bln     = date("m");
$tgl     = date("d");
$blan    = date("Y-m");
$thn     = date("Y");
$tglk    = $tgl - 1;
$tabeldb = 'statistics';

$label = $this->db->query("SELECT * FROM $tabeldb GROUP BY date LIMIT 30");
$label = $this->db->query("SELECT * FROM $tabeldb GROUP BY date");

if ($tglk == '1' | $tglk == '2' | $tglk == '3' | $tglk == '4' | $tglk == '5' | $tglk == '6' | $tglk == '7' | $tglk == '8' | $tglk == '9') {
  $kemarin = $this->db->query("SELECT * FROM $tabeldb WHERE date='$thn-$bln-0$tglk'");
} else {
  $kemarin = $this->db->query("SELECT * FROM $tabeldb WHERE date='$thn-$bln-$tglk'");
}

$bulan = $this->db->query("SELECT * FROM $tabeldb WHERE date LIKE '%$blan%'");
$bulan1 = $bulan->num_rows();
$tahunini = $this->db->query("SELECT * FROM $tabeldb WHERE date LIKE '%$thn%'");
$tahunini1 = $tahunini->num_rows();
$pengunjung = $this->db->query("SELECT * FROM $tabeldb WHERE date='$tanggal' GROUP BY ip")->num_rows();
$totalpengunjung = $this->db->query("SELECT * FROM $tabeldb ")->num_rows();
$hits = $this->db->query("SELECT SUM(hits) as hitstoday FROM $tabeldb WHERE date='$tanggal' GROUP BY date")->result_array();
$totalhits = $this->db->query("SELECT SUM(hits) FROM $tabeldb")->result_array();
$bataswaktu  = time() - 300;
$pengunjungonline = $this->db->query("SELECT * FROM $tabeldb WHERE online > '$bataswaktu'")->num_rows();
$kemarin1  = $kemarin->num_rows();
?>

<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

<div class="content-page">
  <div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

      <!-- start page title -->
      <div class="row">
        <div class="col-12">
          <div class="page-title-box">
            <div class="page-title-right">
              <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="<?php echo base_url('mian/dashboard'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item text-capitalize active"><?php echo $controller; ?></li>
              </ol>
            </div>
            <h4 class="page-title text-capitalize"><?php echo $controller; ?></h4>
          </div>
        </div>
      </div>
      <!-- end page title -->



    </div>
    <!-- end container-fluid -->

  </div>
  <!-- end content -->

  <!-- Footer Start -->
  <footer class="footer">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          &copy; 2020 <?php echo (date('Y') != '2020') ? '- ' . date('Y') : ''; ?> PMWORKS. by <a href="#" class="text-dark"><b>Mian</b></a>
        </div>
      </div>
    </div>
  </footer>
  <!-- end Footer -->

</div>

<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->

<script src="<?= base_url() ?>/assets/libs/morris-js/morris.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/raphael/raphael.min.js"></script>
<script>
  Morris.Bar({
    element: 'visitor',
    data: <?php echo $get_stat; ?>,
    xkey: 'date',
    ykeys: ['total_hit', 'total_ip'],
    labels: ['HITS', 'Visitor'],
    barColors: ["#02c0ce", "#0acf97"]
  });
  $("#dash-daterange").flatpickr({
    altInput: !0,
    altFormat: "F j, Y",
    dateFormat: "Y-m-d",
    defaultDate: "today"
  });
</script>
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <h4 class="font-weight-bold mb-0">Dashboard</h4>
      </div>
    </div>
  </div>
</div>
<style>
  .stretch-card{
    border-radius:10px;
  }
</style>
<div class="row">
  <?php 
  $total = $konek->query("SELECT count(sudah_memilih) as total FROM tbl_peserta_pemilihan")->fetch_assoc()['total'];
  $sudah = $konek->query("SELECT count(sudah_memilih) as sudah FROM tbl_peserta_pemilihan WHERE sudah_memilih='1'")->fetch_assoc()['sudah'];
  $belum = $konek->query("SELECT count(sudah_memilih) as belum FROM tbl_peserta_pemilihan WHERE sudah_memilih='0'")->fetch_assoc()['belum'];
  $total_persen_belum_memilih = 0;
  if($belum != 0){
    $total_persen_belum_memilih = $belum/$total*100;
  }
  $total_persen_sudah_memilih = 0;
  if($sudah != 0){
    $total_persen_sudah_memilih = $sudah/$total*100;

  }


  $total_keseluruhan_suara = $konek->query("SELECT count(*) as totals FROM tbl_kotak_suara")->fetch_assoc()['totals'];

  ?>
  <div class="col-md-3 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <p class="card-title text-md-center text-xl-left">Total peserta Pemilihan</p>
        <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
          <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0"><?= $total ?></h3>
          <i class="ti-user icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
        </div>  
      </div>
    </div>
  </div>
  <div class="col-md-3 grid-margin stretch-card">
    <?php
    $get_calon = $konek->query("SELECT count(*) as totals FROM tbl_calon")->fetch_assoc()['totals'];
    ?>
    <div class="card">
      <div class="card-body">
        <p class="card-title text-md-center text-xl-left">Total Calon</p>
        <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
          <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0"><?= $get_calon ?></h3>
          <i class="ti-face-smile icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
        </div>  
      </div>
    </div>
  </div>
  <div class="col-md-3 grid-margin stretch-card">

    <div class="card">
      <div class="card-body">
        <p class="card-title text-md-center text-xl-left">Sudah Memilih</p>
        <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
          <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0"><?= $sudah ?></h3>
          <i class="ti-check icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
        </div>  
        <p class="mb-0 mt-2 text-success"><?= round($total_persen_sudah_memilih,1); ?>%</p>
      </div>
    </div>
  </div>
  <div class="col-md-3 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <p class="card-title text-md-center text-xl-left">Belum memilih</p>
        <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
          <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0"><?= $belum ?></h3>
          <i class="ti-thumb-up icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
        </div>  
        <p class="mb-0 mt-2 text-danger"><?= round($total_persen_belum_memilih,1); ?>%</p>
      </div>
    </div>
  </div>
</div>
<!-- report -->
<?php
if (isset($_SESSION['level']) && $_SESSION['level'] == 'admin')
{
  ?>
  <div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card position-relative">
      <div class="card-body">
        <p class="card-title">Hasil Pemilihan</p>
        <div class="row">
          <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-center">
            <div class="ml-xl-4">
              <h4><?php echo $total_keseluruhan_suara ?> Suara</h4>
              <p class="text-muted mb-2 mb-xl-0">
                Suara yang tertera di sini adalah hasil Perhitungan, pasti data ini akurat karena di hitung oleh sistem
              </p>
            </div>  
          </div>
          <div class="col-md-12 col-xl-9">
            <div class="row">
              <div class="col-md-6 mt-3 col-xl-5">
                <canvas id="north-america-chart"></canvas>
                <div id="north-america-legend"></div>
              </div>
              <div class="col-md-6 col-xl-7">
                <div class="table-responsive mb-3 mb-md-0">
                  <table class="table table-borderless report-table">
                    <?php 

                    if(!empty(get_calon())){
                      foreach (get_calon() as $value) {
                        ?>
                        <tr>
                          <td class="text-muted"><?= $value['nama_calon'] ?>- calon <?= sprintf("%02s",$value['no_calon']) ?></td>
                          <td class="w-100 px-0">
                            <div class="progress progress-md mx-4">
                              <div class="progress-bar bg-primary" role="progressbar" style="width: <?= round($value['total_persen']) ?>%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td><h5 class="font-weight-bold mb-0"><?= $value['total_suara'] ?> Suara</h5></td>
                        </tr>
                        <?php
                      }
                    }

                    ?>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="assets/vendors/chart.js/Chart.min.js"></script>

<script>
  if ($("#north-america-chart").length) {

    var areaData = {
      labels: [

      <?php
      if(!empty(get_calon())){
       foreach(get_calon() as $data){
        echo "'{$data['nama_calon']}',";
      }
    }else{
      echo "'j','3'";
    }
    ?>

    ],
    datasets: [{
      data: [
      <?php
      if(!empty(get_calon())){
       foreach(get_calon() as $data){
        echo "'{$data['total_persen']}',";
      }
    }else{
      echo "'j','3'";
    }
    ?>

    ],
    backgroundColor: [
    "#71c016", "#58d8a3", "#248afd","#ff4747","#6a008a"
    ],
    borderColor: "rgba(0,0,0,0)"
  }
  ]
};

var areaOptions = {
  responsive: true,
  maintainAspectRatio: true,
  segmentShowStroke: false,
  cutoutPercentage: 78,
  elements: {
    arc: {
      borderWidth: 4
    }
  },      
  legend: {
    display: false
  },
  tooltips: {
    enabled: true
  },
  legendCallback: function(chart) { 
    var text = [];
    <?php
    if(!empty(get_calon())){
      $i = 0;
      foreach(get_calon() as $data){
       $i++;
       ?>
       text.push('<div class="report-chart">');
       text.push('<div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center"><div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: ' + chart.data.datasets[0].backgroundColor[<?= $i-1 ?>] + '"></div><p class="mb-0"><?= $data['nama_calon'] ?></p></div>');
       text.push('<p class="mb-0"><?= $data['total_persen'] ?> %</p>');
       text.push('</div>');
       <?php
     }
   }else{
    echo "'j','3'";
  }
  ?>

  return text.join("");
},
}
var northAmericaChartPlugins = {
  beforeDraw: function(chart) {
    var width = chart.chart.width,
    height = chart.chart.height,
    ctx = chart.chart.ctx;

    ctx.restore();
    var fontSize = 3.125;
    ctx.font = "600 " + fontSize + "em sans-serif";
    ctx.textBaseline = "middle";
    ctx.fillStyle = "#000";
    ctx.save();
  }
}
var northAmericaChartCanvas = $("#north-america-chart").get(0).getContext("2d");
var northAmericaChart = new Chart(northAmericaChartCanvas, {
  type: 'doughnut',
  data: areaData,
  options: areaOptions,
  plugins: northAmericaChartPlugins
});
document.getElementById('north-america-legend').innerHTML = northAmericaChart.generateLegend();
}
</script>
  <?php
}
?>

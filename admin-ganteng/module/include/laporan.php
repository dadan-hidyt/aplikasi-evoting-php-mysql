<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <span class="mb-0"><a href="?mod=index">Dashboard</a> &raquo; laporan</span>
      </div>
    </div>
  </div>
</div>
<!-- laporan -->
<div class="row">
<div class="col-md-12 grid-margin">
 <div class="card">
   <div class="card-body">
     <h4 class="card-title">MENU LAPORAN</h4>
     <?php
     if (isset($_SESSION['level']) && $_SESSION['level'] == 'admin')
     {
      ?>
    <a href="print.php?data_print_type=hasil_pemilihan" class="btn col-md-2 btn-primary">Hasil Pemilihan</a>&nbsp;    
      <?php
     }     
     ?>
        <a href="print.php?data_print_type=data_peserta" class="btn col-md-2 btn-primary">Data peserta</a>&nbsp;    
     </div>
   </div>
 </div>
</div>
</div>

<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <spans><a href="?mod=index">dashboard</a> &raquo; <a href="?mod=data_peserta">Data Peserta</a> &raquo; edit</spans>
      </div>
    </div>
  </div>
</div>
<!-- data calon -->
<div class="row">
  <style>
    .form-control,
    .btn{
      height: 100%;
      padding: 10px;
    }
  </style>
  <?php
  if(isset($_POST['update'])){
    $id = $_GET['id_data'];
    $nama = secure($_POST['peserta']);
    $update = $konek->query("UPDATE tbl_peserta_pemilihan set nama='$nama' WHERE id='$id'");
    if($update){
      echo "<script>alert('Data berhasil di update');window.location.href='?mod=data_peserta';</script>";
    }else{
      echo "<script>alert('Data gagal di update');window.location.href='?mod=data_peserta';</script>";
    }
  }

  if(empty($_GET['id_data'])){
      echo "<script>window.location.href='?mod=data_calon';</script>";
  }
  $no = $_GET['id_data'];
  $data_calon = $konek->query("SELECT * FROM tbl_peserta_pemilihan WHERE id='$no'");
  if($data_calon->num_rows == 1){
    $data = $data_calon->fetch_object();
  }
  ?>
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Edit Peserta</h4>
        <form method="POST" action="" method="POST" class="forms-sample">
         
        <div class="form-group">
            <label for="exampleInputUsername1">Nama baru</label>
            <input name="peserta" type="text" value="<?= $data->nama ?>" class="form-control" id="exampleInputUsername1" placeholder="nama">
          </div>
          <button type="submit" name="update" class="btn btn-primary mr-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>  

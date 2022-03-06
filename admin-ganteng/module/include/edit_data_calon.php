<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <h4 class="font-weight-bold mb-0">Dashboard/data-calon</h4>
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
  if(empty($_GET['data_edit'])){
      echo "<script>window.location.href='?mod=data_calon';</script>";
  }
  $no = $_GET['data_edit'];
  $data_calon = $konek->query("SELECT * FROM tbl_calon WHERE no_calon='$no'");
  if($data_calon->num_rows == 1){
    $data = $data_calon->fetch_object();
  }
  ?>
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Edit calon</h4>
        <form method="POST" enctype="multipart/form-data" method="POST" action="?mod=data_calon&action=edit_data_calon" class="forms-sample">
         
        <div class="form-group">
            <label for="exampleInputUsername1">Nama calon</label>
            <input name="nama_calon" type="text" value="<?= $data->nama_calon ?>" class="form-control" id="exampleInputUsername1" placeholder="Username">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">No calon</label>
            <input name="id_calon"  readonly value="<?= $data->no_calon ?>" class="form-control" id="exampleInputEmail1" placeholder="Email">
          </div>

          <div class="form-group">
            <label for="exampleInputPassword1">Foto calon</label>
            <input name="foto" type="file" class="form-control" id="exampleInputPassword1" placeholder="Password">
          </div>

          <div class="form-group">
            <label for="exampleInputConfirmPassword1">Visi misi</label>
            <textarea name="desc" class="form-control" id="" cols="30" rows="10">
              <?= $data->description; ?>
            </textarea>
          </div>
          <button type="submit" name="update" class="btn btn-primary mr-2">Submit</button>
          <button class="btn btn-warning">Cancel</button>
        </form>
      </div>
    </div>
  </div>
</div>  

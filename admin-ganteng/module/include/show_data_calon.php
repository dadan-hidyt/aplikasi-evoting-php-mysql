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
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Tabel calon</h4>
        <p class="card-description">
          <button type="button"  data-toggle="modal" data-target="#add" class="btn btn-primary btn-sm">Tambah <i class="ti-plus"></i></button>
        </p>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>
                  Foto
                </th>
                <th>
                  No/Nama calon
                </th>
                <th>
                  Persentase suara
                </th>
                <th>
                  Total suara
                </th>
                <th>
                  Action
                </th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty(get_calon())): ?>
                <?php foreach (get_calon() as $key): ?>
                 <tr>
                  <td class="py-1">
                    <img src="../<?= $key['foto'] ?>" alt="image"/>
                  </td>
                  <td>
                    <?php echo sprintf("%02s",$key['no_calon']) ?> <?php echo $key['nama_calon'] ?>
                  </td>
                  <td>
                    <div class="progress">
                      <div class="progress-bar bg-<?= round($key['total_persen']) >= 50 ? "primary" : "danger" ?>" role="progressbar" style="width: <?= round($key['total_persen']); ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>&nbsp;<small><?= round($key['total_persen']); ?>%</small>
                    </div>
                  </td>
                  <td>
                    <?php echo $key['total_suara'] ?> Suara
                  </td>
                  <td>
                    <a class="btn btn-primary btn-sm" href="?mod=data_calon&action=edit&data_edit=<?= $key['no_calon'] ?>"><i class="ti-pencil-alt"></i></a> |
                     <a onclick="return confirm('apakah anda yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm" href="?mod=data_calon&action=delete&data_id=<?= $key['no_calon'] ?>"><i class="ti-trash"></i></a>
                  </td>
                </tr>
              <?php endforeach ?>
            <?php endif ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</div>  


<!-- Modal add -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah data calon</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form enctype="multipart/form-data" action="?mod=data_calon&action=tambah_data_calon" method="POST">
         <div class="mt-2">
          <input required type="text" name="nama_calon" class="form-control" placeholder="Nama calon">
        </div>
        <div class="mt-2">
          <input required accept="image/*" type="file" name="foto" class="form-control" placeholder="foto">
        </div>
        <div class="mt-2">
          <?php 
          $no_calon_terakhir = $konek->query("SELECT max(no_calon) as nomor FROM tbl_calon")->fetch_assoc()['nomor'];
          $no_calon_terakhir++;
          ?>
          <input required type="text" name="no_calon" class="form-control" placeholder="No calon" value="<?= $no_calon_terakhir; ?>" readonly>
        </div>
        <div class="mt-2">
         <textarea required name="desc" name="" id="" cols="30" rows="10" placeholder="Visi misi " class="form-control">
           <div class="visi">
            <h4>VISI</h4>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Est eaque nesciunt dolore repellendus adipisci quod dignissimos beatae labore, quae, amet esse nemo expedita dolores itaque.</p>
          </div>
          <ul class="misi mt-3">
            <h4>MISI</h4>
            <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illum, perspiciatis inventore. Nostrum, iste nisi dolor aperiam temporibus officia praesentium! Explicabo?</li>
            <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illum, perspiciatis inventore. Nostrum, iste nisi dolor aperiam temporibus officia praesentium! Explicabo?</li>
            <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illum, perspiciatis inventore. Nostrum, iste nisi dolor aperiam temporibus officia praesentium! Explicabo?</li>
          </ul>
        </textarea>
      </div>
    </div>
    <div class="modal-footer">
      <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
    </div>
  </form>

</div>
</div>
</div>
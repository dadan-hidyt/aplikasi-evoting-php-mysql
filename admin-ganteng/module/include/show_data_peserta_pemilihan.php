<div class="row">
  <style>
    #reset {
      display:block;
    }
    #reset.rotate{
      animation:rotate 2s ease-in-out infinite;
    }
    @keyframes rotate {
      from{
        transform:rotate(0deg);
      }to{
        transform:rotate(360deg);

      }
    }
  </style>
  <div class="col-md-12 grid-margin">
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <span class="mb-0"><a href="?mod=index">Dashboard</a> &raquo; data peserta pemilihan</span>
      </div>
    </div>
  </div>
</div>
<?php 
$data_p = array();
$datas = $konek->query(
  "SELECT 
    tbl_peserta_pemilihan.*,tbl_peserta_pemilihan.id as u_id,
    tbl_kotak_suara.*,tbl_kotak_suara.id as kotak_suara_id,
    tbl_calon.*,tbl_calon.id as id_tbl_calon
   FROM tbl_peserta_pemilihan
  LEFT JOIN tbl_kotak_suara ON tbl_kotak_suara.user_id = tbl_peserta_pemilihan.id
  LEFT JOIN tbl_calon ON tbl_calon.no_calon=tbl_kotak_suara.pilihan");

while($dd = $datas->fetch_assoc()){
 $data_p[] = $dd;
}

?>
<!-- tabel peserta pemilihan -->
<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Data peserta pemilihan</h4>
        <div class="card-description">
          <button type="button"  data-toggle="modal" data-target="#AddDataPemilih" class="btn btn-primary btn-sm">Tambah</button>
          <a href="import_from_excel.php" class="btn btn-warning btn-sm text-white">export excel</a>
        </div>
        <div class="table-responsive pt-3">
          <table id="tabel-peserta" class="table table-bordered">
            <thead>
              <tr style="text-align:center;">
                <th style="width:1px">
                  #
                </th>
                <th>
                  Nama
                </th>
                <th>
                  Token
                </th>
                <th>
                  waktu submit
                </th>
                <th>
                  Status
                </th>
                <th>
                  action
                </th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($data_p)): $no = 0; ?>
                <?php foreach ($data_p as $key): $no++;?>
                  <tr data-xii="p-<?= $key['id'] ?>" style="text-align:left;">
                    <td style="width:20px;text-align:center;">
                      <?php echo $no; ?>
                    </td>
                    <td style="width:10px;">
                      <?= $key['nama'] ?>
                    </td>

                    <td>
                      <span style="background:white;color:black;border-radius:4px;"><?= $key['token'] ?></span>
                    </td>
                    <td>
                      <?= !empty($key['waktu_submit']) ? date("d-m-Y, H:i:s",$key['waktu_submit']) : "--/--/---,--:--:--" ?>
                    </td>
                    <td>
                      <?php
                      
                      if($key['sudah_memilih']==1){
                        echo "<small style='border-radius:3px' class='badge badge-sm badge-primary'>Sudah Memilih</small>";
                      }else{
                        echo "<small style='border-radius:3px' class='badge badge-sm badge-danger'>Belum Memilih</small>";
                      }
                      
                      ?>
                    </td>
                    <td width="20px" style="text-align:center">
                      <button  onclick="hapus_data(<?= $key['u_id'] ?>)" class="btn btn-sm btn-danger"><i class="ti-trash"></i></button>
                      <button  onclick="reset_status_memilih(<?= $key['u_id'] ?>)" class="btn btn-sm btn-success"><i class="ti-reload"></i></button>
                      <a href="?mod=data_peserta&action=edit_peserta&id_data=<?= $key['u_id'] ?>" class="btn btn-sm btn-warning"><i class="ti-pencil-alt"></i></a>

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


<script> 
function reset_status_memilih(id)
  { 
    let is_confirm = confirm("TINDAKAN BERBAHAYA:\nApakah anda yakin ingin mereset ulang data user ini ini? data yang di reset adalah token dan status memilih");
    if(!is_confirm)return false;
    $.ajax({
      url:"ajax.php?action=reset_user&hash=<?= generate_csrf() ?>&id="+id,
      type:"json",
      success:function(s){
        if(s.code == 400){
          alert(`ERROR:${s.code}-${s.message}`)
        }else if(s.code == 200){
          alert(s.message);document.location.reload();
        }
      }

    })
  }

  function hapus_data(id){
    let is_confirm = confirm("TINDAKAN BERBAHAYA:\nApakah anda yakin ingin menghapus data ini?");
    if(!is_confirm)return false;
    $.ajax({
      url:"ajax.php?action=delete_data&hash=<?= generate_csrf() ?>&id="+id,
      type:"json",
      success:function(s){
        if(s.code == 400){
          alert(`ERROR:${s.code}-${s.message}`)
        }else if(s.code == 200){
          alert(s.message);document.location.reload();
        }
      }

    })
  }

 $(document).ready(function() {
 

  let table = $('#tabel-peserta').DataTable({
    responsive:true,
  });
} );
</script>

<!-- modal tambah data pemilih -->

<!-- Modal add -->
<div class="modal fade" id="AddDataPemilih" tabindex="-1" role="dialog" aria-labelledby="AddDataPemilihLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah data calon</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="?mod=data_peserta&action=add_data_pemilih" method="POST">
        <div class="mb-3">
          <input type="text" name="nama_pemilih" placeholder="Masukan nama pemilih" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
      </div> 
     </form>
</div>
</div>
</div>
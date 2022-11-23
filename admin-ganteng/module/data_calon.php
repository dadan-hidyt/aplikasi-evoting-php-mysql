<?php 
if (isset($_SESSION['level']) && $_SESSION['level'] == 'admin')
{
/**
 * author dadan hdayat
 */
if(isset($_GET['action']) && !empty($_GET['action'])){
  if($_GET['action']=='tambah_data_calon'){
    if(isset($_POST['tambah'])){
      $nama = secure($_POST['nama_calon']);
      $no_calon = secure($_POST['no_calon']);
      $desc = htmlspecialchars($_POST['desc'],ENT_QUOTES);
      $img = $_FILES['foto'];
      $extensi = pathinfo($img['name'],PATHINFO_EXTENSION);
      $file_path = "content/image/";
      $extensis = ['png','jpg','gif','svg','jpeg'];
      $nama_baru = md5(uniqid()).".{$extensi}";
      if(!in_array($extensi,$extensis)){
        echo "<p class='alert alert-danger'>format gambar tidak di perbolehkan</p>";
      }else{
        move_uploaded_file($img['tmp_name'], "../content/image/$nama_baru");
        $nn = "content/image/{$nama_baru}";
        $add = $konek->query("INSERT INTO tbl_calon (nama_calon,no_calon,description,foto_calon) VALUES ('$nama','$no_calon','$desc','$nn')");
        if($add){
          echo "<script>alert('berhasil di tambahkan');window.location.href='?mod=data_calon'</script>";
        }else{
          echo "<script>alert('gagal di tambahkan');window.location.href='?mod=data_calon'</script>";
        }
      }

    }
  }elseif($_GET['action']=='edit'){
    include 'include/edit_data_calon.php';
  }elseif($_GET['action']=='edit_data_calon'){
    if(isset($_POST['update'])){
      $nama_calon = $_POST['nama_calon'];
      $file = $_FILES['foto'];
      $desc = $_POST['desc'];
      $nama_file = $file['name'];
      $no = $_POST['id_calon'];
      $extensi = pathinfo($nama_file,PATHINFO_EXTENSION);
      $alowed = ['png','jpg','gif','svg','jpeg'];
      $foto = $konek->query("SELECT foto_calon FROM tbl_calon WHERE no_calon='$no'")->fetch_assoc()['foto_calon'];
      $foto_orign = $foto;
      if(!empty($nama_file) && in_array($extensi,$alowed)){
        $foto = "content/image/".md5(uniqid())."-update.{$extensi}";
        move_uploaded_file($file['tmp_name'],"../{$foto}");
        @unlink("../".$foto_orign);
      }
      if($konek->query("UPDATE tbl_calon SET nama_calon='$nama_calon',foto_calon='$foto',`description`='$desc' WHERE no_calon='$no'")){
        echo "<script>alert('Data berhasil di update');window.location.href='?mod=data_calon'</script>";
      }else{
        echo "<script>alert('data gagal di update');window.location.href='?mod=data_calon'</script>";
      }
    

    }
    
  }elseif($_GET['action'] == 'delete'){
    $id = $_GET['data_id'];
    $gambar = $konek->query("SELECT foto_calon FROM tbl_calon WHERE no_calon='$id'")->fetch_assoc()['foto_calon'];
    if($konek->query("SELECT * FROM tbl_calon WHERE no_calon='$id'")->num_rows ==1){
      $konek->query("DELETE FROM tbl_calon WHERE no_calon='$id'");
      $gg = $konek->query("SELECT * FROM tbl_kotak_suara WHERE pilihan='$id'");
      while($ggs = $gg->fetch_object()){
        $uid = $ggs->user_id;
        $konek->query("UPDATE tbl_peserta_pemilihan SET sudah_memilih='0',waktu_submit='' WHERE id='$uid'");
      }
      $konek->query("DELETE FROM tbl_kotak_suara WHERE pilihan='$id'");
      @unlink("../".$gambar);
      echo "<script>alert('Data berhasil di hapus');window.location.href='?mod=data_calon'</script>";
    }else{
      echo "<script>alert('data gagal di hapus');window.location.href='?mod=data_calon'</script>";

    }
  }else{
    include 'include/show_data_calon.php';
  }
}else{
  include 'include/show_data_calon.php';
}
}else{
  ?>
  <h3>Akses hanya untuk admin</h3>
  <?php
}
?>


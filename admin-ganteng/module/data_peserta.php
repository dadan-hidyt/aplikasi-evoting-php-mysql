<?php

if(isset($_GET['action']) && !empty($_GET['action'])){
    $action = $_GET['action'];
    
    //action menampilkan data
    if($action == "show_data_peserta_pemilihan"){
        require 'include/show_data_peserta_pemilihan.php';
    }elseif($action == 'add_data_pemilih'){
        if(isset($_POST['tambah'])){
            $nama_pemilih = secure($_POST['nama_pemilih']);
            if(empty($nama_pemilih)){
                echo "<script>alert('Data gagal di tambahkan');location.href='?mod=data_peserta';</script>";
                exit;
            }
            $ab = $konek->query("SELECT token, max(id) as id_terakhir FROM tbl_peserta_pemilihan");
            $id_terakhir = $ab->fetch_object()->id_terakhir;
            $id_terakhir++;
            $token = generate_token_pemilihan($nama_pemilih,$id_terakhir);
            if($konek->query("INSERT INTO tbl_peserta_pemilihan (nama,token) VALUES('$nama_pemilih','$token')")){
                echo "<script>alert('Data Berhasil di tambahkan');location.href='?mod=data_peserta';</script>";
            }else{
                echo "<script>alert('Data gagal di tambahkan');location.href='?mod=data_peserta';</script>";
            }
        }
    }elseif($action == 'edit_peserta'){
        require 'include/edit_data_peserta_pemilihan.php';
    }else{
        require 'include/show_data_peserta_pemilihan.php';
    }
}else{
    require 'include/show_data_peserta_pemilihan.php';
}

?>
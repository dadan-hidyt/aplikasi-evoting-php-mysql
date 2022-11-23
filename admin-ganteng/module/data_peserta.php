<?php

if(isset($_GET['action']) && !empty($_GET['action'])){
    $action = $_GET['action'];
    
    //action menampilkan data
    if($action == "show_data_peserta_pemilihan"){
        require 'include/show_data_peserta_pemilihan.php';
    }elseif($action == 'add_data_pemilih'){
        if(isset($_POST['tambah'])){
           if(tambah_data_pemilih($_POST['nama_pemilih']))
            {
                echo "<script>alert('Data Berhasil di tambahkan');location.href='?mod=data_peserta';</script>";
            } else {
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
<?php
include 'sys.conf.php';
include 'functions.php';
sessionStart();
if(!logedin()){
    redirect(base_url().'index.php');
    exit(1);
}
$userlogin = user_data_login();
if(isset($_POST['pilih'])){
    if(isset($_POST['csrf'])){
        if(!verify_csrf($_POST['csrf'])){
            die("csrf is missing");
        }
    }
    $no_calon = $_POST['no_calon'];
    $no_calon = secure($no_calon);
    //cek dulu apakah no calon ada di database
    $cek_no_calon = $konek->query("SELECT no_calon FROM tbl_calon WHERE no_calon='$no_calon'");
    if($cek_no_calon->num_rows < 1){
        redirect(base_url().'kotak_suara.php');
        exit;
    }elseif(empty($no_calon)){
        redirect(base_url().'kotak_suara.php');
        exit;
    }
    if(sudah_memilih($userlogin['id'])){
        logout();
        redirect(base_url().'index.php');
        exit;
    }else{
        $id = $userlogin['id'];
        $pilihan = $no_calon;
        $coblos = $konek->query("INSERT INTO `tbl_kotak_suara` (`user_id`,`pilihan`) VALUES ('$id','$pilihan')");
        $time = time();
        $tanda =  $konek->query("UPDATE `tbl_peserta_pemilihan` SET `waktu_submit`='$time',`sudah_memilih`='1' WHERE `id`='$id'");
        if($coblos){
            logout();
            setcookie("upin",true,(time()+60*60*24*30*12),"/");
            redirect(base_url().'keluar.php');
        }
    }

}else{
    redirect(base_url());
}

?>
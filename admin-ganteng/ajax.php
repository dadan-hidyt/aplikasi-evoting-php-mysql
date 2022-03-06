<?php 
include '../sys.conf.php';
include '../functions.php';
sessionStart();
if(empty($_SESSION['admin_login']) && $_SESSION['admin_login']!='berhasilloginngap'){
  header('location:login.php');
}
header('content-type:application/json');
if(empty($_GET['hash']) || !verify_csrf($_GET['hash']))
{
	$datajson = array(
		"code"=>400,
		"message"=>"Token CSRF tidak valid"
	);	
	echo json_encode($datajson);
	exit;
}
if(!isset($_GET['action'])){
	$datajson = array(
		"code"=>400,
		"message"=>"Tidak ada tindakan"
	);	
	echo json_encode($datajson);
	exit;
}
$act = secure($_GET['action']);
if($act == "reset_user"){
	if(!isset($_GET['id'])){
		$datajson = array(
			"code"=>400,
			"message"=>"id parameter not found"
		);	
		echo json_encode($datajson);
		exit;
	}
	$id = secure($_GET['id']);
	$new_token = generate_token_pemilihan("updates",$id);
	$reset = $konek->query("UPDATE tbl_peserta_pemilihan SET sudah_memilih='0',waktu_submit='',token='$new_token' WHERE id='$id'");
	$reset1 = $konek->query("DELETE FROM tbl_kotak_suara WHERE user_id='$id'");
	if($reset){
		$datajson = array(
			"code"=>200,
			"message"=>"data pemilih berhasil di reset",
		);	
		echo json_encode($datajson);
		exit;
	}
}elseif($act == "delete_data"){
	if(!isset($_GET['id'])){
		$datajson = array(
			"code"=>400,
			"message"=>"id parameter not found"
		);	
		echo json_encode($datajson);
		exit;
	}
	$id = secure($_GET['id']);
	$new_token = generate_token_pemilihan("updates",$id);
	$reset = $konek->query("DELETE FROM tbl_peserta_pemilihan WHERE id='$id'");
	$reset1 = $konek->query("DELETE FROM tbl_kotak_suara WHERE user_id='$id'");
	if($reset){
		$datajson = array(
			"code"=>200,
			"message"=>"data pemilih berhasil di hapus",
		);	
		echo json_encode($datajson);
		exit;
	}
}

?>
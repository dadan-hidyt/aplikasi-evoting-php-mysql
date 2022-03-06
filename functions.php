<?php 
/**
 * function for prevent session hijaking
 * demi keamanan ye kan
 **/
function sessionStart()
{
	$param = session_get_cookie_params();
	session_set_cookie_params(0,"/",$param['domain'],false,true);
	session_name("icso_sessid");
	session_start();
	session_regenerate_id();
}
/**
 * function for check user login or
 * */
function logedin()
{
	if(isset($_SESSION['login']) && $_SESSION['login']==true){
		return true;
	}else{
		return false;
	}
}
function user_data_login()
{
	global $konek;
	if(logedin()){
		$id = $_SESSION['id_login'];
		if($d = $konek->query("SELECT * FROM tbl_peserta_pemilihan WHERE id='$id'")){
			if($d->num_rows == 1){
				return $d->fetch_assoc();
			}
		}
	}
	return false;
}
function generate_token_pemilihan($nama,$last_id = 0)
{
	$nama = preg_replace("/[^a-zA-Z0-9]/","",$nama);
	$nama = str_replace(" ","",$nama);
	$random = "{$last_id}abcdefghijklmnopqrstuvwxyzABCDEGHJIJKLMNOPQRSTUVWXYZ".$nama;
	$random = str_shuffle($random);
	$rand = "";
	for($i = 1; $i<= 6;$i++){
		$rand .= $random[mt_rand(0,strlen($random))-1];
	}
	$token = "{$rand}{$last_id}";
	return $token;
}
function base_url()
{
	$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? "https://" : 'http://';
	$url .= $_SERVER["HTTP_HOST"].str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
	return $url;
}
function secure($text = "")
{
	global $konek;
	$text = mysqli_real_escape_string($konek,$text);
	$text = htmlspecialchars($text,ENT_QUOTES);
	return strip_tags($text);
}
function generate_csrf()
{
	if(!isset($_SESSION['csrf'])){
		$token = bin2hex(random_bytes(32));
		$_SESSION['csrf'] = $token;
	}
	return $_SESSION['csrf'];
	
}
function get_data_calon_by_id($id)
{
	global $konek;
	if($calons = $konek->query("SELECT * FROM tbl_calon WHERE id='$id'")){
		if($calons->num_rows ==1){
			return $calons->fetch_assoc();
		}
	}
	return false;
}
function generate_session_login($id = "")
{
	if(!empty($id)){
		$_SESSION['login'] = true;
		$_SESSION['id_login'] = $id;
	}
}
function logout(){
	unset($_SESSION['login']);
	unset($_SESSION['id_login']);
	session_destroy();
	session_unset();
}
function sudah_memilih($id)
{
	global $konek;
	$cek = $konek->query("SELECT sudah_memilih FROM tbl_peserta_pemilihan WHERE id='$id'");
	if($cek->num_rows >0){
		$pilih = $cek->fetch_assoc()['sudah_memilih'];
	}
	$ada_di_kotak_suara = false;
	$cek_kotak_suara = $konek->query("SELECT * FROM tbl_kotak_suara WHERE user_id='$id'");
	if($cek_kotak_suara->num_rows == 1){
		$ada_di_kotak_suara = true;
	}
	if($ada_di_kotak_suara && $pilih == 0){
		$konek->query("UPDATE tbl_peserta_pemilihan SET sudah_memilih='1' WHERE id='$id'");
	}elseif($ada_di_kotak_suara && $pilih ==1){
		if(!isset($_COOKIE['upin'])){
			setcookie("upin",true,(time()+60*60*24*30*12),"/");
		}
		return true;
	}
}
function cek_token_login($token)
{
	global $konek;
	$ct = $konek->query("SELECT * FROM tbl_peserta_pemilihan WHERE token='$token'");
	if($ct){
		if($ct->num_rows == 1){
			return $ct->fetch_assoc();
		}else{
			return false;
		}
	}
}
function verify_csrf($token)
{
	if(isset($_SESSION['csrf'])){
		if($token == $_SESSION['csrf']){
			return true;
		}
	}
	return false;
}
function redirect($to)
{
	return header("location:{$to}");
}
function get_calon()
{
	global $konek;
	$data= array();
	$gbl = $konek->query("SELECT * FROM tbl_calon");
	$total_semua_suara = $konek->query("SELECT count(*) as total FROM tbl_kotak_suara")->fetch_assoc()['total'];
	if($gbl->num_rows > 0){
		while($ff = $gbl->fetch_assoc()){
			$total_s = $konek->query("SELECT count(pilihan) as total FROM tbl_kotak_suara WHERE pilihan='".$ff['no_calon']."'")->fetch_assoc()['total'];
			$total = 0;
			if($total_s!=0){
				$total = round($total_s/$total_semua_suara*100,1);
			}
			$data[] = array(
				"nama_calon"=>$ff['nama_calon'],
				"no_calon"=>$ff['no_calon'],
				"total_suara"=>$total_s,
				"total_persen"=>"$total",
				"foto"=>$ff['foto_calon']
			);


		}
	}
	return $data;
}

?>

<?php 
//jika sudah memilih user tidak bisa mengakses halaman login
// if(isset($_COOKIE['upin']) && $_COOKIE['upin']==1){
// 	include 'sudah_memilih.php';
// 	exit;
// 	die;
// }
//including configuration and connection database
include 'sys.conf.php';
//including functions file
include 'functions.php';
//start session
sessionStart();
$error = "";
//if alerdy login redirect to kotak_suara page
if(logedin()){
	redirect('kotak_suara.php');
	exit;
}
if(isset($_POST['submit'])){
	if(isset($_POST['csrf']) && !verify_csrf($_POST['csrf'])){
		echo "token csrf is missing";
		exit(1);
	}
	$token = secure($_POST['token']);
	if(preg_match("/[^a-zA-Z0-9]/",$token) || $token == ''){
		$error = "Token harus mengadung a-z dan 0-9, tidak mengandung karakter dan spasi. silahan coba lagi!";
	}else{
		try {
			$data = cek_token_login($token);
			generate_session_login($data['id']);
			redirect('kotak_suara.php');
			exit;
		}catch(Exception $e){
			$error = $e->getMessage();
		}
	}
}
$title = "Masuk | ".$title;
include 'content/partial.header.php';
?>
<link rel="stylesheet" type="text/css" href="assets/css/login-style.css">
<!-- start:main -->
<div class="wrapper">
	<div class="container">
		<div class="main">
			<img src="assets/img/logo_580.png" alt="logo icso">
			<h2>PEMILIHAN OSIS SMK IFSU</h2>
			<?php if(empty($error)):?>
				<span >Silahkan Login terlebih dahulu</span>
			<?php else: ?>
				<span style="color:red;"><?= $error ?></span>
			<?php endif; ?>
			<form action="" method="POST">
				<input hidden name="csrf" value="<?=  generate_csrf(); ?>">
				<ul class="form">
					<li><input class="username" required name="token" type="text" id="input-token" placeholder="Masukan Token.."></li>
					<li><button type="submit" name="submit" class="button" >Login</button></li>
				</ul>
			</form>
			<br>
			&copy; Icso
			<!-- <a href="#" class="login-problem">Butuh bantuan?</a> -->
		</div>
	</div>
</div>
<!-- end:main -->
<?php 
include 'content/partial.footer.php';
?>
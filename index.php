<?php 
//jika sudah memilih user tidak bisa mengakses halaman login
if(isset($_COOKIE['upin']) && $_COOKIE['upin']==1){
	include 'sudah_memilih.php';
	exit;
	die;
}
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
		die();
	}
	$token = secure($_POST['token']);
	if(preg_match("/[^a-zA-Z0-9]/",$token) || $token == ''){
		$error = "Token harus mengadung a-z dan 0-9, tidak mengandung karakter dan spasi. silahan coba lagi!";
	}else{
		if($data = cek_token_login($token)){
			generate_session_login($data['id']);
			redirect('kotak_suara.php');
			exit;
		}else{
			$error = "Token tidak valid silahkan coba lagi";
		}
	}
	
}
$title = "Masuk | ".$title;
include 'content/partial.header.php';
?>
<!-- start:main -->
<img src="<?= base_url() ?>assets/img/elipse-icon.svg" alt="Atribut" class="elipse-icon">

<div class="container login">
	<form action="" method="post" class="form-login">
		<div class="form-header">
			<h3>Login</h3>
			<?php if(empty($error)):?>
				<span>Silahkan Login terlebih dahulu</span>
				<?php else: ?>
					<span><?= $error ?></span>
				<?php endif; ?>
		</div>

		<div class="inputbox">
			<input hidden name="csrf" value="<?=  generate_csrf(); ?>">
			<div class="token-input">
				<input required name="token" type="text" id="input-token" placeholder="Masukan Token..">
			</div>
			<button type="submit" name="submit" class="input-submit" >Login</button>
			<!-- <input type="submit" class="input-submit" > -->
		</div>
	</form>

	<div class="copy">
		<img src="assets/img/copy-icon.svg" alt="copyright">
		<span>copyright 2022 ICSO</span>
	</div>

</div>





<!-- end:man -->
<?php 
include 'content/partial.footer.php';
?>
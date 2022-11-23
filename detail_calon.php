<?php 
//including configuration and connection database
include 'sys.conf.php';
//including functions file
include 'functions.php';
//start session
sessionStart();
//if alerdy login redirect to kotak_suara page
if(!logedin()){
	redirect(base_url().'index.php');
	exit;
}
$data_user_login = user_data_login();
$id = $data_user_login['id'];
$nama = $data_user_login['token'];
if(empty($_GET['calon'])){
	redirect(base_url().'kotak_suara.php');
	exit;
}
$id = secure($_GET['calon']);
if($calon_data = get_data_calon_by_id($id)){
	$calon_data = $calon_data;
}else{
	redirect(base_url().'kotak_suara.php');
	exit;
}
if(sudah_memilih($id)){
	logout();
	redirect(base_url());
	exit;
}
$foto = base_url().$calon_data['foto_calon'];
$title = "calon-".$calon_data['no_calon']."-".$calon_data['nama_calon']."| ".$title;
include 'content/partial.header.php';
?>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/detail-calon.css">
<!-- start:main -->
<div class="wrapper">
	<div class="container">
		<div class="head">
			<h2>Detail Calon</h2>
			<a href="file:///D:/MY%20PROJECT/PEMILU%20APPS/PILIHAN/index.html" class="bx-button">
				<i class='bx bx-arrow-back bx-md'></i>
			</a>
		</div>


		<div class="main-info">
			<div class="info-profile">
				<div class="calon_satu">
					<img src="<?= $foto ?>" alt="foto-calon">
				</div>
				<form action="<?= base_url() ?>pilih.php" method="post">
					<input hidden name="no_calon" value='<?= $calon_data['no_calon'] ?>'>
					<input hidden name="csrf" value='<?= generate_csrf() ?>'>
					<button onclick='return konfirmasi()' name='pilih' class='pick-button' type="submit">Pilih</button>
				</form>
			</div>
			<div class="visi-misi">
				<h1><?= sprintf('%02s',$calon_data['no_calon']) ?></h1>
				<h3><?= $calon_data['nama_calon'] ?></h3>
				<?php echo htmlspecialchars_decode($calon_data['description']) ?>
				<form action="<?= base_url() ?>pilih.php" method="post">
					<input hidden name="no_calon" value='<?= $calon_data['no_calon'] ?>'>
					<input hidden name="csrf" value='<?= generate_csrf() ?>'>
					<button onclick='return konfirmasi()' name='pilih' class='pick-button-mobile' type="submit">Pilih</button>
				</form>
			</div>

		</div>



	</div>
</div>
<script>
	function konfirmasi(){
		return confirm('Apakah kamu yakin dengan pilihan ini?');
	}
</script>
<!-- end:man -->
<?php 
include 'content/partial.footer.php';
?>
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
<!-- start:main -->
<nav class="navbar">
	<a href="<?= base_url() ?>kotak_suara" class="back-icon">
		<img src="<?= base_url(); ?>assets/img/back-icon.svg" alt="back">
		<p>Kembali</p>
	</a>
</nav>

<div class="container">
	<h3>Detail Calon</h3>


	<div class="card-calon detail-calon">
		<div class="box-img">
			<img src="<?= $foto ?>" alt="" srcset="">
		</div>
		<div class="username">
			<p><?= $calon_data['nama_calon'] ?></p>
		</div>
	</div>


	<div class="box-visi-misi">
		<?php echo htmlspecialchars_decode($calon_data['description']) ?>
	</div>

	<form action="<?= base_url() ?>pilih.php" method="post">
		<input hidden name="no_calon" value='<?= $calon_data['no_calon'] ?>'>
		<input hidden name="csrf" value='<?= generate_csrf() ?>'>
		<button onclick='return konfirmasi()' name='pilih' class='btn-pilih' type="submit">Pilih</button>
	</form>
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
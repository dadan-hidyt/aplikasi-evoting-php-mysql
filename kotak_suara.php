<?php 
//including configuration and connection database
include 'sys.conf.php';
//including functions file
include 'functions.php';
sessionStart();
if(!logedin()){
	redirect(base_url());
	exit;
}

if(sudah_memilih($_SESSION['id_login'])){
	logout();
	redirect(base_url());
	exit;
}
$title = "Kotak Suara | ".$title;
include 'content/partial.header.php';
//get calon
$calon = $konek->query("SELECT id,nama_calon,foto_calon,no_calon FROM tbl_calon");
$calon_row = array();
if($calon){
	if($calon->num_rows > 0){
		while($c = $calon->fetch_object()){
			$calon_row[] = $c;
		}
	}
}
?>
<link rel="stylesheet" type="text/css" href="assets/css/kotak-suara.css">
<!-- start:main -->
<div class="wrapper">
	<div class="container">
		<div class="title">
			<h2>Daftar Calon</h2>
			<p>Silahkan baca terlebih dahulu VISI & MISI calon, jika sudah yakin<br>silahkan tentukan pilihan Anda </p>
		</div>
		<div class="profile">
			<!-- calon 1 -->
			<?php if (!empty($calon_row)): ?>
				<?php foreach ($calon_row as $cl): ?>
					<?php		
					$foto = base_url().$cl->foto_calon;
					?>
					<div class="wrap-calon-satu">
						<div class="calon_satu">
							<img src="<?php echo $foto; ?>">
						</div>
						<a href="<?php echo base_url() ?>kotak_suara/detail/calon-<?= $cl->id ?>-<?php echo str_replace(" ","-",preg_replace("/[^a-zA-Z0-9_-]/"," ",$cl->nama_calon)) ?>.html">Lihat detail</a>						<div class="no-calon-satu">
							<h2><?= sprintf('%02s',$cl->no_calon) ?></h2>
						</div>
					</div>
				<?php endforeach; ?>
			<?php else: ?>
				<b>Belum ada data</b>
			<?php endif; ?>
		</div>
	</div>
</div>
<!-- end:man -->
<?php 
include 'content/partial.footer.php';
?>
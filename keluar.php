 <?php
 include 'sys.conf.php';
 include 'functions.php';

 $title = "selesai memilih";
 include 'content/partial.header.php';
 sessionStart();
 logout();
 unset($_SESSION);
 ?>
 <img src="assets/img/elipse-icon.svg" alt="Atribut" class="elipse-icon">
 <div class="container">
   <div class="GreatingCard">
     <span>Pemilihan berhasil</span>
     <h2>Terimakasih</h2>

   </div>
   <div class="support-by">
     <span>Support By :</span>
     <img src="assets/img/icso.png" alt="icso" class="logo-icso">
   </div>

 </div>
</body>
</html>
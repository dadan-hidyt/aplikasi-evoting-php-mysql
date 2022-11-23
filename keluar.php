 <?php
 include 'sys.conf.php';
 include 'functions.php';

 $title = "selesai memilih";
 include 'content/partial.header.php';
 sessionStart();
 logout();
 unset($_SESSION['login']);
 unset($_SESSION['id_login']);
 ?>
 <style type="text/css">
  @font-face {
    font-family: 'Poppins';
    src: url('assets/css/Poppins-Regular.ttf');
  }
  body{
    font-family: "Poppins";
    color: black;
    text-align: left;
    background: white;
  }
  .GreatingCard{
    text-align: center;
    width: 50%;
    margin: 20px auto;
  }
</style>
<div class="container">
 <div class="GreatingCard">
   <h2 class="terimakasih"></h2>
   <a href="index.php">SELESAI</a>
 </div>

</div>
<script src="assets/js/typewriting.min.js"></script>
<script type="text/javascript">
  //javascript for writing effect
  var typeWriting = new TypeWriting({
    targetElement   : document.getElementsByClassName('terimakasih')[0],
    inputString     : 'Pemilihan berhasil <br> terimakasih telah berpartisipasi',
    typing_interval : 60, // Interval between each character
    blink_interval  : '1s', // Interval of the cursor blinks
    cursor_color    : '#0000', // Color of the cursor
  }, function() {
    console.log("END");
  });
</script>
</body>
</html>
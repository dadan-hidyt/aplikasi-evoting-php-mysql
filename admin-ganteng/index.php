<?php 
include '../sys.conf.php';
include '../functions.php';
sessionStart();
if(empty($_SESSION['admin_login']) && $_SESSION['admin_login']!='berhasilloginngap'){
  header('location:login.php');
}
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="assets/vendors/base/vendor.bundle.base.css">
  <script src="assets/vendors/base/vendor.bundle.base.js"></script>
  <link rel="stylesheet" href="assets/vendors/DataTables/datatables.min.css">
    <script src="assets/vendors/DataTables/datatables.min.js"></script>

  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>
<body>
    <div class="container-scroller">
      <?php
      include "assets/partials/_navbar.php";
      include "assets/partials/_sidebar.php";
      ?>
      <div class="main-panel">
        <div class="content-wrapper">

            <?php
            $module = "index";
            if(!empty($_GET['mod'])){
                $module = $_GET['mod'];
            }
            $mod_path = "module/{$module}.php";
            if(file_exists($mod_path)){
                include $mod_path;
            }else{
                ?>
                <h1>404 Not Found</h1>
                <?php
            }
            ?>

        </div>
    </div>
</div>
<?php
include "assets/partials/_footer.php";
?>  
</div>

<!-- endinject -->
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="assets/js/off-canvas.js"></script>
<script src="assets/js/hoverable-collapse.js"></script>
<script src="assets/js/template.js"></script>
<script src="assets/js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="assets/js/dashboard.js"></script>
<!-- End custom js for this page-->
</body>

</html>

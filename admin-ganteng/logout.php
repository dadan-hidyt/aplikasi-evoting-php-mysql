<?php
include '../sys.conf.php';
include '../functions.php';
sessionStart();
unset($_SESSION['admin_login']);
session_destroy();
echo "<script>alert('logout berhasil');window.location.href='login.php';</script>";

?>
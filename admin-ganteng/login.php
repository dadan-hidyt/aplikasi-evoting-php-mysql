<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login admin</title>
    <style>
        .box-login{
            width:420px;
            box-shadow:0px 0px 8px #dedede;
            padding:2px 20px;
            padding-bottom:20px;
            box-sizing:border-box;
            border-radius:10px;
            text-transform:capitalize;
            margin:80px auto;
        }
        .control-input{
            width:100%;
            height:40px;
            font-size:18px;
            caret-color:red;
            box-sizing:border-box;
        }
        .fgrp{
            width:100%;
            margin:10px 0px;
        }
        .fgrp label{
            margin-bottom:5px;
        }
        .btn{
            padding:10px;
            border:none;
            background:blue;
            color:white;
            font-weight:bold;
            border-radius:3px;
        }
</style>
</head>
<body>
<?php
include '../sys.conf.php';
include '../functions.php';

sessionStart();
if(isset($_POST['login']))
{
    $email = secure($_POST['email']);
    $password = secure($_POST['password']);
    $ff = $konek->query("SELECT * FROM admins WHERE email='$email' AND password='$password'");
    if($ff){
        if($ff->num_rows > 0){
            $_SESSION['admin_login'] = "berhasilloginngap";
            $_SESSION['level'] = $ff->fetch_assoc()['level'];
          echo "<script>alert('login berhasil');window.location.href='index.php?mod=index';</script>";

        }else{
            echo "<script>alert('login gagal');</script>";
            }
    }
}
?>
<div class="box-login">
    <h3 class="logo">PEMILU OSIS</h3>
    <form action="" method="post">

    <div class="fgrp">
        <label for="username">Username</label>
        <input type="text" name='email' class="control-input">
    </div>
    <div class="fgrp">
        <label for="password">password</label>
        <input type="password" name='password' class="control-input">
    </div>
    <button name='login' class='btn'>Login</button>

</form>
</div>
</body>
</html>
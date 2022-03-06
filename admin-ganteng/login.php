<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login admin</title>
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
          echo "<script>alert('login berhasil');window.location.href='index.php?mod=index';</script>";

        }else{
            echo "<script>alert('login gagal');</script>";
            }
    }
}
?>
<form action="" method="post">
<table style="width:340px;margin:auto;" border='1'>
    <tr>
        <td colspan="2" style="text-align:center">ADMIN LOGIN</td>
    </tr>
           <tr>
               <td>
                   Email: &nbsp; &nbsp; &nbsp; &nbsp;<input style="box-sizing:border-box;width:65%;padding:10px;" name="email" type="text">
               </td>
               
           </tr>
            <tr>
               <td>
                   Password:  &nbsp;<input style="box-sizing:border-box;width:65%;padding:10px;"  name="password" type="password">
               </td>
               
           </tr>
           <tr>
         <td colspan="2" style="text-align:center;width:100%"><button  name="login" style="width:100%;padding:10px;">LOGIN</button></td>
    </tr>
       </table>
</form>
</body>
</html>
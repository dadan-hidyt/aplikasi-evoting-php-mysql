<?php 
/**
 * Ini adalah bagian dari aplikasi evoting
 * @author dadan hidayat
 * @team icso
 */
require '../sys.conf.php';
require '../functions.php';
require 'xlsxreader/src/SimpleXLSX.php';
sessionStart();
if(empty($_SESSION['admin_login']) && $_SESSION['admin_login'] != 'berhasilloginngap'){
  header('location:login.php');
}
use Shuchkin\SimpleXLSX;
//if import button di click
if (isset($_POST['import']))
{
    $message = "";
    if ($_FILES['excel_file']['error'] === UPLOAD_ERR_OK) 
    {
        $extensi = pathinfo($_FILES['excel_file']['name'],PATHINFO_EXTENSION);
        if ($extensi === 'xlsx') 
        {
            $parse_file = SimpleXLSX::parse($_FILES['excel_file']['tmp_name']);
            if ($parse_file)
            {
                $rows = $parse_file->rows();
                unset($rows[0]);
                $total_data_berhasil = 0;
                $total_data_gagal = 0;
                $total_data_duplikat = 0;
                foreach ($rows as $row) {
                    if (!empty($row[1]) && !empty($row[2]))
                    {
                        $nama = sprintf('%s(%s)',$row[1],$row[2]);
                        if ($konek->query("SELECT nama FROM tbl_peserta_pemilihan WHERE nama='{$nama}'")->num_rows <= 0) 
                        {
                            //proses tambah data ke database
                            if (tambah_data_pemilih($nama))
                            {
                                $total_data_berhasil++;
                            }
                            else 
                            {
                                $total_data_gagal++;
                                continue;
                            }
                            
                        }
                        else 
                        {
                            $total_data_duplikat++;
                            continue;
                        }
                      }
                      else
                      {
                          continue;
                      }
                }
                $message .= sprintf("<p style='color:green;'>[%d] data berhasil di tambahkan</p>", $total_data_berhasil);
                $message .= sprintf("<p style='color:orange;'>[%d] data sudah ada di database</p>", $total_data_duplikat);
                $message .= sprintf("<p style='color:red;'>[%d] data gagal di tambahkan</p>", $total_data_gagal);  
            }
        }
        else
        {
            $message = sprintf("<p style='color:red;'>Extensi file harus (xlsx)!</p>");
        }
    }
}
?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import From Excel</title>
 </head>
 <body>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="excel_file">
        <button name='import'>import</button>
    </form>
    <?php
    if (isset($message))
    {
        ?>
        <samp><?= $message; ?></samp>
        <?php
    }
    ?>
 </body>
 </html>
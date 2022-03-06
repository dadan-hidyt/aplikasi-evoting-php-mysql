<?php
include '../sys.conf.php';
include '../functions.php';
sessionStart();
if(empty($_SESSION['admin_login']) && $_SESSION['admin_login']!='berhasilloginngap'){
    header('location:login.php');
}
//fpdf
include 'fpdf184/fpdf.php';

if(isset($_GET['data_print_type']) && !empty($_GET['data_print_type'])){
    if($_GET['data_print_type']=='data_peserta'){

        $PDF = new FPDF();
        $PDF->AddPage("P","A4");
        $PDF->SetFont('Helvetica','B',14);
        $PDF->Text(15,16,"DATA PESERTA PEMILIHAN");
        $totl = $konek->query("SELECT * FROM tbl_peserta_pemilihan")->num_rows;
        $PDF->SetFont('Helvetica','B',6);
        $PDF->Text(15,20,"Total: $totl");
        $PDF->SetFont('Helvetica',"",8);
        $PDF->Ln(23);
        $PDF->SetFont('Helvetica',"",9);
        $PDF->SetDrawColor(102,102,102);
        $PDF->SetX(15);
        $PDF->Cell(10,8,"NO",1,0,"C");
        $PDF->Cell(70,8,"Nama Peserta",1,0,"C");
        $PDF->Cell(50,8,"Token",1,0,"C");
        $PDF->Cell(50,8,"Status Memilih",1,0,"C");
        $PDF->Ln();
        $datas = $konek->query(
            "SELECT 
            tbl_peserta_pemilihan.*,tbl_peserta_pemilihan.id as u_id,
            tbl_kotak_suara.*,tbl_kotak_suara.id as kotak_suara_id,
            tbl_calon.*,tbl_calon.id as id_tbl_calon
            FROM tbl_peserta_pemilihan
            LEFT JOIN tbl_kotak_suara ON tbl_kotak_suara.user_id = tbl_peserta_pemilihan.id
            LEFT JOIN tbl_calon ON tbl_calon.no_calon=tbl_kotak_suara.pilihan");
        $id = 0;

        while($dd = $datas->fetch_assoc()){
            $id++;
            $PDF->SetX(15);
            $PDF->Cell(10,6,$id,1,0,"C");
            $PDF->Cell(70,6,$dd['nama'],1,0);
            $PDF->Cell(50,6,$dd['token'],1,0);
            if($dd['sudah_memilih']=='1' && !empty($dd['user_id'])){
                $PDF->SetTextColor(0,225,0);
                $PDF->Cell(50,6,"Sudah",1,1,"C");
            }else{
                $PDF->SetTextColor(225,0,1);
                $PDF->Cell(50,6,"Belum",1,1,"C");

            }
            $PDF->SetTextColor(000,000,000);

        }
        $PDF->Ln();
        $PDF->Output("I",rand()."-".uniqid().".pdf");
    }elseif($_GET['data_print_type']=='hasil_pemilihan'){
     include 'fpdf184/sector.php';
     include 'fpdf184/pdf_diagram.php';

     $pdf = new PDF_Diag();
     $pdf->AddPage();


    //Pie chart
     $pdf->Ln(3);
     $pdf->SetFont('Arial', 'BIU', 12);
     $pdf->Cell(0, 5, 'HASIL PEMILIHAN', 0, 1);
     $pdf->Ln(10);

     $pdf->SetFont('Arial', '', 10);
     $valX = $pdf->GetX();
     $valY = $pdf->GetY();
     if (!empty(get_calon())) {
         foreach(get_calon() as $cal){
             $pdf->Cell(30, 5, $cal['nama_calon']);
             $pdf->Cell(15, 5, $cal['total_suara'], 0, 0, 'R');
             $pdf->Ln();
         }
     }

     $pdf->SetXY(85, $valY-10);

     $calon = $konek->query("SELECT * FROM tbl_calon");
     $data = array();
     if (!empty(get_calon())) {
         foreach(get_calon() as $cal){
           $data[$cal['nama_calon']] = $cal['total_suara'];
       }
       $warna = array(
        array(245,66,99),
        array(0,128,255),
        array(255,230,0),
        array(29,153,110),
        array(29,53,110)
    );
       $array = array();
       for ($i=0; $i < count(get_calon()) ; $i++) { 
        $array[] = $warna[$i];
    }
    $pdf->PieChart(100, 35, $data, '%l (%p)', $array);

}


$pdf->SetXY($valX, $valY + 40);
$pdf->Output();
}    
}

?>
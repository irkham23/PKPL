<?php
// memanggil library FPDF
require('fpdf/fpdf.php');
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('p','mm','letter');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial','B',16);
// mencetak string
$pdf->Cell(190,7,'REKAP TRANSAKSI',0,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(190,7,'AMANAH BATU UKIR',0,1,'C');
// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,7,'',0,1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(60,6,'EMAIL PEMBELI',1,0);
$pdf->Cell(40,6,'NAMA PRODUK',1,0);
$pdf->Cell(20,6,'JUMLAH',1,0);
$pdf->Cell(30,6,'TOTAL HARGA',1,0);
$pdf->Cell(40,6,'TANGGAL',1,1);
$pdf->SetFont('Arial','',10);

include '../config/config.php';
include '../config/koneksi.php';


$bulan = $_POST['sort-bulan'];

if ($bulan == "semua") {
	$mahasiswa = mysqli_query($connect, "SELECT detail_orders.email_pembeli, detail_orders.nama_produk, detail_orders.jumlah, detail_orders.subHarga, orders.tanggal FROM detail_orders JOIN orders ON detail_orders.id_pembeli = orders.id_pembeli");

}else{
	if ($bulan == "Januari") {
		$bulan = date('Y-01-d');
	}elseif ($bulan == "Februari") {
		$bulan = date('Y-02-d');
	}
	elseif ($bulan == "Maret") {
		$bulan = date('Y-03-d');
	}
	elseif ($bulan == "April") {
		$bulan = date('Y-04-d');
	}
	elseif ($bulan == "Mei") {
		$bulan = date('Y-05-d');
	}
	elseif ($bulan == "Juni") {
		$bulan = date('Y-06-d');
	}
	elseif ($bulan == "Juli") {
		$bulan = date('Y-07-d');
	}
	elseif ($bulan == "Agustus") {
		$bulan = date('Y-08-d');
	}
	elseif ($bulan == "September") {
		$bulan = date('Y-09-d');
	}
	elseif ($bulan == "Oktober") {
		$bulan = date('Y-10-d');
	}
	elseif ($bulan == "November") {
		$bulan = date('Y-11-d');
	}
	elseif ($bulan == "Desember") {
		$bulan = date('Y-12-d');
	}
	$mahasiswa = mysqli_query($connect, "SELECT detail_orders.email_pembeli, detail_orders.nama_produk, detail_orders.jumlah, detail_orders.subHarga, orders.tanggal FROM detail_orders JOIN orders ON detail_orders.id_pembeli = orders.id_pembeli WHERE tanggal LIKE '%$bulan%'");
}

while ($row = mysqli_fetch_array($mahasiswa)){
	$pdf->Cell(60,6,$row['email_pembeli'],1,0);
	$pdf->Cell(40,6,$row['nama_produk'],1,0);
	$pdf->Cell(20,6,$row['jumlah'],1,0);
	$pdf->Cell(30,6,$row['subHarga'],1,0);
	$pdf->Cell(40,6,$row['tanggal'],1,1);
}
$pdf->Output();
?>
<?php  
	session_start();
	if (!isset($_SESSION['pembeli'])) {
	}

?>

<?php  
error_reporting(0);
require_once 'config/config.php';
require_once 'config/koneksi.php';
include_once 'config/koneksi.php';

$nama = $_POST['nama_produk'];
$kategori = $_POST['nama_kategori'];
$jumlah = $_POST['jumlah'];
$subHarga = $_POST['subHarga'];
$emailPem = $_SESSION['email_pembeli'];
$idPem = $_SESSION['id_pembeli'];
$tanggal = date('Y-m-d H:i:s');

mysqli_query($connect, "INSERT INTO orders VALUES('', '$emailPem', '$subHarga', '', 'Pending', '$tanggal', '$idPem')");


$id_pembeli = $_SESSION['id_pembeli'];
$sql = mysqli_query($connect, "SELECT * FROM cart WHERE id_pembeli = '$id_pembeli'");

?>


<?php 
	     while ($data = mysqli_fetch_array($sql)) { 
	                	$no++;
	                	$subtotal = $data['jumlah'] * $data['harga'];
	                	$total = $total + $subtotal;
	            		$nama = $data['Nama'];
	            		$jumlah = $data['jumlah'];
	            		mysqli_query($connect, "INSERT INTO detail_orders VALUES('$idPem', '$emailPem', '$nama', '$jumlah', '$subtotal', '')");
	            		mysqli_query($connect, "UPDATE produk SET qty = qty - '$jumlah'");
	            ?>
				
			<?php }?>

<?php
		header('location:metode_bayar.php?>');
	
?>
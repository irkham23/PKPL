<?php

	include "../config/koneksi.php";

	header('Content-Type: text/xml');
	$query = "SELECT * FROM produk";
	$hasil = mysqli_query($connect,$query);
	$jumField = mysqli_num_fields($hasil);
	echo "<?xml version='1.0'?>";
	echo "<data>";

	while ($data = mysqli_fetch_array($hasil))
	{
		echo "<mahasiswa>";
		echo"<id_produk>",$data['id_produk'],"</id_produk>";
		echo"<Nama>",$data['Nama'],"</Nama>";
		echo"<nama_kategori>",$data['nama_kategori'],"</nama_kategori>";
		echo"<harga>",$data['harga'],"</harga>";
		echo"<qty>",$data['qty'],"</qty>";
		echo "</mahasiswa>";
	}
	echo "</data>";
?>
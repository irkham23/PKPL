<?php

	include "../config/config.php";
	include "../config/koneksi.php";

	header('Content-Type: text/xml');
	$query = "SELECT * FROM orders";
	$hasil = mysqli_query($connect,$query);
	$jumField = mysqli_num_fields($hasil);
	echo "<?xml version='1.0'?>";
	echo "<data>";

	while ($data = mysqli_fetch_array($hasil))
	{
		echo "<orders>";
		echo"<id_order>",$data['id_order'],"</id_order>";
		echo"<email>",$data['email'],"</email>";
		echo"<subHarga>",$data['subHarga'],"</subHarga>";
		echo"<status>",$data['status'],"</status>";
		echo"<tanggal>",$data['tanggal'],"</tanggal>";
		echo "</orders>";
	}
	echo "</data>";
?>
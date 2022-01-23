<?php

	include "../config/koneksi.php";

	$sql="SELECT * FROM produk ORDER BY id_produk";
	$tampil = mysqli_query($connect,$sql);

	if (mysqli_num_rows($tampil) > 0) {
		$no=1;
		$response = array();
		$response["data"] = array();
		while ($r = mysqli_fetch_array($tampil)) {
			$h['id_produk'] = $r['id_produk'];
			$h['Nama'] = $r['Nama'];
			$h['nama_kategori'] = $r['nama_kategori'];
			$h['harga'] = $r['harga'];
			$h['qty'] = $r['qty'];
			array_push($response["data"], $h);
		}
		echo json_encode($response);
	}
	else {
		$response["message"]="tidak ada data";
		echo json_encode($response);
	}
?>
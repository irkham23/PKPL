<?php
	
	include "../config/config.php";
	include "../config/koneksi.php";

	$sql="select * from orders order by id_order";
	$tampil = mysqli_query($connect,$sql);

	if (mysqli_num_rows($tampil) > 0) {
		$no=1;
		$response = array();
		$response["data"] = array();
		while ($r = mysqli_fetch_array($tampil)) {
			$h['id_order'] = $r['id_order'];
			$h['email'] = $r['email'];
			$h['subHarga'] = $r['subHarga'];
			$h['status'] = $r['status'];
			$h['tanggal'] = $r['tanggal'];
			array_push($response["data"], $h);
		}
		echo json_encode($response);
	}
	else {
		$response["message"]="tidak ada data";
		echo json_encode($response);
	}
?>
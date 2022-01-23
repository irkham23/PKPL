<?php
include 'config/koneksi.php';

$email = $_POST['user'];
$nohp = $_POST['user'];
$password = $_POST['password'];
 
$login = mysqli_query($mysqli, "SELECT * FROM pembeli WHERE (email='$email' and password=md5('$password')) or (no_hp='$nohp' and password=md5('$password'))");
$cek = mysqli_num_rows($login);

if ($cek > 0) {
	session_start();
	$data_admin = mysqli_fetch_assoc($login);
	if ($data_admin['role'] == 'admin') {
		$_SESSION['pembeli'] = 1;
		$_SESSION['id_pembeli'] = $data_admin['id_pembeli'];
		$_SESSION['nama_pembeli'] = $data_admin['nama'];
		$_SESSION['email_pembeli'] = $data_admin['email'];
		header('location:web admin/dashboard-admin.php');
	}else {
		$_SESSION['pembeli'] = 1;
		$_SESSION['id_pembeli'] = $data_admin['id_pembeli'];
		$_SESSION['nama_pembeli'] = $data_admin['nama'];
		$_SESSION['email_pembeli'] = $data_admin['email'];
		header('location:home.php');
	}
	
} else {
	header('location:index.php?failed=1');
}

?>
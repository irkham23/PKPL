<?php  
	include_once("config/koneksi.php");
	$id_cart = $_POST['id_cart'];
	$jumlah = $_POST['jumlah'];
	$result = mysqli_query($connect, "UPDATE cart SET jumlah = '$jumlah' WHERE id_cart = '$id_cart'");

	header("Location: cart.php");
?>
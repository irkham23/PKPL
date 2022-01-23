<?php  
	include_once("config/koneksi.php");
	$id_cart = $_GET['id_cart'];

	$result = mysqli_query($connect, "DELETE FROM cart WHERE id_cart = '$id_cart'");

	header("Location: cart.php");
?>
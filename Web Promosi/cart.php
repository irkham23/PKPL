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
?>

<?php
	if (isset($_GET['id_produk'])) {
	    $id_produk=$_GET['id_produk'];
	    $sql= "SELECT * FROM produk WHERE id_produk='$id_produk'";
	    $query = mysqli_query($connect, $sql);
	    $data = mysqli_fetch_array($query);
	    $id_produk=$data['id_produk'];
	    $nama_produk=$data['Nama'];
	    $gambar=$data['gambar'];
	    $nama_kategori=$data['nama_kategori'];
	    $harga=$data['harga'];
	    $qty=$data['qty'];
	    $id_pembeli = $_SESSION['id_pembeli'];

	    	
	    $cek = mysqli_query($connect, "SELECT * FROM cart WHERE id_produk = '$id_produk' AND id_pembeli = '$id_pembeli'");
	    $ketemu = mysqli_num_rows($cek);
	    if ($ketemu==0 && $qty > 0) {
	    	$jumlah=1;
	    	$result = mysqli_query($connect, "INSERT INTO cart (id_produk, Nama, nama_kategori, jumlah, qty, harga, gambar, id_cart ,id_pembeli) VALUES ('$id_produk', '$nama_produk', '$nama_kategori', '$jumlah', '$qty', '$harga', '$gambar', ' ', '$id_pembeli')");
	    } else{
	    	$result =mysqli_query($connect, "UPDATE cart SET jumlah = jumlah + 1 WHERE id_produk='$id_produk'");
	    }
	}

?>

<?php  
	if (isset($_POST['btn_hapus'])) {
		$id_cart = $_GET['id_cart'];
		$result = mysqli_query($connect, "DELETE FROM cart WHERE id_cart = '$id_cart'");
	}
?>

<?php  
	$id_pembeli = $_SESSION['id_pembeli'];
	$sql = mysqli_query($connect, "SELECT * FROM cart WHERE id_pembeli = '$id_pembeli'");
?>

<?php  
	$id_pembeli = $_SESSION['id_pembeli'];
	$show_data_pembeli =mysqli_query($connect, "SELECT * FROM pembeli WHERE id_pembeli = '$id_pembeli'");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Kerangjang</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="asset/bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="dist/css/style.css?v=<?php echo time(); ?>">
</head>
<body>

	<nav class="navbar navbar-expand-lg navbar-dark bg-black fixed-top">
	  	<div class="container-fluid">
		    <a class="navbar-brand" href="#">Web Promotion</a>
		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		      	<span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse" id="navbarSupportedContent">
		      	<ul class="navbar-nav ml-auto mb-2 mb-lg-0 navbar-right">
			        <li class="nav-item">
			        	<a class="nav-link active" aria-current="page" href="home.php#">Home</a>
			        </li>
			        <li class="nav-item">
			          	<a class="nav-link active" href="home.php#About">About</a>
			        </li>
			        <li class="nav-item dropdown">
			          	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#" style="color: white;">Product</a>
			          	<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
				            <li><a  class="dropdown-item" href="produk_relief.php">Relief</a></li>
				            <li><a  class="dropdown-item" href="produk_tempel.php">Tempel</a></li>
				        </ul>
			        </li>
			        <li class="nav-item">
			          	<a class="nav-link active" href="home.php#Contact">Contact</a>
			        </li>
			        <li class="nav-item">
			          	<a class="nav-link active" href="cart.php?halaman=cart">Keranjang</a>
			        </li>
			        <li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#" style="color: white;"><i class="fa fa-user"></i> <?php echo $_SESSION['nama_pembeli']; ?></a>
				        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
				            <li><a  class="dropdown-item" href="alamat.php">Alamat</a></li>
				            <li><a  class="dropdown-item" href="pesanan.php">Pesanan Saya</a></li>
				            <li><a  class="dropdown-item" href="logout.php">Logout</a></li>
				        </ul>   
				    </li>
		      	</ul>
		    </div>
	 	 </div>
	</nav>

	<div class="container cart">
		<?php while ($index = mysqli_fetch_array($show_data_pembeli)) { ?>
			<?php echo $index['nama']; ?><br><?php echo $index['no_hp']; ?><br><?php echo $index['alamat']; ?>
		<?php } ?>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th></th>
					<th>Nama</th>
		  			<th>Jumlah</th>
		  			<th class="stok">Stok</th>
		  			<th>Harga</th>
		  			<th class="harga">Total Harga</th>
		  			<th>Opsi</th>
				</tr>
			</thead>
			<tbody>
				<?php 
	                while ($data = mysqli_fetch_array($sql)) { 
	                	$no++;
	                	$subtotal = $data['jumlah'] * $data['harga'];
	                	$total = $total + $subtotal;
	            ?>
	            <form method="post" action="updatecart.php">
					<tr>
						<td>
							<?php  
								if ($data['nama_kategori']=="Relief") { 
							?>
									<img src="image/Relief/<?php echo $data['gambar'] ?>" height="50" width="50">
							<?php
								}else{
							?>
									<img src="image/Tempel/<?php echo $data['gambar'] ?>" height="50" width="50">
							<?php
								}
							?>
						</td>
						<td>
							<?php echo $data['Nama']; ?> <br>
							<p style="font-size: 0.8em;"><?php echo $data['nama_kategori']; ?>	</p>
							<input type="hidden" name="id_cart" value="<?php echo $data['id_cart'] ?>">
									
						</td>
						<td>
							<input type="number" min="1" value="<?php echo $data["jumlah"]; ?>" class="form-control" id="jumlah<?php echo $no; ?>" name="jumlah" >
			                <script>
			                    $("#jumlah<?php echo $no; ?>").bind('change', function () {
			                        var jumlah<?php echo $no; ?>=$("#jumlah<?php echo $no; ?>").val();
			                        $("#jumlaha<?php echo $no; ?>").val(jumlah<?php echo $no; ?>);
			                    });
			                    $("#jumlah<?php echo $no; ?>").keydown(function(event) { 
			                        return false;
			                    });
			                    
			                </script>
						</td>
						<td class="isi-stok"><?php echo $data['qty']; ?></td>
						<td>Rp. <?php echo number_format($data['harga'],0,',','.'); ?></td>
						<td class="isi-harga">Rp.  <?php echo number_format($data['jumlah']*$data['harga'],0,',','.'); ?></td>
						<td>
							<input type="SUBMIT" name="btn_update" value="Update" class="btn btn-primary update">
							<a href="hapuscart.php?id_cart=<?=$data['id_cart']?>" name="btn_hapus" value="hapus" class="btn btn-danger hapus">Hapus</a>
						</td>
					</tr>
				</form>
			<?php } ?>
			</tbody>
		</table>
		<h3 class="total">Total Bayar Rp. <?php echo number_format($total,0,',','.'); ?> </h3><br class="enter-cart">
		<a href="checkout.php" name="btn_checkout" class="btn btn-warning checkout">Checkout</a>
		<a href="home.php#Product" name="btn_belanja" class="btn btn-success belanja">Lanjut Belanja</a>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	
</body>
</html>
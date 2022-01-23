<?php  
	session_start();
	if (!isset($_SESSION['admin'])) {
	}

?>

<?php  
error_reporting(0);
require_once 'config/config.php';
require_once 'config/koneksi.php';


$limit = 5;
if(isset($_GET['p']))
{
    $noPage = $_GET['p'];
}
else $noPage = 1;

$offset = ($noPage - 1) * $limit;

$sqlIndex = "SELECT
produk.id_produk,
produk.Nama,
produk.gambar,
kategori.nama_kategori,
produk.harga,
produk.qty,
produk.deskripsi
FROM 
produk
INNER JOIN kategori on produk.nama_kategori = kategori.nama_kategori
WHERE kategori.nama_kategori = 'Tempel'
ORDER BY
produk.id_produk DESC
LIMIT ".$mysqli->real_escape_string($offset).",". $limit;

//data untuk dihitung
$sql_rec = "SELECT id_produk FROM produk";

$total_rec = $mysqli->query($sql_rec);

//Menghitung data yang diambil
$total_rec_num = $total_rec->num_rows;

$qryIndex = $mysqli->query($sqlIndex);

//Total semua data
$total_page = ceil($total_rec_num/$limit);
?>

<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="asset/bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="dist/css/style.css?v=<?php echo time(); ?>">

    <title>Promotion</title>
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

	<!-- produk -->
	<section class="relief" id="relief">
		<div class="container produk">
			<?php while ($index = $qryIndex->fetch_assoc()) { ?>
                <div class="list-produk">
                        <img src="<?php echo $base_url."image/gambar produk/".$index['gambar']; ?>" class="wow fadeIn">
                            <br><br><h5 class="text-center"><?php echo $index['Nama']; ?></h5>
                            <br><p class="text-justify" style="color: black; font-size: 0.6em"><?php echo $index['deskripsi']; ?></p>
                            <br><h5>Rp. <?php echo number_format($index['harga'],0,',','.'); ?></h5>
                        <?php if ($index['qty'] > 0) {?>
                        	<a href="cart.php?halaman=cart&id_produk=<?php echo $index['id_produk'];?>&aksi=tambah_produk&jumlah=1" class="tombol tombol-beli">Beli Sekarang</a>
                       <?php } else { ?>    
                        	<a style="pointer-events: none; cursor: default;background: grey;" href="cart.php?halaman=cart&id_produk=<?php echo $index['id_produk'];?>&aksi=tambah_produk&jumlah=1" class="tombol tombol-beli">Beli Sekarang</a>
                        <?php } ?>
                </div> 
            <?php } ?>
		</div>
	</section>
	<!-- end produk -->

	<!-- footer -->
	<section class="footer">
		<div class="container">
			<p class="text-center">Copyright&copy;Batu Alam 2021</p>
		</div>
	</section>
	<!-- footer -->

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    -->

  </body>
</html>
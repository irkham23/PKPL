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


$limit = 5;
if(isset($_GET['p']))
{
    $noPage = $_GET['p'];
}
else $noPage = 1;

$offset = ($noPage - 1) * $limit;

$idPem = $_SESSION['id_pembeli'];

$terkini = "SELECT
detail_orders.nama_produk,
detail_orders.jumlah,
detail_orders.subHarga,
orders.status,
orders.tanggal
FROM
orders JOIN
detail_orders ON orders.id_pembeli = detail_orders.id_pembeli
WHERE
orders.id_pembeli = '$idPem'
and
orders.id_order = '$_GET[id]'
ORDER BY
orders.id_order DESC
LIMIT "
.$offset.",". $limit;

$qry = $mysqli->query($terkini);

$sql_rec = "SELECT id_detail FROM detail_orders";

$total_rec = $mysqli->query($sql_rec);

$total_rec_num = $total_rec->num_rows;

$total_page = ceil($total_rec_num/$limit);

?>

<!DOCTYPE html>
<html lang="en" id="home">
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
		    <a class="navbar-brand page-scroll" href="#home">Web Promotion</a>
		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		      	<span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse" id="navbarSupportedContent">
		      	<ul class="navbar-nav ml-auto mb-2 mb-lg-0 navbar-right">
			        <li class="nav-item">
			        	<a class="nav-link active page-scroll" aria-current="page" href="home.php#home">Home</a>
			        </li>
			        <li class="nav-item">
			          	<a class="nav-link active page-scroll" href="home.php#About">About</a>
			        </li>
			        <li class="nav-item">
			          	<a class="nav-link active page-scroll" href="home.php#Product">Product</a>
			        </li>
			        <li class="nav-item">
			          	<a class="nav-link active page-scroll" href="home.php#Contact">Contact</a>
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

	<!-- Set Alamat -->
	<section class="Set-Alamat" id="Set-Alamat">
		<div class="container">
			<div class="latest-orders">
			<h5>Latest Orders</h5>
			<table class="table table-hover">
				<?php 
                    while ($data = $qry->fetch_assoc()) { ?>
				<tr>
					<td><?php echo $data['nama_produk']; ?></td>
					<td><?php echo $data['jumlah']; ?></td>
					<td><?php echo $data['subHarga']; ?></td>
					<td><?php echo $data['tanggal']; ?></td>
					<td>
						<?php  
							if ($data['status'] == 'Pending') {?>
								<p class="text-center" style="height: 5px; border-radius: 50px; background: #FFB5B5; color: red; font-weight: 530; height: 30px; width: 150px; margin: 1px; padding-top: 4px;"><?php echo $data['status']; ?></p>
						<?php }else { ?>
								<p class="text-center" style="height: 5px; border-radius: 50px; background: #E7FBBE; color: green; font-weight: 530; height: 30px; width: 150px; margin: 1px; padding-top: 4px;"><?php echo $data['status']; ?></p>
						<?php }  ?>
						
					</td>
				</tr>
				<?php } ?>
			</table>
		</div>
		</div>
		
	</section>
	<!-- Set Alamat -->

	
	<!-- footer -->
	<section class="footer">
		<div class="container">
			<p class="text-center">Copyright&copy;Batu Alam 2021</p>
		</div>
	</section>
	<!-- footer -->
    

    <!-- Optional JavaScript; choose one of the two! -->
    <script src="asset/jquery/jquery-3.6.0.js"></script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="asset/bootstrap/js/bootstrap.min.js"></script>

    <script src="dist/js/script.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    -->

    <div class="whatsapp" style="position:fixed;right:20px;bottom:20px;">
		<a href="https://api.whatsapp.com/send?phone=+628123456789&text=Halo">
		<button style="background: transparent; border: none;">
		<img src="image/icon/whatsapp.PNG"></button></a>
	</div>
  </body>
</html>
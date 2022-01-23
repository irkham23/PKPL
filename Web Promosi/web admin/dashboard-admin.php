<?php 

error_reporting(0);
require_once '../config/config.php';
require_once '../config/koneksi.php';

session_start();
	if (!isset($_SESSION['pembeli'])) {
	}


$limit = 5;
if(isset($_GET['p']))
{
    $noPage = $_GET['p'];
}
else $noPage = 1;

$offset = ($noPage - 1) * $limit;

$terkini = 'SELECT
orders.id_order,
orders.email,
orders.subHarga,
orders.payment,
orders.status,
orders.tanggal
FROM
orders
ORDER BY
orders.tanggal DESC
LIMIT '
.$offset.",". $limit;

$qry = $mysqli->query($terkini);

$sql_rec = "SELECT id_order FROM orders";

$total_rec = $mysqli->query($sql_rec);

$total_rec_num = $total_rec->num_rows;

$total_page = ceil($total_rec_num/$limit);

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../asset/bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../asset/font-awesome/css/font-awesome.min.css">
  	<link rel="stylesheet" type="text/css" href="../asset/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" type="text/css" href="../dist/css/admin-style.css?v=<?php echo time(); ?>">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
	<div class="header" style="background: black; height: 50px; ">
		<h3>Amanah Batu Ukir</h3>
	</div>
	<div class="container">
		<nav class="sidebar">
			<div class="text">Side Menu</div>
			<ul>
				<li><a href="dashboard-admin.php">Dashboard</a></li>
				<li>
					<a href="#" class="prod-btn ">Produk
						<span class="fas fa-caret-down first"></span>
					</a>
					<ul class="prod-show">
						<li><a href="add_produk.php">Add Produk</a></li>
						<li><a href="list_produk.php">List Produk</a></li>
					</ul>
				</li>
				<li>
					<a href="#" class="ord-btn ">Orders
						<span class="fas fa-caret-down second"></span>
					</a>
					<ul class="ord-show">
						<li><a href="new-order.php">New Orders</a></li>
						<li><a href="list-order.php">List Orders</a></li>
					</ul>
				</li>
				<li><a href="customer.php">Customers</a></li>
				<li><a href="seller.php">Sellers</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</nav>
	</div>

	<div class="dashboard">
		<div class="row">
			<div class="sales">
				<h5>Total&nbsp&nbsp Sales</h5>
				<p> Rp
					<?php 
					$data_orders = mysqli_query($connect, "SELECT * FROM orders");
                    while ($harga = mysqli_fetch_array($data_orders)) {
                    	$subHarga = $harga['subHarga'];
                    	$total =  $total+$subHarga;
                    }
                    echo $total;
                    ?>
				</p>
				<img src="../image/Simbol_admin/dollar.png">
			</div>
			<div class="sales">
				<h5>Total Orders</h5>
				<p>
					<?php 
                    $data_orders = mysqli_query($connect, "SELECT * FROM orders");
                    $jumlah_orders = mysqli_num_rows($data_orders);
                    echo $jumlah_orders;
                    ?>
				</p>
				<img src="../image/Simbol_admin/cart.png">
			</div>
			<div class="sales">
				<h5>Total Produk</h5>
				<p>
					<?php 
                    $data_orders = mysqli_query($connect, "SELECT * FROM produk");
                    $jumlah_orders = mysqli_num_rows($data_orders);
                    echo $jumlah_orders;
                    ?>
				</p>
				<img src="../image/Simbol_admin/bag.png">
			</div>
		</div>

		<div class="latest-orders">
			<h5>Latest Orders</h5>
			<div class="container" style="padding: 30px; margin-bottom: 30px;">
				<form action="rekap-order.php" method="post" >
					<select name="sort-bulan" class="form-select" aria-label="Default select example">
						<option name="sort-bulan" value="semua" selected>Pilih Bulan</option>
						<option name="sort-bulan" value="Januari">Januari</option>
						<option name="sort-bulan" value="Februari">Februari</option>
						<option name="sort-bulan" value="Maret">Maret</option>
						<option name="sort-bulan" value="April">April</option>
						<option name="sort-bulan" value="Mei">Mei</option>
						<option name="sort-bulan" value="Juni">Juni</option>
						<option name="sort-bulan" value="Juli">Juli</option>
						<option name="sort-bulan" value="Agustus">Agustus</option>
						<option name="sort-bulan" value="September">September</option>
						<option name="sort-bulan" value="Oktober">Oktober</option>
						<option name="sort-bulan" value="November">November</option>
					 	<option name="sort-bulan" value="Desember">Desember</option>
					</select>
					<input style="margin-top: 20px; float: right;" class="btn btn-primary" type="submit" name="submit" value="Report to PDF">
				</form>	
			</div>
			<table class="table table-hover">
				<?php 
                    while ($data = $qry->fetch_assoc()) { ?>
				<tr>
					<td><?php echo $data['id_order']; ?></td>
					<td><?php echo $data['email']; ?></td>
					<td>Rp <?php echo number_format($data['subHarga'],0,',','.'); ?></td>
					<td><?php echo $data['tanggal']; ?></td>
					<td>
						<?php  
							if ($data['status'] == 'Cancelled') {?>
								<p class="text-center" style="height: 5px; border-radius: 50px; background: #FFB5B5; color: red; font-weight: 530; height: 30px; width: 150px; margin: 1px; padding-top: 4px;"><?php echo $data['status']; ?></p>
						<?php }elseif($data['status'] == 'Delivered') { ?>
								<p class="text-center" style="height: 5px; border-radius: 50px; background: #E7FBBE; color: green; font-weight: 530; height: 30px; width: 150px; margin: 1px; padding-top: 4px;"><?php echo $data['status']; ?></p>
						<?php }elseif($data['status'] == 'Pending') { ?>
								<p class="text-center" style="height: 5px; border-radius: 50px; background: #FFFDA2; color: orange; font-weight: 530; height: 30px; width: 150px; margin: 1px; padding-top: 4px;"><?php echo $data['status']; ?></p>
						<?php }elseif($data['status'] == 'Finished') { ?>
								<p class="text-center" style="height: 5px; border-radius: 50px; background: #B3F7F6; color: blue; font-weight: 530; height: 30px; width: 150px; margin: 1px; padding-top: 4px;"><?php echo $data['status']; ?></p>
						<?php }  ?>					
					</td>
				</tr>
				<?php } ?>
			</table>
			<div style="padding-bottom: 10px; padding-top: 10px;">
                <nav aria-label="Page navigation example">
                </nav>
                <ul class="pagination">
                <?php if ($total_rec_num > $limit) { ?>
                <?php if ($noPage > 1 ) { ?>
                	<li class="page-item">
                		<a class="page-link" href="<?php echo $base_url."web admin/list-order.php?p=".($noPage-1);?>">
                			<span aria-hidden="true">&laquo;</span>
                    	</a>
                    </li>
                    <?php } ?>
                    <?php for ($page=1; $page <= $total_page ; $page++) { ?>
                    	<?php if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $total_page)) { ?>
                        	<?php
                                $showPage = $page;
                                if ($page==$total_page && $noPage <= $total_page-5) echo "<li class='active page-item'><a class='page-link'>...</a></li>";
                                if ($page == $noPage) echo "<li class='active page-item'><a class='page-link' href='#'>".$page."</a></li> ";
                               	else echo   " <li class='page-item' ><a class='page-link' href='".$_SERVER['PHP_SELF']."?p=".$page."'>".$page."</a></li> ";
                                if ($page == 1 && $noPage >=6) echo "<li class='active page-item'><a class='page-link'>...</a></li>";
                            ?>
                        <?php } ?>
                    <?php } ?>
                    <?php if ($noPage < $total_page) { ?>
                    	<li class="page-item">
                        	<a class="page-link" href="<?php echo $base_url."web admin/list-order.php?p=".($noPage+1); ?>">
                            	<span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php } ?>
                <?php } ?>
                </ul>
           	</div>
		</div>
	</div>

	<script>
		$('.prod-btn').click(function(){
			$('nav ul .prod-show').toggleClass("show"); 
		});
		$('.ord-btn').click(function(){
			$('nav ul .ord-show').toggleClass("show1"); 
		});
	</script>
</body>
</html>
<?php  
	session_start();
	if (!isset($_SESSION['pembeli'])) {
	}

?>

<?php  
error_reporting(0);
require_once 'config/config.php';
require_once 'config/koneksi.php';


$sql = "SELECT * FROM pembeli";

$qryIndex = $mysqli->query($sql);

if (isset($_POST['btn_publish'])) {
    $message=array();
    #Validasi Data Gambar
    $file_name = $_FILES['gambar']['name'];
    $filename = explode(".", $file_name);
    $file_extension = $filename[count($filename)-1];
    $file_weight = $_FILES['gambar']['size'];
    $target_path1="image/payment/";
    $file_max_weight = 2048000; //batas maksimum ukuran file
    $ok_ext = array('jpg','jpeg','png','JPG','JPEG','PNG'); //type file yang diperbolehkan
    //UPLOAD Gambar

    $nama = $_POST['Nama'];
    $harga = $_POST['harga'];
    $kategori = $_POST['nama_kategori'];
    $deskripsi = $_POST['deskripsi'];
    $qty = $_POST['qty'];
    $id_pembeli = $_SESSION['id_pembeli'];

    if (empty($file_name)) {
        $message[] = "<b>Anda Belum Memilih File</b>";
    }else{
        if (in_array($file_extension, $ok_ext)) {
            if ($file_weight <= $file_max_weight) {
            	move_uploaded_file($_FILES['gambar']['tmp_name'], $target_path1 . $file_name);	                
            } else {
                $message[] = "<b>Ukuran File</b> terlalu besar!";
            }
        } else {
            $message[] = "<b>Type File</b> tidak diperbolehkan";
        }
    }

    if (count($message)==0) {
        $insert_sql = "UPDATE orders SET payment = '$file_name' WHERE id_pembeli = '$id_pembeli' AND id_order = '$_GET[id]'";
        $insert_qry = $mysqli->query($insert_sql) or die ($mysqli->error);

        echo "<script>alert('Data Berhasil Ditambah'); window.location = 'pesanan.php'</script>";
    }

    if (!count($message)==0) {
        $num=0;
        foreach ($message as $index => $show_message) {
            $num++;
?>

        <div class="alert alert-danger alert-dismissable fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php
                echo $show_message;
            ?>
        </div>

<?php
        }
    }
}

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
			<div class="row">
				<div class="col-sm-2"></div>
				<div class="col-sm-8">
					<div class="btn-group" role="group" style="height: 100px; width: 100%;">
					    <button id="btnGroupDrop1" type="button" class="btn btn-outline-dark" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 3em; color: black;">
					      Bank Transfer
					    </button>
					    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="height: 100px; width: 100%;text-align: center;">
					      <li><a class="dropdown-item" href="#">BCA <br> 0927402174XXXX a/n Rofiq Izudin</a></li>
					      <li><a class="dropdown-item" href="#">BRI <br> 1292810391XXXX a/n Danar W</a></li>
					    </ul>   
					 </div>
					 <br>
					 <div class="btn-group" role="group" style="height: 100px; width: 100%; margin-top: 20px;">
					    <button id="btnGroupDrop1" type="button" class="btn btn-outline-dark" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 3em; color: black;">
					      Dompet Digital
					    </button>
					    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="height: 100px; width: 100%;text-align: center;">
					      <li><a class="dropdown-item" href="#">Dana <br> 08386812XXXX</a></li>
					      <li><a class="dropdown-item" href="#">OVO <br> 7272049712-9284</a></li>
					      <li><a class="dropdown-item" href="#">Gopay <br> 8728e71207427</a></li>
					    </ul>   
					 </div>
					 <br>
					 <div class="btn-group" role="group" style="height: 100px; width: 100%; margin-top: 20px;">
					    <button id="btnGroupDrop1" type="button" class="btn btn-outline-dark" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 3em; color: black;">
					      Cash On Delivery
					    </button>   
					 </div>
					 <form action="" method="post" enctype="multipart/form-data">
						<div class="form-group" style="margin-top: 50px;">
					 		<span style="color: black;">Upload Bukti Pembayarn</span><br>
							<input type="file" name="gambar" id="gambar">
							<script type="text/javascript">
								document.getElementById("gambar").onchange = function () {
		    						var reader = new FileReader();

		    						reader.onload = function (e) {
		        					// get loaded data and render thumbnail.
		       							document.getElementById("image").src = e.target.result;
		    							};

		    						// read the image file as a data URL.
		    							reader.readAsDataURL(this.files[0]);
									};
							</script>
							<br><img id="image" width="250" height="250" alt="Preview Gambar" style="align:center">
							<br><label class="text-muted">Ukuran gambar maks. 2 MB dengan type: jpg, png, gif</label>
						</div>
						<div>
							<input type="submit" name="btn_publish" class="btn btn-primary" value="Kirim">
						</div>	
					 </form>
				</div>
				</div>
				<div class="col-sm-2"></div>
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
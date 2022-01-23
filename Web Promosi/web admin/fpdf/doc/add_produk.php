<?php  
session_start();
    if (!isset($_SESSION['pembeli'])) {
    }

include '../config/config.php'; 
include '../config/koneksi.php';



$var_Nama = isset($_POST['Nama']) ? $_POST['Nama']:'';
$var_Harga = isset($_POST['harga']) ? $_POST['harga']:'';
$var_Qty = isset($_POST['qty']) ? $_POST['qty']:'';
$var_Foto = isset($_POST['gambar']) ? $_POST['gambar']:'';
$var_Kategori = isset($_POST['nama_kategori']) ? $_POST['nama_kategori']:'';
$var_Deskripsi = isset($_POST['deskripsi']) ? $_POST['deskripsi']:'';
if (isset($_POST['btn_publish'])) {
    $message=array();
    #Validasi Data Gambar
    $file_name = $_FILES['gambar']['name'];
    $filename = explode(".", $file_name);
    $file_extension = $filename[count($filename)-1];
    $file_weight = $_FILES['gambar']['size'];
    $target_path3="../image/gambar produk/";
    $file_max_weight = 20480000; //batas maksimum ukuran file
    $ok_ext = array('jpg','jpeg','png','JPG','JPEG','PNG'); //type file yang diperbolehkan
    //UPLOAD Gambar

    $nama = $_POST['Nama'];
    $harga = $_POST['harga'];
    $kategori = $_POST['nama_kategori'];
    $deskripsi = $_POST['deskripsi'];
    $qty = $_POST['qty'];

    if (empty($file_name)) {
        $message[] = "<b>Anda Belum Memilih File</b>";
    }else{
        if (in_array($file_extension, $ok_ext)) {
            if ($file_weight <= $file_max_weight) {
            	move_uploaded_file($_FILES['gambar']['tmp_name'], $target_path3 . $file_name);
            	
            		
            	                
            } else {
                $message[] = "<b>Ukuran File</b> terlalu besar!";
            }
        } else {
            $message[] = "<b>Type File</b> tidak diperbolehkan";
        }
    }

    if (count($message)==0) {
        $insert_sql = "INSERT INTO produk VALUES('',
                                                 '$nama',
                                                 '$file_name',
                                                 '$kategori',
                                                 '$harga',
                                             	 '$qty',
                                             	 '$deskripsi')";
        $insert_qry = $mysqli->query($insert_sql) or die ($mysqli->error);

        echo "<script>alert('Data Berhasil Ditambah'); window.location = 'add_produk.php'</script>";
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
	<div class="header">
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
		<div class="add-produk" style="background: white; width: 95%; height: 100%;">
			<h5 style="padding: 20px;">Add Product</h5>
			<hr>
			<form action="" method="post" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-6" style="padding: 20px;">
					<div class="input-group mb-3">
						<span class="input-group-text" id="inputGroup-sizing-default">Nama Produk</span>
					 	<input type="text" name="Nama" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?php echo $var_Nama; ?>">
					</div>
					<div class="input-group mb-3">
						<span class="input-group-text" id="inputGroup-sizing-default">Kategori</span>
					 	<select name="nama_kategori" class="form-select" aria-label="Default select example">
							<option selected>Pilih salah satu</option>
							<option name="nama_kategori" value="Relief">Relief</option>
						 	<option name="nama_kategori" value="Tempel">Tempel</option>
						</select>
					</div>
					<div class="input-group mb-3">
						<span class="input-group-text" id="inputGroup-sizing-default">Harga</span>
					 	<input type="text" name="harga" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?php echo $var_Harga; ?>">
					</div>
					<div class="input-group mb-3">
						<span class="input-group-text" id="inputGroup-sizing-default">Kuantitas</span>
					 	<input type="text" name="qty" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?php echo $var_Qty; ?>">
					</div>
					<div class="input-group mb-3">
						<span class="input-group-text" id="inputGroup-sizing-default">Deskripsi</span>
					 	<textarea type="text" name="deskripsi" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"><?php echo $var_Deskripsi; ?></textarea> 
					</div>
				</div>
				<div class="col-sm-6">
					<span></span><br>
					<div class="form-group">
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
						<label class="text-muted">Ukuran gambar maks. 2 MB dengan type: jpg, png, gif</label>
						<img id="image" width="100%" height="250" alt="Preview Gambar" style="align:center">
					</div>
				</div>
			</div>
			<div class="btn col-sm-12">
				<button type="submit" class="btn btn-primary" name="btn_publish" style="float: right;">TAMBAH</button>			
			</div>
			</form>
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
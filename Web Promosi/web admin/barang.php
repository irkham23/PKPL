<?php  
error_reporting(0);
require_once '../config/config.php';
require_once '../config/koneksi.php';


$limit = 10;
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
produk.qty
FROM 
produk
INNER JOIN kategori on produk.nama_kategori = kategori.nama_kategori
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
    <link rel="stylesheet" type="text/css" href="../dist/css/style.css?v=<?php echo time(); ?>">
</head>
<body>
			<h3>Barang Batu Alam</h3>
			<div class=" button-add">
				<a href="cetak.php" class="btn btn-primary">Cetak</a><br><br>
			</div>
			<div>
                <table class="table table-striped table-hover">
	               	<thead>
	               		<tr>
		                    <th>Nama</th>
		                    <th>Kategori</th>
		                    <th>Harga</th>
		                    <th>Qty</th>
		                    <th>Aksi</th>
		                    <th>Data</th>
	                   	</tr>
	               	</thead>	
	                <tbody>
                   	<?php 
                    	while ($news_list = $qryIndex->fetch_assoc()) { ?>
						<tr>
							<td><strong style="font-size: 0.8em;"><?php echo $news_list ['Nama'];?></strong></td>
							<td><?php echo $news_list['nama_kategori']; ?></td>
							<td><?php echo $news_list['harga']; ?></td>
							<td><?php echo $news_list['qty']; ?></td>
							<td >
					<?php if ($news_list['id_admin'] == $_SESSION['id_admin']) { ?>
						<a class="btn btn-sm btn-primary" target="_blank" href="<?php echo $base_url.'detail.php?id='.$news_list['Id_berita']; ?>">
							<i class="fa fa-eye"></i>
						</a>
						<a href="edit-berita.php?id=<?=$news_list['Id_berita']?>" class="btn btn-sm btn-warning">
							<i class="fa fa-edit"></i>
						</a>
						<a onclick="return confirm('Anda Yakin Ingin Menghapus Data Ini?');" href="hapus-berita.php?id=<?=$news_list['Id_berita']?>" class="btn btn-sm btn-danger">
							<i class="fa fa-trash"></i>
						</a>
					<?php } else { ?>
						<a class="btn btn-sm btn-primary" target="_blank" href="<?php echo $base_url.'detail.php?id='.$news_list['Id_berita']; ?>">
							<i class="fa fa-eye"></i>
						</a>
					<?php } ?>
					</td>
					<td>
						<a class="btn btn-sm btn-primary" target="_blank" href="<?php echo $base_url.'web admin/barang_xml.php'; ?>">
							XML
						</a>
						<a class="btn btn-sm btn-primary" target="_blank" href="<?php echo $base_url.'web admin/barang_json.php'; ?>">
							JSON
						</a>
					</td>
				</tr>
				<?php } ?>
            </tbody>
        </table>
    </div>

</body>
</html>
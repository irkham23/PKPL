<?php
include '../config/config.php'; 
include '../config/koneksi.php';

session_start();
    if (!isset($_SESSION['pembeli'])) {
    }
    
$sql_produk = "SELECT produk.gambar FROM produk WHERE produk.id_produk='$_GET[id]'";

$qry_produk = $mysqli->query($sql_produk) or die ($mysqli->error);

$num = $qry_produk->num_rows;

$data = $qry_produk->fetch_assoc();
?>
<?php
if ($num==0) {
	header('location:list_produk.php');
} else {
	$del_sql = "DELETE FROM produk WHERE produk.id_produk='$_GET[id]'";

	$del_qry = $mysqli->query($del_sql);

	if ($del_qry) {
		unlink('../image/gambar produk/'.$data['gambar']);
		echo "<script>alert('Data Berhasil Dihapus'); window.location = 'hapus-produk.php'</script>";
		echo "<meta http-equiv='refresh' content='0;url=list_produk.php'>";
	} else {
		echo $mysqli->error;
	}
}?>
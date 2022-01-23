<?php
		$namaErr = $emailErr = $nohpErr = $passwordErr = $konfirm_passwordErr = "";
		$nama = $email = $nohp = $password = $konfirm_password = "";
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (empty($_POST["nama"])) {
				$namaErr = "*Nama harus diisi";
			}else {
				$nama = test_input($_POST["nama"]);
				if (!filter_var($nama, FILTER_SANITIZE_STRING)) {
					$namaErr = "*Nama tidak sesuai format";
				}
			}
			if (empty($_POST["email"])) {
				$emailErr = "*Email harus diisi";
			}else {
				$email = test_input($_POST["email"]);
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$emailErr = "*Email tidak sesuai format";
				}
			}
			if (empty($_POST["nohp"])) {
				$nohpErr = "*Nomor Handpond harus diisi";
			}else {
				$nohp = test_input($_POST["nohp"]);
				if (!filter_var($nohp, FILTER_SANITIZE_NUMBER_INT)) {
					$nohpErr = "*Nomor handphone tidak sesuai format";
				}
			}
			if (empty($_POST["password"])) {
				$passwordErr = "*Password harus diisi";

			}else {
				$password = test_input($_POST["password"]);
				if (strlen($password) <= "8") {
					$passwordErr = "*Password harus lebih dari 8 karakter";
				}
			}
			if (empty($_POST["konfirm_password"])) {
				$konfirm_passwordErr = "Harus diisi";
			}else {
				if ($_POST["konfirm_password"] == $_POST["password"]) {
					return true;
				}else{
					$konfirm_passwordErr = "*Password tidak sama";
				}
			}
			if (empty($namaErr)&&empty($emailErr)&&empty($nohpErr)&&empty($passwordErr)) {
				if (isset($_POST['submit'])) {
					$nama = $_POST['nama'];
					$email = $_POST['email'];
					$nohp = $_POST['nohp'];
					$password = $_POST['password'];
					$role = "customer";

					include_once("config/config.php");
					include_once("config/koneksi.php");

					mysqli_query($connect, "INSERT INTO pembeli (id_pembeli, nama, email, no_hp, alamat, password, role) VALUES (' ', '$nama', '$email', '$nohp', ' ', md5('$password'), '$role')");

					header("Location: index.php");
				}
			}
		}

		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
	?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="asset/bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
  	<link rel="stylesheet" type="text/css" href="asset/font-awesome/css/font-awesome.min.css">
  	<link rel="stylesheet" type="text/css" href="asset/fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" type="text/css" href="dist/css/style.css?v=<?php echo time(); ?>">
	<script src="../asset/jquery/jquery-3.6.0.js"></script>
	<script async defer src="../asset/bootstrap/js/bootstrap.min.js"></script>

</head>
<body>
	<div class="register">
		<h1 class="text_login">Web Promosi</h1>
		<form action="daftar.php" method="post" >
			<input type="text" name="nama" class="form_user" placeholder="Nama"><span class="error"><?php echo $namaErr; ?></span>
			<input type="text" name="email" class="form_user" placeholder="E-mail"><span class="error"><?php echo $emailErr; ?></span>
			<input type="number" name="nohp" class="form_user" placeholder="Nomor Handphone"><span class="error"><?php echo $nohpErr; ?></span>
			<input type="password" id="password" name="password" class="form_password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Harus berisi setidaknya satu angka dan satu huruf besar dan kecil, dan setidaknya 8 karakter atau lebih" required>
			<input type="checkbox" onclick="myFunction()" id="show-password"> Tampilkan Password
			<span class="error"><?php echo $passwordErr; ?></span>
			<input type="submit" class="masuk" name="submit" value="DAFTAR"> <br>
			<a href="login.php" class="daftar text-center">Sudah punya akun? Login disini.</a>
		</form>
	</div>	
	
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script>
        $(document).ready(function() {
            $('#show-password').click(function() {
                if ($(this).is(':checked')) {
                    $('#password').attr('type', 'text');
                } else {
                    $('#password').attr('type', 'password');
                }
            });
        });
    </script>
</html>
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
	<?php if (isset($_GET['failed']) && $_GET['failed']==1) { ?>
            <script type="text/javascript">
            	alert('Username/Password Salah.');
            </script>
    <?php } ?>
	<div class="login">
		<h1 class="text_login">Web Promosi</h1>
		<form action="login_cek.php" method="post" onSubmit="return validasi()">
			<input type="text" id="user" name="user" class="form_user" placeholder="E-mail">
			<input type="password" id="password" name="password" class="form_password" placeholder="Password">
			<input type="submit" class="masuk" value="LOGIN"> <br>
			<a href="daftar.php" class="daftar text-center">Belum punya akun? Daftar disini.</a>
		</form>
	</div>	
</body>
<script type="text/javascript">
	function validasi() {
		var username = document.getElementById("user").value;
		var password = document.getElementById("password").value;		
		if (username != "" && password!="") {
			return true;
		}else{
			alert('Username dan Password harus di isi !');
			return false;
		}
	}
</script>
</html>
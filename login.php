<?php
session_start();
$con = mysqli_connect('localhost', 'quillota_inventario', 'invent2021', 'quillota_inventario');
if (isset($_POST['submit'])) {
	$username = mysqli_real_escape_string($con, $_POST['username']);
	$password = mysqli_real_escape_string($con, $_POST['password']);

	$res = mysqli_query($con, "select * from usuario_inv where nombre='$username' and password='$password'");
	if (mysqli_num_rows($res) > 0) {
		$_SESSION['IS_LOGIN'] = 'yes';
		$_SESSION['usuario'] = $username;
		header('location:index.php');
		die();
	}
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php require_once "header.php"; ?>
	<title>Inventario Quillota.cl</title>
</head>

<body class="body-inv">
	<div class="container-fluid">
		<nav class="navbar navbar-dark nav-titulo">
			<div class="container-fluid">
				<div class="banner">
					<img src="img/logo-qta.png" width="140" height="55" style="position:absolute;margin-top:8px;">
					<div class="text-center" style="color:white;margin-left: 400px;margin-bottom:20px;margin-top:20px;font-size:30px;">
						<h3 style="margin-top:0px;">INVENTARIO DE INSUMOS Y ACCESORIOS</h3>
					</div>
				</div>
			</div>
		</nav>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-2">
			</div>
			<div class="col-8 main-section">
				<div class="modal-dialog text-center" style="max-width: 350px;">
					<div class="modal-content recuadro-login">
						<div class="col-12 user-img">
							<img src="img/user_icon.png" />
						</div>
						<form class="col-12" method="POST">
							<div class="form-group" id="user-group">
								<input type="text" class="form-control" name="username" placeholder="Usuario">
							</div>
							<div class="form-group" id="pass-group">
								<input type="password" class="form-control" name="password" placeholder="Contraseña">
							</div>
							<div class="form-group row">
								<div class="col-sm">
									<button type="submit" name="submit" class="btn btn-primary btn-block btn-login"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-2">
			</div>
		</div>
	</div>
</body>

</html>
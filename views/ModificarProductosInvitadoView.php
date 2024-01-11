<?php
require_once "../class/Conexion.php"; 
include "../class/Producto.php";
$idProducto = $_GET['ide'];
$Productos = new Productos();
$data = $Productos->mostrarProdId($idProducto);
foreach ($data as $Objeto) {
	?>
	<html lang="es">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php include "../header.php";?>
		<title>Inventario Municipal</title>
	</head>
	<body>
		<div class="container-fluid"> 
			<nav class="navbar navbar-dark bg-dark" style="margin-top:5px;float: none;text-align: center;">
				<div class="container-fluid">
					<div style="color:white;margin-bottom:20px;margin-top:20px;font-size:30px;">
						<img src="../img/logo-qta.png" width="140" height="55">
						<h3 class='navbar-text navbar-center' style="position: absolute;width:100%;left:0;text-align:center;overflow:visible;height:0;color:white;margin-bottom:5px;font-size:24px;">INVENTARIO DE INSUMOS Y ACCESORIOS
						</h3>
						<br>
						<h6 class='navbar-text navbar-center' style="position: absolute;width:100%;left:0;text-align:center;overflow:visible;height:0;color:white;margin-bottom:20px;font-size:16px;">DEPARTAMENTO DE INFORMÁTICA
						</h6>
					</div> 
				</div>
			</nav>

			<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
				<a class="navbar-brand" href="https://quillota.cl/inventario/invitado.php">Inventario</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNavDropdown">
					<ul class="navbar-nav">
						<li class="nav-item active">
							<a class="nav-link" href="https://quillota.cl/inventario/invitado.php">Inventario <span class="sr-only">(current)</span></a>
						</li>
					</ul>
				</div>


				<ul class="nav navbar-nav navbar-right">
					<li class="nav-item"><a class="nav-link " style="color: white;">
						<i class="fas fa-user"></i> <?=$_SESSION['usuario']?></a>
					</li>
					<li class="nav-item"><a class="nav-link" href="logout.php" style="color: #dc3545 !important">
						<i class="fas fa-sign-out-alt"></i> Desconectar</a>
					</li>
				</ul>
			</nav>
		</div>
		<div class="container" style="margin-top: 80px;">
			<div class="alert alert-success" role="alert">
				<div class="alert-heading">
					<h4><i class="far fa-edit"></i> Apertura de requerimiento</h4>
				</div>
			</div>
			<div class="row align-items-center">		
				<div class="col-md-6">
					<div class="p-2 bd-highlight">
						<div class="card text-center">
							<div class="card-body">
								<img src="https://quillota.cl/inventario/img/producto.png" class="avatar" alt="Avatar">
								<h5 class="card-title"><?php echo $Objeto->categoria;?></h5>
								<h5 class="card-title"><?php echo $Objeto->nombre;?></h5>
								<h5 class="card-title">Cantidad: <?php echo $Objeto->stock;?></h5>
							</div>
						</div>
					</div>
				</div>

				<?php 
				$cantidad = $Objeto->stock;
				if($cantidad > 0){
					?>
					<div class="col-md-6 float-left">
						<button type="button" class="btn btn-success btnAgregarSolicitud" value="<?php echo $Objeto->idProducto;?>" data-toggle="modal" data-target="#agregarSolicitud">
							<i class="fas fa-plus"></i> Crear solicitud
						</button>
						<a href="https://quillota.cl/inventario/invitado.php"><button type="button" class="btn btn-danger">
							<i class="fas fa-arrow-left"></i> Regresar al menú principal
						</button></a>
						<div class="modal fade" id="agregarSolicitud" tabindex="-1" role="dialog" aria-labelledby="agregarSolicitud" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<form class="needs-validation" id="formAgregarSolicitud" method="post" novalidate>
										<div class="modal-header">
											<h5 class="modal-title"><i class="far fa-edit"></i> Nueva solicitud</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text" id="inputGroup-sizing-default">Producto</span>
												</div>
												<input type="text" class="form-control" name ="nomProducto" value="<?=$Objeto->nombre;?>" disabled>
												<input type="hidden" class="form-control" name ="nomProductos" value="<?=$Objeto->nombre;?>">
											</div>
											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<label class="input-group-text" id="inputGroup-sizing-default" for="nomFuncionario">Nombre y Apellido</label>
												</div>
												<input type="text" class="form-control" name ="nomFuncionario" value="" required>
												<div class="invalid-feedback">
													Por favor ingrese su nombre antes de continuar
												</div>
											</div>
											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<label class="input-group-text" id="inputGroup-sizing-default" for="correoFuncionario">Correo institucional:</label>
												</div>
												<input type="text" class="form-control" name ="correoFuncionario" value="" required>
												<div class="invalid-feedback">
													Por favor ingrese su correo antes de continuar
												</div>
											</div>
											
											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<label class="input-group-text">Oficina</label>
												</div>
												<select class="custom-select form-control" name="selOficina" onchange="document.getElementById('ofiFuncionario').value=this.options[this.selectedIndex].text">
													<option selected disabled>Seleccione:</option>
													<?php 
													$Producto_tres = new Productos();
													$oficina_prod = $Producto_tres->mostrarOficinas();
													if($oficina_prod){  
														foreach($oficina_prod as $Objeto_tres){?>
															<option value="<?=$Objeto_tres->idOficina?>"><?=$Objeto_tres->Nombre?></option>
														<?php }
													}?>
												</select>
												<input type="hidden" name="ofiFuncionario" id="ofiFuncionario" value="<?=$Objeto_tres->Nombre;?>">
											</div>

											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<label class="input-group-text" id="inputGroup-sizing-default" for="stockFuncionario">Cantidad</label>
												</div>
												<input type="text" class="form-control" name ="stockFuncionario" value="" required>
												<div class="invalid-feedback">
													Por favor ingrese la cantidad antes de continuar
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
											<button type="submit" class="btn btn-primary btnNuevoPedido">Ordenar</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				<? } ?>
			</div>
		</div>
	</body>
	</html>

<?php } ?>


<script type="text/javascript">
	$(document).ready(function(){

		$(".btnNuevoPedido").on("click",function(event){
			event.preventDefault();
			var accion = 'pedir';
			var idProducto = <?php echo $idProducto?>;
			$.ajax({
				type: "POST",
				url: "../controller/controllerPedidos.php",
				data: $('#formAgregarSolicitud').serialize() + '&idProducto=' + idProducto ,
				success: function(data){
					if (data==''){ 
						window.location.reload(true);
					}else{
						alert(data);
					}
				}
			});
		});
	});


	(function() {
		'use strict';
		window.addEventListener('load', function() {
			var forms = document.getElementsByClassName('needs-validation');
			var validation = Array.prototype.filter.call(forms, function(form) {
				form.addEventListener('submit', function(event) {
					if (form.checkValidity() === false) {
						event.preventDefault();
						event.stopPropagation();
					}
					form.classList.add('was-validated');
				}, false);
			});
		}, false);
	})();
</script>


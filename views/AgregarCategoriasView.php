<!-- VISUALIZACION TODO EL INVENTARIO -->

<!DOCTYPE html>
<html lang="es">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php require_once "../header.php";
	session_start();
	require_once "../class/Conexion.php";
	include "../class/Categoria.php";
	?>

	<link href="https://quillota.cl/inventario/assets/css/icons.min.css" rel="stylesheet" type="text/css">
	<link href="https://quillota.cl/inventario/assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style">
	<title>Inventario Municipal</title>
</head>

<body>
	<div class="wrapper">
		<!-- INICIO SIDEBAR -->
		<?php require_once "../sidebar.php"; ?>
		<!-- FIN SIDEBAR -->

		<!-- INICIO CONTENIDO-->
		<div class="container" style="margin-top: 80px;">
			<div class="row">
				<div class="col-6">
					<div class="alert alert-light d-flex" role="alert">
						<div class="col-6">
							<button type="button" class="btn btn-success" data-toggle="modal" data-target="#nuevaCategoria" style="background-color: #32BDBE !important; border-color: #32BDBE !important; box-shadow: 0 2px 6px 0 #32BDBE80 !important;" onmouseover="this.style.backgroundColor='#2c9c9d !important'">
								<i class="fas fa-plus"></i> Agregar nueva categoría
							</button>
							<div class="modal fade" id="nuevaCategoria" tabindex="-1" role="dialog" aria-labelledby="nuevaCategoria" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<form id="formCategoria">
											<div class="modal-header">
												<h5 class="modal-title">Agregar nueva categoría</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text" id="inputGroup-sizing-default">Categoría</span>
													</div>
													<input type="text" class="form-control" name ="nomCategoria">
												</div>

												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text" id="inputGroup-sizing-default">Descripción</span>
													</div>
													<input type="text" class="form-control" name ="descCategoria">
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
												<button type="submit" class="btn btn-primary btnGuardarCategoria">Guardar</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<?php 
			unset($Producto);
			include("MostrarCategoriasView.php");
			?>
		</div>
	</div>

	<!-- FIN CONTENIDO -->
</div>
</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
		$(".btnGuardarCategoria").on("click",function(event){
			event.preventDefault();
			$.ajax({
				type: "POST",
				url: "../controller/controllerCat.php",
				data: $('#formCategoria').serialize(),
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
</script>
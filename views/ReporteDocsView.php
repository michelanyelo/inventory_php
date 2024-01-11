<?php
session_start();
$user = $_SESSION['usuario'];
require_once "../class/Conexion.php";
include "../class/Producto.php";
?>


<!DOCTYPE html>
<html lang="es">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php require_once "../header.php";?>
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
			<a class="navbar-brand" href="https://quillota.cl/inventario/index.php">Inventario</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="https://quillota.cl/inventario/index.php">Inventario <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="https://quillota.cl/inventario/views/AgregarCategoriasView.php">Categorias</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="https://quillota.cl/inventario/views/ReporteDocsView.php">Documentación</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="https://quillota.cl/inventario/views/LibroInventarioView.php">Libro Inventario</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="https://quillota.cl/inventario/views/SolicitudesView.php">Solicitudes</a>
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
				<div class="btn-group float-right">
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#buscarOrden">
						<i class="fas fa-search"></i> Buscar Comprobante de Entrega
					</button>
				</div>
				<div class="modal fade" id="buscarOrden" tabindex="-1" role="dialog" aria-labelledby="buscarOrden" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<form id="formOrdenCompra" method="POST" action="">
								<div class="modal-header">
									<h5 class="modal-title">Buscar Comprobante de Entrega</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<select class="custom-select form-control" name="nombreProd" onchange="document.getElementById('nombreprod_text').value=this.options[this.selectedIndex].text">
										<option value="0" selected disabled>Elegir insumo...</option>
										<?php 
										$Producto = new Productos();
										$prods = $Producto->mostrarDatos();
										if($prods){  
											foreach($prods as $Objeto){?>
												<option value="<?=$Objeto->idProducto?>"><?=$Objeto->nombre?></option>
											<?php }
										}?>
									</select>
									<input type="hidden" name="nombreprod_text" id="nombreprod_text" value="">
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
									<button type="submit" class="btn btn-primary btnBuscarOC">Buscar</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<h4><i class="fas fa-search"></i> Buscar Comprobante de Entrega</h4>
			</div>
		</div>
	</div>

	<div id="tabla-registros" style="display: none;">
		<div class="container" style="margin-top: 80px;">
			<div class="alert alert-info" role="alert">
				<div class="alert-heading">
					<h3>COMPROBANTE DE ENTREGA: <?=$_POST['nombreprod_text'];?></h3>
				</div>
			</div>
			<div class="table-responsive text-center" style="margin-top: 80px; margin-bottom: 40px;"> 
				<table id="tabla-registros" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th style="display: none;">ID PRODUCTO</th>
							<th>FECHA</th>
							<th>USUARIO</th>
							<th>DOCUMENTO</th>
							<th>VISUALIZAR</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						unset($Producto);
						$Producto = new Productos();
						$idProducto = $_POST['nombreProd'];
						$nom_producto = $_POST['nombreprod_text'];
						$registroDocs = $Producto->mostrarDocs($idProducto, $nom_producto);
						foreach ($registroDocs as $Objeto) { 
							?>
							<tr>
								<!-- PROPIEDAD: ID -->
								<td style="display: none;">
									<?php echo $Objeto->idProducto;?> 
								</td>
								<!-- PROPIEDAD: FECHA -->
								<td>
									<?php echo $Objeto->fecha;?>
								</td>
								<!-- PROPIEDAD: USUARIO -->
								<td>
									<?php echo $Objeto->usuario;?>
								</td>
								<!-- PROPIEDAD: DOC -->
								<td>
									<?php echo $Objeto->doc;?>
								</td>
								<td class="text-center">
									<a href="../documentos/<?=$Objeto->doc?>" target="_blank" class="btn btn-danger" role="button" aria-pressed="true"><i class="fas fa-file-download"></i></a>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>  
		</div>
	</div>
</body>
</html>


<?php 
$Producto = new Productos();
$idProducto = $_POST['nombreProd'];
$nom_producto = $_POST['nombreprod_text'];
$registroDocs = $Producto->mostrarDocs($idProducto, $nom_producto);
if($registroDocs){  ?>
	<script type="text/javascript">
		$(document).ready(function(){
			createDiv();
		});
	</script>
<?php } ?>

<script type="text/javascript" language="javascript">
	function createDiv(){
		$(document).ready(function(){
			$("#tabla-registros").show();
		});
	}
</script>
<?php
session_start();
$user = $_SESSION['usuario'];
require_once "../class/Conexion.php";
include "../class/Producto.php";
include "../class/Pedidos.php";
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
					<li class="nav-item">
						<a class="nav-link" href="https://quillota.cl/inventario/views/ReporteDocsView.php">Documentación</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="https://quillota.cl/inventario/views/LibroInventarioView.php">Libro Inventario</a>
					</li>
					<li class="nav-item active">
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
				<h4><i class="fas fa-search"></i> Historial de solicitudes</h4>
			</div>
		</div>
	</div>

	<div class="container" style="margin-top: 80px;">
		<div class="table-responsive text-center" style="margin-top: 80px; margin-bottom: 40px;"> 
			<table id="tabla-solicitudes" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th style="display: none;">ID PEDIDO</th>
						<th>FECHA</th>
						<th>HORA</th>
						<th>FUNCIONARIO</th>
						<th>CORREO</th>
						<th>OFICINA</th>
						<th>CANTIDAD</th>
						<th>INSUMO</th>
						<th>ACCIÓN</th>
						<th>ESTADO</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					unset($Pedido);
					$Pedido = new Pedidos();
					$historial = $Pedido->mostrarSolicitudes();
					foreach ($historial as $Objeto) { 
						?>
						<tr>
							<!-- PROPIEDAD: ID -->
							<td style="display: none;">
								<?php echo $Objeto->idPedido;?>
							</td>
							<!-- PROPIEDAD: FECHA -->
							<td>
								<?php echo $Objeto->fecha;?>
							</td>
							<!-- PROPIEDAD: HORA -->
							<td>
								<?php echo $Objeto->hora;?>
							</td>
							<!-- PROPIEDAD: USUARIO -->
							<td>
								<?php echo $Objeto->nombre;?>
							</td>
							<!-- PROPIEDAD: CORREO -->
							<td>
								<?php echo $Objeto->correo;?>
							</td>	
							<!-- PROPIEDAD: OFICINA -->
							<td>
								<?php echo $Objeto->oficina;?>
							</td>
							<!-- PROPIEDAD: CANTIDAD -->
							<td>
								<?php echo $Objeto->cantidad;?>
							</td>
							<!-- PROPIEDAD: PRODUCTO -->
							<td>
								<?php echo $Objeto->producto?>
							</td>
							<td class="text-center">
								<a href="https://quillota.cl/inventario/views/ModificarProductosView.php?ide=<?php echo $Objeto->idProducto;?>"> Ir al insumo </a>
							</td>
							<td>
								<div class="form-check form-switch">
									<?php if($Objeto->estado == '1'){ ?>
										<input class="form-check-input check_estado" type="checkbox" value="<?=$Objeto->idPedido;?>" checked>
										<label class="form-check-label" for="check_estado">Entregado</label>
									<?php }else{ ?>
										<input class="form-check-input check_estado" type="checkbox" value="<?=$Objeto->idPedido;?>">
										<label class="form-check-label" for="check_estado">Entregado</label>
									<?php } ?>
								</div>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>  
	</div>
</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){ 
		var table = $('#tabla-solicitudes').DataTable({
			language: {
				"decimal": "",
				"emptyTable": "No hay información",
				"info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
				"infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
				"infoFiltered": "(Filtrado de _MAX_ total entradas)",
				"infoPostFix": "",
				"thousands": ",",
				"lengthMenu": "Mostrar _MENU_ Entradas",
				"loadingRecords": "Cargando...",
				"processing": "Procesando...",
				"search": "Buscar:",
				"zeroRecords": "Sin resultados encontrados",
				"paginate": {
					"first": "Primero",
					"last": "Ultimo",
					"next": "Siguiente",
					"previous": "Anterior"
				}
			},
			"order": [[ 1, "asc" ]],
			pageLength : 50,
			lengthChange: false,
			buttons: [{
				extend: "pdf", className: "btn btn-secondary", text: '<i class="far fa-file-pdf"></i> PDF', orientation: 'portrait', pageSize: 'LEGAL', exportOptions: {
					columns: [1,2,3,4,5,6]
				}
			},{
				extend:"print", className: "btn btn-secondary", text: '<i class="fas fa-print"></i> Imprimir' ,
				exportOptions: {
					columns: [1,2,3,4,5,6]
				}
			}],
		});
		table.buttons().container()
		.appendTo( '#tabla-solicitudes_wrapper .col-md-6:eq(0)' );


		$('.check_estado').change(function() {
			event.preventDefault();
			var accion = 'modificar';
			var idPedido = $(this).val();

			if ($(this).is(":checked")) {
				var estado = 'true';
			}else{
				var estado = 'false';
			}

			$.ajax({
				type: "POST",
				url: "../controller/controllerPedidos.php",
				data: {accion:accion, idPedido:idPedido, estado:estado},
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

<style type="text/css">
	.dt-buttons{
		float: left;
	}
</style>
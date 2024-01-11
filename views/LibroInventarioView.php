<!-- VISUALIZACION TODO EL HISTORIAL -->


<!DOCTYPE html>
<html lang="es">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php require_once "../header.php";
	session_start();
	$user = $_SESSION['usuario'];
	require_once "../class/Conexion.php";
	include "../class/Producto.php";
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
			<div class="table-responsive text-center" style="margin-top: 80px; margin-bottom: 40px;">
				<table id="tabla-movimiento" class="table table-striped">
					<thead>
						<tr>
							<th>FECHA</th>
							<th>HORA</th>
							<th>USUARIO</th>
							<th>ACCIÓN</th>
							<th>INSUMO</th>
							<th>DEPENDENCIA</th>
							<th>RESPONSABLE</th>
						</tr>
					</thead>
					<tbody>
						<?php
						unset($Producto);
						$Producto = new Productos();
						$libroinventario = $Producto->mostrarLogsHistorico();
						foreach ($libroinventario as $Objeto) {
							?>
							<tr>
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
									<?php echo $Objeto->usuario;?>
								</td>
								<!-- PROPIEDAD: ACCION -->
								<td>
									<?php echo $Objeto->comentario;?>
								</td>
								<!-- PROPIEDAD: PRODUCTO -->
								<td>
									<?php echo $Objeto->nombre;?>
								</td>
								<!-- PROPIEDAD: DESTINO -->
								<td>
									<?php echo $Objeto->destino;?>
								</td>
								<!-- PROPIEDAD: RESPONSABLE -->
								<td>
									<?php echo $Objeto->responsable;?>
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

<script type="text/javascript">
	$(document).ready(function(){
		var table = $('#tabla-movimiento').DataTable({
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
			"order": [[ 0, "desc", 1, "desc" ]],
			pageLength : 20,
			lengthChange: false,
			buttons: [{
				extend: "pdf", className: "btn btn-secondary", text: '<i class="far fa-file-pdf"></i> PDF', orientation: 'portrait', pageSize: 'LEGAL', exportOptions: {
					columns: [0,1,2,3,4,5,6]
				}
			},{
				extend:"print", className: "btn btn-secondary", text: '<i class="fas fa-print"></i> Imprimir' ,
				exportOptions: {
					columns: [0,1,2,3,4,5,6]
				}
			}],
		});
		table.buttons().container()
		.appendTo( '#tabla-movimiento_wrapper .col-md-6:eq(0)' );
	});
</script>

<style type="text/css">
	.dt-buttons{
		float: left;
	}
</style>

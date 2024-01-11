<?php
session_start();
$user = $_SESSION['usuario'];
require_once "../class/Conexion.php"; 
include "../class/Producto.php";
include "../class/Categoria.php";
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
				<a class="navbar-brand" href="https://quillota.cl/inventario/index.php">Inventario</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNavDropdown">
					<ul class="navbar-nav">
						<li class="nav-item active">
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
					<h4><i class="far fa-edit"></i> Modificar Producto</h4>
				</div>
			</div>
			<div class="row">		
				<div class="col-md-6">
					<div class="p-2 bd-highlight">
						<div class="card text-center">
							<div class="card-body">
								<img src="https://quillota.cl/inventario/img/producto.png" class="avatar" alt="Avatar">
								<h5 class="card-title"><?php echo $Objeto->categoria;?></h5>
								<h5 class="card-title"><?php echo $Objeto->nombre;?></h5>
								<h5 class="card-title">Cantidad: <?php echo $Objeto->stock;?></h5>
								<!-- <button type="button" class="btn btn-danger btnEliminarProd"><i class="fas fa-trash-alt"></i> Eliminar</button>
								<button type="button" class="btn btn-warning btnEditarProd" data-toggle="modal" data-target="#editarProducto">
									<i class="fas fa-pencil-alt"></i> Editar
								</button>
							-->
							<div class="modal fade" id="editarProducto" tabindex="-1" role="dialog" aria-labelledby="editarProducto" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<form id="formEditar">
											<div class="modal-header">
												<h5 class="modal-title"><i class="far fa-edit"></i> Editar producto</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text" id="inputGroup-sizing-default">Producto</span>
													</div>
													<input type="text" class="form-control" name ="nomProducto" value="<?=$Objeto->nombre;?>">
												</div>

												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<label class="input-group-text" for="inputGroupSelect01">Categoría</label>
													</div>
													<select class="custom-select form-control" name="CategoriaProd" onchange="document.getElementById('categoriaprod_text').value=this.options[this.selectedIndex].text">
														<?php
														unset($Categoria);
														$Categoria = new Categorias(); 
														$nombre_cat = $Objeto->categoria;
														$id_aux = $Categoria->mostrarIdCategorias($nombre_cat);
														$id_final = $id_aux[0]->idCategoria;
														?>
														<option value="<?=$id_final;?>"><?=$Objeto->categoria;?></option>
														<?php 
														$Producto_dos = new Productos();
														$categoria_prod = $Producto_dos->mostrarCategorias();
														if($categoria_prod){  
															foreach($categoria_prod as $Objeto_dos){?>
																<option value="<?=$Objeto_dos->idCategoria?>"><?=$Objeto_dos->nombre?></option>
															<?php }
														}?>
													</select>
													<input type="hidden" name="categoriaprod_text" id="categoriaprod_text" value="<?=$Objeto->categoria;?>">
												</div>

												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text" id="inputGroup-sizing-default">Cantidad</span>
													</div>
													<input type="text" class="form-control" name ="stockProducto" value="<?=$Objeto->stock;?>" disabled>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
												<button type="submit" class="btn btn-primary btnModificarProducto">Guardar</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-6 float-left">
				<button type="button" class="btn btn-success btnAgregarStock" value="<?php echo $Objeto->idProducto;?>" data-toggle="modal" data-target="#agregarStock">
					<i class="fas fa-plus"></i> Agregar Stock
				</button>
				<div class="modal fade" id="agregarStock" tabindex="-1" role="dialog" aria-labelledby="agregarStock" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<form id="formAgregarStock" method="post">
								<div class="modal-header">
									<h5 class="modal-title"><i class="far fa-edit"></i> Agregar Stock</h5>
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
									</div>

									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text" id="inputGroup-sizing-default">Cantidad</span>
										</div>
										<input type="text" class="form-control" name ="stockProducto" value="">
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
									<button type="submit" class="btn btn-primary btnGuardarMasStock">Guardar</button>
								</div>
							</form>
						</div>
					</div>
				</div>


				<?php 
				$cantidad = $Objeto->stock;
				if($cantidad > 0){
					?>

					<button type="button" class="btn btn-secondary btnQuitarStock" value="<?php echo $Objeto->idProducto;?>" data-toggle="modal" data-target="#quitarStock">
						<i class="fas fa-minus"></i> Quitar Stock
					</button>
					<div class="modal fade" id="quitarStock" tabindex="-1" role="dialog" aria-labelledby="quitarStock" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<form id="formQuitarStock" method="post">
									<div class="modal-header">
										<h5 class="modal-title"><i class="far fa-edit"></i> Quitar Stock</h5>
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
										</div>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text" id="inputGroup-sizing-default">Cantidad</span>
											</div>
											<input type="text" class="form-control" name ="stockProducto" value="">
										</div>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<label class="input-group-text">Oficina</label>
											</div>
											<select class="custom-select form-control" name="selOficina" onchange="document.getElementById('seloficina_text').value=this.options[this.selectedIndex].text">
												<option selected disabled>Seleccione:</option>
												<?php 
												$Producto_tres = new Productos();
												$oficina_prod = $Producto_tres->mostrarOficinas();
												if($oficina_prod){  
													foreach($oficina_prod as $Objeto_tres){?>
														<option value="<?=$Objeto_tres->idOficina?>"><?=strtoupper($Objeto_tres->Nombre)?></option>
													<?php }
												}?>
											</select>
											<input type="hidden" name="seloficina_text" id="seloficina_text" value="<?=$Objeto_tres->Nombre;?>">
										</div> 
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text" id="inputGroup-sizing-default">Responsable</span>
											</div>
											<input type="text" class="form-control" name ="responsable_text" value="">
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
											<button type="submit" class="btn btn-primary btnGuardarMenosStock">Guardar</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>

		<div class="container">
			<?php 
			unset($Producto);
			include("MostrarLogsView.php");
			?>
		</div>
	</body>
	</html>

<?php } ?>


<?php 
if (isset($_POST['upload'])){
	$Producto = new Productos();
	$file_name = $_FILES["file"]["name"];
	$file_tem_loc = $_FILES["file"]["tmp_name"];
	$file_store = "../documentos/".$file_name;
	move_uploaded_file($file_tem_loc, $file_store);
	$Producto->setArchivo($file_name);
	$nom_producto = $Objeto->nombre;
	$Producto->ModificarArchivoProducto($idProducto, $user, $nom_producto);
	unset($Producto);
}
?>

<script type="text/javascript">
	$(document).ready(function(){

		$(".btnModificarProducto").on("click",function(event){
			event.preventDefault();
			var accion = 'modificar';
			var idProducto = <?php echo $idProducto?>;
			$.ajax({
				type: "POST",
				url: "../controller/controllerProd.php",
				data: $('#formEditar').serialize() + '&accion=' + accion + '&idProducto=' + idProducto,
				success: function(data){
					if (data==''){ 
						window.location.reload(true);
					}else{
						alert(data);
					}
				}
			});
		});

		$(document.body).on('click', '.btnEliminarProd', function() {
			var result = confirm("¿Está seguro/a de esta operación?");
			if (result) {
				var accion = 'eliminar';
				var idProducto = <?php echo $idProducto?>;
				$.ajax({
					type    : 'POST',
					url: "../controller/controllerProd.php",
					data    : {idProducto:idProducto, accion:accion},
					success: function(data){
						if (data!='error'){  
							document.location.href="../";
						}
					}
				});
			}
		});

		$(".btnGuardarMasStock").on("click",function(event){
			event.preventDefault();
			var accion = 'sumar';
			var idProducto = <?php echo $idProducto?>;
			var user = '<?php echo $user?>';
			$.ajax({
				type: "POST",
				url: "../controller/controllerProd.php",
				data: $('#formAgregarStock').serialize() + '&accion=' + accion + '&idProducto=' + idProducto + '&user=' + user,
				success: function(data){
					if (data==''){ 
						window.location.reload(true);
					}else{
						alert(data);
					}
				}
			});
		});

		$(".btnGuardarMenosStock").on("click",function(event){
			event.preventDefault();
			var accion = 'restar';
			var idProducto = <?php echo $idProducto?>;
			var user = '<?php echo $user?>';
			$.ajax({
				type: "POST",
				url: "../controller/controllerProd.php",
				data: $('#formQuitarStock').serialize() + '&accion=' + accion + '&idProducto=' + idProducto + '&user=' + user,
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

	$(document).ready(function(){
		document.querySelector('.custom-file-input').addEventListener('change',function(e){
			var fileName = document.getElementById("inputGroupFile01").files[0].name;
			var nextSibling = e.target.nextElementSibling
			nextSibling.innerText = fileName
		})
	});
</script>


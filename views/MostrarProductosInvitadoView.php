<!-- VISUALIZACION INICIAL DE EQUIPOS -->
<?php
$Producto = new Productos();
$datosProducto = $Producto->mostrarDatos();
if($datosProducto){
    ?>
    <form id="form-producto" method="get">
        <div class="row d-flex justify-content-center" id="myItems">
            <?php 
            foreach ($datosProducto as $Objeto) { 
                ?>
                <div class="col-md-3">
                    <div class="p-3 bd-highlight">
                        <div class="card text-center">
                          <div class="card-body">
                            <img src="https://quillota.cl/inventario/img/producto.png" class="avatar" alt="Avatar">
                            <h5 class="card-title"><?php echo $Objeto->categoria;?></h5>
                            <p class="card-text"><?php echo $Objeto->nombre;?></p>
                            <p class="card-text">Cantidad: <?php echo $Objeto->stock;?></p>
                            <button type="button" onclick="window.location.href='https://quillota.cl/inventario/views/ModificarProductosInvitadoView.php?ide=<?php echo $Objeto->idProducto;?>'" class="btn btn-warning btnModificarProd"><i class="fas fa-edit"></i> Solicitar</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</form>

<?php } unset($Producto); ?>
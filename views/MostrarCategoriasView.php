<!-- VISUALIZACION DE TABLA CATEGORIA -->
<?php
$Categoria = new Categorias();
$todasCategoria = $Categoria->mostrarCategorias();
if($todasCategoria){
    ?>
    <div class="table-responsive text-center" style="margin-top: 80px; margin-bottom: 40px;"> 
        <table id="tabla-categorias" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th style="display: none;">ID</th>
                    <th>NOMBRE</th>
                    <th>DESCRIPCION</th>
                    <th>ÚLTIMA MODIFICACIÓN</th>
                    <th>ELIMINAR</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach ($todasCategoria as $Objeto) { 
                    ?>
                    <tr>
                        <!-- PROPIEDAD: ID -->
                        <td style="display: none;">
                            <?php echo $Objeto->idCategoria;?> 
                        </td>
                        <!-- PROPIEDAD: FECHA -->
                        <td>
                            <?php echo $Objeto->nombre;?>
                        </td>
                        <!-- PROPIEDAD: HORA -->
                        <td> 
                           <?php echo $Objeto->descripcion;?>
                       </td>
                       <!-- PROPIEDAD: USUARIO -->
                       <td>
                        <?php echo $Objeto->fecha;?>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-danger btnEliminarCategoria" value="<?php echo $Objeto->idCategoria;?>"><i class="fa-regular fa-trash-can"></i></button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>  
<?php } ?>

<script type="text/javascript">
    $(document.body).on('click', '.btnEliminarCategoria', function() {
        var result = confirm("¿Está seguro/a de esta operación?");
        if (result) {
            var accion = 'eliminar';
            var idCategoria = $(this).val();
            $.ajax({
                type    : 'POST',
                url     : '../controller/controllerCat.php',
                data    : {idCategoria:idCategoria, accion:accion},
                success: function(data){
                    if (data!='error'){  
                        alert("Categoría eliminada exitosamente");
                        window.location.reload(true);
                    }
                }
            });
        }
    });
</script>
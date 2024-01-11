<!-- VISUALIZACION DE LOGS -->
<?php
$user = $_POST['user'];
$idProd = $_POST['idProducto'];

require_once "../class/Conexion.php";
include "../class/Producto.php";
$Productos = new Productos();
$logsProductos = $Productos->mostrarLogs($idProd);

if ($logsProductos) {
?>
    <div class="modal-header">
        <h5 class="modal-title"><i class="fa-regular fa-clipboard"></i> HISTORIAL DEL INSUMO: <?php echo $logsProductos[1]->nombre; ?>  </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body">
        <div class="table-responsive">
            <table id="tabla-loginsumo" class="table table-striped text-center">
                <thead>
                    <tr>
                        <th style="display: none;">ID</th>
                        <th>FECHA</th>
                        <th>HORA</th>
                        <th>USUARIO REGISTRADO</th>
                        <th>ACCIÓN</th>
                        <th>DESTINO</th>
                        <th>RESPONSABLE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($logsProductos as $Objeto) {
                    ?>
                        <tr>
                            <!-- PROPIEDAD: ID -->
                            <td style="display: none;">
                                <?php echo $Objeto->idProducto; ?>
                            </td>
                            <!-- PROPIEDAD: FECHA -->
                            <td>
                                <?php echo $Objeto->fecha; ?>
                            </td>
                            <!-- PROPIEDAD: HORA -->
                            <td>
                                <?php echo $Objeto->hora; ?>
                            </td>
                            <!-- PROPIEDAD: USUARIO -->
                            <td>
                                <?php echo $Objeto->usuario; ?>
                            </td>
                            <!-- PROPIEDAD: COMENTARIO -->
                            <td>
                                <?php
                                if (strpos($Objeto->comentario, "Entregó") !== false) {
                                    echo '<p style="color: red;">' . $Objeto->comentario . '</p>';
                                } else {
                                    echo '<p style="color: green;">' . $Objeto->comentario . '</p>';
                                }
                                ?>
                            </td>
                            <!-- PROPIEDAD: OFICINA -->
                            <td>
                                <?php echo $Objeto->destino; ?>
                            </td>
                            <!-- PROPIEDAD: RESPONSABLE -->
                            <td>
                                <?php echo $Objeto->responsable; ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
    </div>
<?php }
unset($Productos); ?>

<!-- <script type="text/javascript">
    $(document).ready(function(){
        var table = $('#tabla-loginsumo').DataTable({
            "bFilter": false,
            "order": [[ 0, "desc", 1, "desc" ]],
            pageLength : 10,
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
    });
</script> -->
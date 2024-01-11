<!-- VISUALIZACION DE LOGS -->
<?php
$idProducto = $_GET['ide'];
$Productos = new Productos();
$logsProductos = $Productos->mostrarLogs($idProducto);
if($logsProductos){
    ?>
    <div class="table-responsive" style="margin-top: 80px; margin-bottom: 40px;"> 
        <table id="tabla-productos" class="table table-bordered table-striped text-center">
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
                            <?php echo $Objeto->idProducto;?> 
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
                        <?php echo $Objeto->usuario;?>
                    </td>
                    <!-- PROPIEDAD: COMENTARIO -->
                    <td>
                        <?php 
                        if(strpos($Objeto->comentario, "Entregó") !== false){
                            echo '<p style="color: red;">'.$Objeto->comentario.'</p>';
                        }else{
                             echo '<p style="color: green;">'.$Objeto->comentario.'</p>';
                        }
                        ?>
                    </td>
                    <!-- PROPIEDAD: OFICINA -->
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
<?php } ?>
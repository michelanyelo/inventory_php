<div class="content-page" style="background-color: #ecf0f5;">
  <div class="content">
    <div class="row justify-content-around align-items-end" style="margin-top: 20px; margin-bottom: 40px;">

      <!-- INICIO TOTAL INSUMOS -->
      <div class="col-3">
        <!-- <h4>Tablero de resumen</h4> -->
        <?php
        $Producto = new Productos();
        $cantInsumos = $Producto->contarInsumos();
        if ($cantInsumos > 0) {
        ?>
          <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0" style="background-color: #3D4856; color: white;">
              <div class="col-md-4" style="text-align: center; align-self: center;">
                <img src="https://quillota.cl/inventario/img/inventory.png" class="img-fluid rounded-start" alt="" style="max-width: 70%;">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">Cantidad total de insumos</h5>
                  <p class="card-text" style="font-size: 24px"><b><?php echo $cantInsumos; ?></b></p>
                </div>
              </div>
            </div>
            <div class="card-footer text-muted">
              <p class="card-text"><small class="text-muted"><a href="https://quillota.cl/inventario/views/MostrarProductosView.php" style="font-size: 15px">Ver todo el inventario</a></small></p>
            </div>
          </div>

        <?php }
        unset($Producto);
        ?>
      </div>
      <!-- FIN TOTAL INSUMOS -->

      <!-- INICIO TOTAL VARIEDAD -->
      <div class="col-3">
        <?php
        $Producto = new Productos();
        $cantVariedad = $Producto->contarVariedadInsumos();
        if ($cantVariedad > 0) {
        ?>
          <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0" style="background-color: #3D4856; color: white;">
              <div class="col-md-4" style="text-align: center; align-self: center;">
                <img src="https://quillota.cl/inventario/img/inventory.png" class="img-fluid rounded-start" alt="" style="max-width: 70%;">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">Variedad de insumos</h5>
                  <p class="card-text" style="font-size: 24px"><b><?php echo $cantVariedad; ?></b></p>
                </div>
              </div>
            </div>
            <div class="card-footer text-muted">
              <p class="card-text"><small class="text-muted"><a href="https://quillota.cl/inventario/views/MostrarProductosView.php" style="font-size: 15px">Ver todo el inventario</a></small></p>
            </div>
          </div>
        <?php }
        unset($Producto);
        ?>
      </div>
      <!-- FIN TOTAL VARIEDAD -->
      <!-- INICIO TOTAL ENTREGAS -->
      <div class="col-3">
        <?php
        $Producto = new Productos();
        $cantPedidos = $Producto->contarEntregas();
        if ($cantPedidos > 0) {
        ?>
          <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0" style="background-color: #3D4856; color: white">
              <div class="col-md-4" style="text-align: center; align-self: center;">
                <img src="https://quillota.cl/inventario/img/inventory.png" class="img-fluid rounded-start" alt="" style="max-width: 70%;">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">Cantidad total de entregas</h5>
                  <p class="card-text" style="font-size: 24px"><b><?php echo $cantPedidos; ?></b></p>
                </div>
              </div>
            </div>
            <div class="card-footer text-muted">
              <p class="card-text"><small class="text-muted"><a href="https://quillota.cl/inventario/views/LibroInventarioView.php" style="font-size: 15px">Revisar historial de entregas</a></small></p>
            </div>
          </div>
        <?php }
        unset($Producto);
        ?>
      </div>
      <!-- FIN TOTAL ENTREGAS -->
    </div>

    <div class="card-deck">
      <div class="card">
        <div class="card-body">
          <?php
          $Productos = new Productos();
          $datos = $Productos->rankingInsumos();
          if ($datos) {
          ?>

            <div class="row" style="align-items: baseline; margin-bottom: 20px;">
              <div class="col-6">
                <h5 class="card-title">INSUMOS MÁS PEDIDOS</h5>
                <!-- AGREGAR NUEVO INSUMO -->
              </div>
              <div class="col-6" style="text-align: end;">
                <button class="btn btn-primary btnNART" type="button" data-toggle="modal" data-target="#agregarNUEVO" style="background-color: #32BDBE; border-color: #32BDBE;">INGRESAR NUEVO INSUMO</button>
              </div>
            </div>
            <!--TABLA RANKING  -->
            <div class="table-responsive text-center" style="margin-top: 5px; margin-bottom: 5px;">
              <table id="tabla-ranking" class="table table-striped">
                <thead>
                  <tr>
                    <th>INSUMO</th>
                    <th>HISTORIAL</th>
                    <th>STOCK ACTUAL</th>
                    <th>AGREGAR/QUITAR</th>
                  </tr>
                </thead>
                <form id="form-producto">
                  <tbody>
                    <?php foreach ($datos as $objeto) {
                    ?>
                      <tr>
                        <td>
                          <button type="button" class="btn btn-link btnHISTO" style="font-size: 13px;" data-toggle="modal" data-target="#histoStock" value="<?php echo $objeto->idProducto; ?>" <?php $LOGS = new Productos();
                                                                                                                                                                                                $logsProductos = $LOGS->mostrarLogs($objeto->idProducto);
                                                                                                                                                                                                if (is_null($logsProductos)) {
                                                                                                                                                                                                ?> disabled <?php }
                                                                                                                                                                                                          unset($LOGS); ?>><?php echo $objeto->nombre; ?> </button>
                        </td>
                        <td>
                          <?php echo $objeto->CANT; ?>
                        </td>
                        <td>
                          <?php echo $objeto->stock; ?>
                        </td>
                        <td>
                          <button type="button" class="btn btn-primary btn-circleagrega btnASTOCK" data-toggle="modal" data-target="#agregarStock" value="<?php echo $objeto->idProducto; ?>"><i class="fa-solid fa-plus"></i></button>
                          <button type="button" class="btn btn-primary btn-circlequita btnQSTOCK" data-toggle="modal" data-target="#quitarStock" value="<?php echo $objeto->idProducto; ?>" <?php if ($objeto->stock <= '0') { ?> disabled <?php   } ?>><i class="fa-solid fa-minus"></i></button>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </form>
              </table>
            </div>
          <?php  }
          unset($Productos); ?>
          <p class="card-text"><small class="text-muted">Última actualización: <?php $date = new DateTime("now", new DateTimeZone('America/Santiago'));
                                                                                echo $date->format('Y/m/d H:i:s'); ?> </small></p>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <?php
          $Productos = new Productos();
          $datos = $Productos->ultimosingresosInsumos();
          if ($datos) {
          ?>
            <div class="row" style="align-items: baseline; margin-bottom: 20px;">
              <div class="col-6">
                <h5 class="card-title">ÚLTIMOS INSUMOS INGRESADOS</h5>
                <!-- AGREGAR NUEVO INSUMO -->
              </div>
              <div class="col-6" style="text-align: end;">
                <button class="btn btn-primary btnNART" type="button" data-toggle="modal" data-target="#agregarNUEVO" style="background-color: #32BDBE; border-color: #32BDBE;">INGRESAR NUEVO INSUMO</button>
              </div>
            </div>
            <!--TABLA RANKING  -->
            <div class="table-responsive text-center" style="margin-top: 5px; margin-bottom: 5px;">
              <table id="tabla-ranking" class="table table-striped">
                <thead>
                  <tr>
                    <th>INSUMO</th>
                    <th>FECHA</th>
                    <th>STOCK ACTUAL</th>
                    <th>AGREGAR/QUITAR</th>
                  </tr>
                </thead>
                <form id="form-producto" method="get">
                  <tbody>
                    <?php foreach ($datos as $objeto) {
                    ?>
                      <tr>
                        <td>
                          <button type="button" class="btn btn-link btnHISTO" style="font-size: 13px;" data-toggle="modal" data-target="#histoStock" value="<?php echo $objeto->idProducto; ?>" <?php $LOGS = new Productos();
                                                                                                                                                                                                $logsProductos = $LOGS->mostrarLogs($objeto->idProducto);
                                                                                                                                                                                                if (is_null($logsProductos)) {
                                                                                                                                                                                                ?> disabled <?php }
                                                                                                                                                                                                          unset($LOGS); ?>><?php echo $objeto->nombre; ?></button>
                        </td>
                        <td>
                          <?php echo $objeto->fecha; ?>
                        </td>
                        <td>
                          <?php echo $objeto->stock; ?>
                        </td>
                        <td>
                          <button type="button" class="btn btn-primary btn-circleagrega btnASTOCK" data-toggle="modal" data-target="#agregarStock" value="<?php echo $objeto->idProducto; ?>"><i class="fa-solid fa-plus"></i></button>
                          <button type="button" class="btn btn-primary btn-circlequita btnQSTOCK" data-toggle="modal" data-target="#quitarStock" value="<?php echo $objeto->idProducto; ?> <?php if ($objeto->stock <= '0') { ?> disabled <?php   } ?>"><i class="fa-solid fa-minus"></i></button>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </form>
              </table>
            </div>
            <p class="card-text"><small class="text-muted">Última actualización: <?php $date = new DateTime("now", new DateTimeZone('America/Santiago'));
                                                                                  echo $date->format('Y/m/d H:i:s'); ?> </small></p>

            <!-- -------------------------------------------->
            <!-- MODAL AGREGAR -->

            <div class="modal fade" id="agregarStock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content" id="contentMyModal">
                </div>
              </div>
            </div>

            <!-- MODAL QUITAR -->
            <div class="modal fade" id="quitarStock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content" id="contentQuitar">
                </div>
              </div>
            </div>

            <!-- MODAL NUEVO -->
            <div class="modal fade" id="agregarNUEVO" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content" id="contentNUEVO">
                </div>
              </div>
            </div>

            <!-- MODAL HISTORIAL -->
            <div class="modal fade" id="histoStock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4" aria-hidden="true">
              <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content" id="contentHisto">
                </div>
              </div>
            </div>

          <?php  }
          unset($Productos); ?>
        </div>
      </div>
    </div>
  </div>
</div>
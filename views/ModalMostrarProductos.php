<?php
$user = $_POST['user'];
$idProd = $_POST['idProducto'];
$act = $_POST['act'];
require_once "../class/Conexion.php";
include "../class/Producto.php";
$Producto_lista = new Productos();
$data = $Producto_lista->mostrarProdId($idProd);

foreach ($data as $objeto) {

  if ($act == 'agregar') {
?>

    <form id="formAgregarStock" method="POST">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fa-solid fa-plus" id="exampleModalLabel"></i> Agregar Stock </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">Producto</span>
          </div>
          <input type="text" class="form-control" name="nomProducto" value="<?= $objeto->nombre; ?>" disabled>
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">Cantidad</span>
          </div>
          <input type="text" class="form-control" name="stockProducto" value="">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary btnGuardarMasStock" value="<?php echo $idProd; ?>">Guardar</button>
      </div>
    </form>

    <?php } else {
    $cantidad = $objeto->stock;
    if ($cantidad > 0) {
    ?>
      <form id="formQuitarStock" method="POST">
        <div class="modal-header">
          <h5 class="modal-title"><i class="far fa-edit" id="exampleModalLabel2"></i> Entregar Insumo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Producto</span>
            </div>
            <input type="text" class="form-control" name="nomProducto" value="<?= $objeto->nombre; ?>" disabled>
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Cantidad</span>
            </div>
            <input type="text" class="form-control" name="stockProductoQuitar" value="">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <label class="input-group-text">Oficina</label>
            </div>
            <select class="custom-select form-control" name="selOficina" onchange="document.getElementById('seloficina_text').value=this.options[this.selectedIndex].text">
              <option selected disabled>Seleccione:</option>
              <?php
              $Producto_ofi = new Productos();
              $oficina_prod = $Producto_ofi->mostrarOficinas();
              if ($oficina_prod) {
                foreach ($oficina_prod as $objeto_ofi) { ?>
                  <option value="<?= $objeto_ofi->idOficina ?>"><?= strtoupper($objeto_ofi->Nombre) ?></option>
              <?php }
              }
              unset($Producto_ofi); ?>
            </select>
            <input type="hidden" name="seloficina_text" id="seloficina_text" value="<?= $objeto_ofi->Nombre; ?>">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">Responsable</span>
            </div>
            <input type="text" class="form-control" name="responsable_text" value="">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary btnGuardarMenosStock" value="<?php echo $idProd; ?>">Guardar</button>
          </div>
        </div>
      </form>

<?php }
  }
}
unset($Producto_lista); ?>

<script type="text/javascript">
  $(document).ready(function() {
    $(".btnGuardarMasStock").on("click", function(event) {
      event.preventDefault();
      var agrega_modal;
      var accion = 'sumar';
      var idProducto = $(this).val();
      var user = '<?php echo $user ?>';
      $.ajax({
        type: "POST",
        url: "../controller/controllerProd.php",
        data: $('#formAgregarStock').serialize() + '&accion=' + accion + '&idProducto=' + idProducto + '&user=' + user,
        success: function(data) {
          if (data != '') {
            var antCantidad = '<?php echo $objeto->stock; ?>';
            var totalCantidad = parseFloat(antCantidad) + parseFloat(data);
            $('#cantidadProd_' + idProducto).html("Cantidad: " + totalCantidad);
            $('#agregarStock').modal('hide');
          }
        }
      });
    });


    $(".btnGuardarMenosStock").on("click", function(event) {
      event.preventDefault();
      var accion = 'restar';
      var idProducto = $(this).val();
      var user = '<?php echo $user ?>';
      $.ajax({
        type: "POST",
        url: "../controller/controllerProd.php",
        data: $('#formQuitarStock').serialize() + '&accion=' + accion + '&idProducto=' + idProducto + '&user=' + user,
        success: function(data) {
          if (data != '') {
            var antCantidad = '<?php echo $objeto->stock; ?>';
            var totalCantidad = parseFloat(antCantidad) - parseFloat(data);
            $('#cantidadProd_' + idProducto).html("Cantidad: " + totalCantidad);
            $('#quitarStock').modal('hide');

          }
        }
      });
    });
  });
</script>
<?php 
$user = $_POST['user'];
$act = $_POST['act'];
require_once "../class/Conexion.php"; 
include "../class/Categoria.php";
?>

<form id="formNuevoProducto">
  <div class="modal-header">
    <h5 class="modal-title"><i class="fa-solid fa-plus" id="exampleModalLabel3"></i> Agregar nuevo insumo </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-default">Insumo</span>
      </div>
      <input type="text" class="form-control" name ="nomProducto">
    </div>

    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <label class="input-group-text" for="inputGroupSelect01">Categoría</label>
      </div>
      <select class="custom-select form-control" name="CategoriaProd" onchange="document.getElementById('categoriaprod_text').value=this.options[this.selectedIndex].text">
        <option value="0" selected disabled>Elegir...</option>
        <?php 
        $Categoria = new Categorias();
        $categoria_prod = $Categoria->mostrarCategorias();
        if($categoria_prod){  
          foreach($categoria_prod as $objeto_nuevo){?>
            <option value="<?=$objeto_nuevo->idCategoria?>"><?=$objeto_nuevo->nombre?></option>
          <?php }
        }?>
      </select>
      <input type="hidden" name="categoriaprod_text" id="categoriaprod_text" value="">
    </div>

    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-default">Cantidad</span>
      </div>
      <input type="text" class="form-control" name ="stockProducto">
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
    <button type="submit" class="btn btn-primary btnGuardarNuevo">Guardar</button>
  </div>
</form>

<script type="text/javascript">
  $(document).ready(function(){
    $(".btnGuardarNuevo").on("click",function(event){
      event.preventDefault();
      var user = '<?php echo $user?>';
      $.ajax({
        type: "POST",
        url: "controller/controllerProd.php",
        data: $('#formNuevoProducto').serialize() + '&user=' + user,
        success: function(data){
          if (data==''){ 
            window.location.reload(true);
          }else{
            window.location.reload(true);
          }
        }
      });
    });
  });
</script>
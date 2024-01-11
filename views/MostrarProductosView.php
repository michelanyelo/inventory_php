<!-- VISUALIZACION TODO EL INVENTARIO -->


<!DOCTYPE html>
<html lang="es">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php require_once "../header.php";
  session_start();
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
    <div class="container" style="margin-top:80px; margin-bottom: 40px;">
      <div class="input-group rounded" style="background-color: #3D4856 !important; padding: 2px;">
        <input type="search" class="form-control rounded" id="myFilter" onkeyup="myFunction()" placeholder="Nombre del producto" aria-label="Search" aria-describedby="search-addon" />
        <span class="input-group-text border-0" id="search-addon">
         <i class="fa-solid fa-magnifying-glass"></i>
       </span>
     </div>
   </div>


   <div class="container" id="MyCards">
    <?php
    include '../class/Conexion.php';
    include '../class/Categoria.php';
    include '../class/Producto.php';
    $Listado_Productos = new Productos();
    $datosProducto = $Listado_Productos->mostrarDatos();
    if($datosProducto){
      ?>
      <form id="form-producto" method="post">
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
                    <p class="card-text" id="cantidadProd_<?php echo $Objeto->idProducto; ?>">Cantidad: <?php echo $Objeto->stock;?></p>
                    <button type="button" class="btn btn-primary btn-circleagrega btnASTOCK" data-toggle="modal" data-target="#agregarStock" value="<?php echo $Objeto->idProducto;?>"><i class="fa-solid fa-plus"></i></button>
                    <button type="button" class="btn btn-primary btn-circlequita btnQSTOCK" data-toggle="modal" data-target="#quitarStock" value="<?php echo $Objeto->idProducto;?>" <?php if ($Objeto->stock <= '0'){ ?> disabled <?php   } ?>><i class="fa-solid fa-minus"></i></button>
                    </div>
                    <div class="card-footer">
                      <button type="button" class="btn btn-link btnHISTO" data-toggle="modal" data-target="#histoStock" value="<?php echo $Objeto->idProducto;?>" <?php 
                      $LOGS = new Productos();
                      $logsProductos = $LOGS->mostrarLogs($Objeto->idProducto); 
                      if (is_null($logsProductos)){ 
                        ?> 
                        disabled 
                      <?php } unset($LOGS); ?> 
                      >HISTORIAL</button>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        </form>

        <!-- -------------------------------------------->
        <!-- MODAL AGREGAR -->

        <div class="modal fade" id="agregarStock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content" id="contentAgregar">
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

        <!-- MODAL HISTORIAL -->
        <div class="modal fade" id="histoStock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4" aria-hidden="true">
          <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content" id="contentHisto">
            </div>
          </div>
        </div>

      <?php } unset($Listado_Productos); ?>
    </div>
    <!-- FIN CONTENIDO -->
  </div>
</body>
</html>

<script type="text/javascript">
  function myFunction() {
    var input, filter, cards, cardContainer, h5, title, i;
    input = document.getElementById("myFilter");
    filter = input.value.toUpperCase();
    cardContainer = document.getElementById("myItems");
    cards = cardContainer.getElementsByClassName("card");
    col = cardContainer.getElementsByClassName("col-md-3");
    for (i = 0; i < cards.length; i++){
      if( $('#myFilter').val().length > -1 ) {
        title = cards[i].querySelector(".card-text");
        categori = cards[i].querySelector(".card-title");
        if (title.innerText.toUpperCase().indexOf(filter) > -1) {
          cards[i].style.display = "";
          col[i].style.display = "";
        }else if (categori.innerText.toUpperCase().indexOf(filter) > -1){ 
         cards[i].style.display = "";
         col[i].style.display = "";
       }else {
        cards[i].style.display = "none";
        col[i].style.display = "none";
      }
    }else{
      cardContainer[i].style.display = "";
    }
  }
}

$(document).ready(function(){
  $(document.body).on('click', '.btnASTOCK', function() {
    var idProducto = $(this).val();
    var act = 'agregar';
    var user = '<?php echo $_SESSION['usuario']?>';
    $("#contentAgregar").load("ModalMostrarProductos.php",{idProducto:idProducto, act:act, user:user});
  });
});

$(document).ready(function(){
  $(document.body).on('click', '.btnQSTOCK', function() {
    var idProducto = $(this).val();
    var act = 'quitar';
    var user = '<?php echo $_SESSION['usuario']?>';
    $("#contentQuitar").load("ModalMostrarProductos.php",{idProducto:idProducto, act:act, user:user});
  });
});

$(document).ready(function(){
  $(document.body).on('click', '.btnHISTO', function() {
    var idProducto = $(this).val();
    var user = '<?php echo $_SESSION['usuario']?>';
    $("#contentHisto").load("ModalHistorialProductos.php",{idProducto:idProducto, user:user});
  });
});
</script>
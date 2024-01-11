<?php 
include 'class/Conexion.php'; 
include 'class/Producto.php';
include 'class/Categoria.php';
@session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php require_once "header.php";?>
  <title>Inventario Municipal</title>
</head>
<body>
  <div class="container-fluid"> 
   <nav class="navbar navbar-dark bg-dark" style="margin-top:5px;float: none;text-align: center;">
    <div class="container-fluid">
      <div style="color:white;margin-bottom:20px;margin-top:20px;font-size:30px;">
        <img src="img/logo-qta.png" width="140" height="55">
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
<!--         <li class="nav-item">
          <a class="nav-link" href="https://quillota.cl/inventario/views/AgregarCategoriasView.php">Categorias</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://quillota.cl/inventario/views/ReporteDocsView.php">Documentación</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://quillota.cl/inventario/views/LibroInventarioView.php">Libro Inventario</a>
        </li> -->
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
      <h4><i class="fas fa-search"></i> Busque y seleccione el insumo requerido</h4>
    </div>
  </div>

  <div class="row" style="margin-bottom: 40px;">
    <div class="col-6">
      <div class="input-group rounded">
        <input type="search" class="form-control rounded" id="myFilter" onkeyup="myFunction()" placeholder="Nombre del producto" aria-label="Search"
        aria-describedby="search-addon" />
        <span class="input-group-text border-0" id="search-addon">
          <i class="fas fa-search"></i>
        </span>
      </div>
    </div>
  </div>

  <div class="container" id="MyCards">
    <?php include "views/MostrarProductosInvitadoView.php";?>
  </div>
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
    for (i = 0; i < cards.length; i++) {
      if( $('#myFilter').val().length > -1 ) {
        title = cards[i].querySelector(".card-text");
        if (title.innerText.toUpperCase().indexOf(filter) > -1) {
          cards[i].style.display = "";
          col[i].style.display = "";
        } else {
          cards[i].style.display = "none";
          col[i].style.display = "none";
        }
      }else{
        cardContainer[i].style.display = "";
      }
    }
  }

  document.addEventListener("DOMContentLoaded", function(){
    const milisegundos = 300 *1000;
    setInterval(function(){
      fetch("refrescar.php");
    },milisegundos);
  });
</script>


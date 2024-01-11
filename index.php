<?php
// session_start();
include 'class/Conexion.php';
include 'class/Producto.php';
include 'class/Categoria.php';
if (!isset($_SESSION['usuario'])) {
  header("Location:login.php");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php require_once "header.php"; ?>

  <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css">
  <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style">
  <title>Inventario Municipal</title>
</head>

<body>
  <div class="wrapper">
    <!-- INICIO SIDEBAR -->
    <?php include('sidebar.php') ?>
    <!-- FIN SIDEBAR -->

    <!-- INICIO CONTENIDO-->
    <?php include('views/MostrarResumenProductos.php') ?>
    <!-- FIN CONTENIDO -->
  </div>
</body>

</html>


<script type="text/javascript">
  $(document).ready(function() {
    $(document.body).on('click', '.btnASTOCK', function() {
      var idProducto = $(this).val();
      var act = 'agregar';
      var user = '<?php echo $_SESSION['usuario'] ?>';
      $("#contentMyModal").load("views/ModalAgregar.php", {
        idProducto: idProducto,
        act: act,
        user: user
      });
    });
  });

  $(document).ready(function() {
    $(document.body).on('click', '.btnQSTOCK', function() {
      var idProducto = $(this).val();
      var act = 'quitar';
      var user = '<?php echo $_SESSION['usuario'] ?>';
      $("#contentQuitar").load("views/ModalAgregar.php", {
        idProducto: idProducto,
        act: act,
        user: user
      });
    });
  });

  $(document).ready(function() {
    $(document.body).on('click', '.btnNART', function() {
      var act = 'nuevor';
      var user = '<?php echo $_SESSION['usuario'] ?>';
      $("#contentNUEVO").load("views/ModalNuevoProducto.php", {
        act: act,
        user: user
      });
    });
  });

  $(document).ready(function() {
    $(document.body).on('click', '.btnHISTO', function() {
      var idProducto = $(this).val();
      var user = '<?php echo $_SESSION['usuario'] ?>';
      $("#contentHisto").load("views/ModalHistorialProductos.php", {
        idProducto: idProducto,
        user: user
      });
    });
  });
</script>
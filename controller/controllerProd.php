<?php
require_once("../class/Conexion.php");
include_once("../class/Producto.php");

if (isset($_POST['nomProducto']) && isset($_POST['categoriaprod_text']) && isset($_POST['stockProducto']) && !isset($_POST['accion'])) {

    $Producto = new Productos();

    $user = $_POST['user'];

    $nom_producto = $_POST['nomProducto'];
    $Producto->setNomproducto($nom_producto);

    $categoria_producto = $_POST['categoriaprod_text'];
    $Producto->setCatproducto($categoria_producto);

    $stock_producto = $_POST['stockProducto'];
    $Producto->setCantproducto($stock_producto);

    $Producto->GrabarProducto($user);
    unset($Producto);
} else if (isset($_POST['idProducto']) && ($_POST['accion'] == 'modificar')) {
    $Producto = new Productos();

    $nom_producto = $_POST['nomProducto'];
    $Producto->setNomproducto($nom_producto);

    $categoria_producto = $_POST['categoriaprod_text'];
    $Producto->setCatproducto($categoria_producto);

    $id_producto = $_POST['idProducto'];
    $Producto->ModificarProducto($id_producto);
    unset($Producto);
} else if (isset($_POST['idProducto']) && $_POST['accion'] == 'eliminar') {
    $Producto = new Productos();

    $id_Producto = $_POST['idProducto'];
    $Producto->eliminarProducto($id_Producto);
    unset($Producto);
} else if (isset($_POST['idProducto']) && isset($_POST['stockProducto']) && ($_POST['accion'] == 'sumar')) {
    $Producto = new Productos();

    $stock_producto = $_POST['stockProducto'];
    $Producto->setCantproducto($stock_producto);
    $id_producto = $_POST['idProducto'];
    $user = $_POST['user'];
    $Producto->ModificarMasStock($id_producto, $user);
    unset($Producto);
    echo($stock_producto);
} else if (isset($_POST['idProducto']) && isset($_POST['stockProductoQuitar']) && isset($_POST['seloficina_text']) && isset($_POST['responsable_text']) && ($_POST['accion'] == 'restar')) {
    $Producto = new Productos();

    $stock_producto = $_POST['stockProductoQuitar'];
    $Producto->setCantproducto($stock_producto);

    $id_producto = $_POST['idProducto'];
    $user = $_POST['user'];
    $destino = $_POST['seloficina_text'];
    $responsable = $_POST['responsable_text'];
    $Producto->setOficina($destino);
    $Producto->ModificarMenosStock($id_producto, $user, $responsable);
    unset($Producto);
    echo($stock_producto);
    // }else if (isset($_POST['upload'])){
    //     $Producto = new Productos();
    //     $archivo = $_FILES['file'];
    //     print_r($archivo);
    //     exit();



    // $id_producto = $_POST['idProducto'];
    // // $nom_archive = $_POST['fileName'];
    // $pname = rand(1000, 10000)."-".$_FILES["inputFile"]["name"];
    // $Producto->setArchivo($pname);
    // $tname = $_FILES["inputFile"]["tmp_name"];
    // $uploads_dir = '../documentos/';
    // move_uploaded_file($tname, $uploads_dir.'/'.$pname);
    // $Producto->ModificarArchivoProducto($id_producto);
    // unset($Producto);  
} else {
    echo "ERROR";
}

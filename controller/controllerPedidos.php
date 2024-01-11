<?php
require_once("../class/Conexion.php");
include_once("../class/Pedidos.php");


if (isset($_POST['nomFuncionario']) && isset($_POST['correoFuncionario']) && isset($_POST['ofiFuncionario']) && isset($_POST['stockFuncionario'])){
    $Pedido = new Pedidos();

    $nombre = $_POST['nomFuncionario'];
    $Pedido->setNombre($nombre);

    $correo = $_POST['correoFuncionario'];
    $Pedido->setCorreo($correo);

    $oficina = $_POST['ofiFuncionario'];
    $Pedido->setOficina($oficina);

    $cantidad = $_POST['stockFuncionario'];

    $nomproducto = $_POST['nomProductos'];

    $idproducto = $_POST['idProducto'];

    $Pedido->GrabarPedido($cantidad, $nomproducto, $idproducto);
    unset($Pedido);
}else if ($_POST['accion'] == 'modificar'){
    $estado = $_POST['estado'];
    $Pedido = new Pedidos();

    $idPedido = $_POST['idPedido'];

    $Pedido->setEstado($estado);

    $Pedido->cambiarEstado($idPedido);
    unset($Pedido); 
}else{
    echo "ERROR!"; 
}

?>
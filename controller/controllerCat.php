<?php
require_once("../class/Conexion.php");
include_once("../class/Categoria.php");

if(isset($_POST['nomCategoria']) && isset($_POST['descCategoria'])){
	$Categoria = new Categorias();

	$nom_categoria = $_POST['nomCategoria'];
	$Categoria->setNomcategoria($nom_categoria);

	$desc_categoria = $_POST['descCategoria'];
	$Categoria->setDesccategoria($desc_categoria);

	$Categoria->GrabarCategoria();
	unset($Categoria);
}else if ($_POST['accion'] =='eliminar'){ 
	$id_categoria = $_POST['idCategoria'];
	$Categoria = new Categorias;
	$Categoria->eliminarCategoria($id_categoria);
	unset($Categoria);
}else {
	echo "ERROR!"; 
}

?>
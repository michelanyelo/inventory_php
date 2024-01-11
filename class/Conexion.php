<?php 
session_start();
$servername = "localhost";
$username = "quillota_inventario";
$password = "invent2021";
$dbname = "quillota_inventario";


// Crear conexion
$conn = new mysqli($servername, $username, $password, $dbname);
// Comprobar conexion
if ($conn->connect_error) {
	die("Conexión fallida: " . $conn->connect_error);
} 
mysqli_set_charset($conn, 'utf8');
?>

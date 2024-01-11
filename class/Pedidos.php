<?php
class Pedidos {
    public $nombre;
    public $correo;
    public $oficina;
    public $estado;

    public function __construct() {
        $this->nombre = '';
        $this->correo = '';
        $this->oficina = '';
        $this->estado = '';
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setCorreo($correo) {
        $this->correo = $correo;
    }

    public function getCorreo() {
        return $this->correo;
    }

    public function setOficina($oficina) {
        $this->oficina = $oficina;
    }

    public function getOficina() {
        return $this->oficina;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function GrabarPedido($cantidad, $nomproducto, $idproducto) {
        $nombre = $this->getNombre();
        $correo = $this->getCorreo();
        $oficina = $this->getOficina();
        global $conn;
        try {
            date_default_timezone_set("America/Santiago");
            $sql = "INSERT INTO solicitudes_inv (fecha, hora, nombre, correo, oficina, cantidad, producto, idProducto) VALUES ('" . date('Y-m-d') . "', '" . date('H:i:s') . "', '" . $nombre . "', '" . $correo . "', '" . $oficina . "', '" . $cantidad . "', '" .strtoupper($nomproducto) . "', '" . $idproducto . "' )";
                $conn->query($sql);
            }
            catch(Exception $e) {
                echo "Error" . $e->getMessage() . "<br>";
            }
        }   

        public function mostrarSolicitudes() {
            global $conn;
            try {
                $sql = "SELECT * FROM solicitudes_inv ORDER BY fecha ASC";
                $resultado = $conn->query($sql);
                if ($resultado->num_rows > 0) {
                    $objetos = new arrayobject();
                    while ($fila = $resultado->fetch_object()) {
                        $objetos[] = $fila;
                    }
                    return $objetos;
                }
            }
            catch(Exception $e) {
                echo "Error" . $e->getMessage() . "<br>";
            }
        }

        public function cambiarEstado($idPedido){
            $estado = $this->getEstado();
            global $conn;
            if ($estado == "true"){
                try {
                    $sql = "UPDATE solicitudes_inv SET estado = '1' WHERE idPedido = '$idPedido'";
                    $conn->query($sql);
                }
                catch(Exception $e) {
                    echo "Error" . $e->getMessage() . "<br>";
                }
            }else{
                try {
                    $sql_2 = "UPDATE solicitudes_inv SET estado = '0' WHERE idPedido = '$idPedido'";
                    $conn->query($sql_2);
                }
                catch(Exception $e) {
                    echo "Error" . $e->getMessage() . "<br>";
                }
            }
        }
    }
    ?>

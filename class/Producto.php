<?php

class Productos
{

    public $idproducto;
    public $nomproducto;
    public $catproducto;
    public $cantproducto;
    public $archivo;
    public $oficina;



    public function __construct()
    {
        $this->idproducto = '';
        $this->nomproducto = '';
        $this->catproducto = '';
        $this->cantproducto = '';
        $this->archivo = '';
        $this->oficina = '';
    }



    public function setIdproducto($idproducto)
    {
        $this->idproducto = $idproducto;
    }



    public function getIdproducto()
    {
        return $this->idproducto;
    }



    public function setNomproducto($nomproducto)
    {
        $this->nomproducto = $nomproducto;
    }



    public function getNomproducto()
    {
        return $this->nomproducto;
    }



    public function setCatproducto($catproducto)
    {
        $this->catproducto = $catproducto;
    }



    public function getCatproducto()
    {
        return $this->catproducto;
    }



    public function setCantproducto($cantproducto)
    {
        $this->cantproducto = $cantproducto;
    }



    public function getCantproducto()
    {
        return $this->cantproducto;
    }



    public function setArchivo($archivo)
    {
        $this->archivo = $archivo;
    }



    public function getArchivo()
    {
        return $this->archivo;
    }



    public function setOficina($oficina)
    {
        $this->oficina = $oficina;
    }



    public function getOficina()
    {
        return $this->oficina;
    }




    public function mostrarDatos()
    {
        global $conn;
        try {
            $sql = "SELECT * FROM producto_inv ORDER BY nombre ASC";
            $resultado = $conn->query($sql);
            if ($resultado->num_rows > 0) {
                $objetos = new arrayobject();
                while ($fila = $resultado->fetch_object()) {
                    $objetos[] = $fila;
                }
                return $objetos;
            }
        } catch (Exception $e) {
            echo "Error" . $e->getMessage() . "<br>";
        }
    }

    public function contarInsumos()
    {
        global $conn;
        try {
            $sql = "SELECT SUM(stock) FROM producto_inv";
            $resultado = $conn->query($sql);
            while ($row = $resultado->fetch_assoc()) {
                $cantidad_insumos = $row["SUM(stock)"];
                return $cantidad_insumos;
            }
        } catch (Exception $e) {
            echo "Error" . $e->getMessage() . "<br>";
        }
    }

    public function contarVariedadInsumos()
    {
        global $conn;
        try {
            $sql = "SELECT COUNT(DISTINCT nombre) FROM producto_inv";
            $resultado = $conn->query($sql);
            while ($row = $resultado->fetch_assoc()) {
                $variedad_insumos = $row["COUNT(DISTINCT nombre)"];
                return $variedad_insumos;
            }
        } catch (Exception $e) {
            echo "Error" . $e->getMessage() . "<br>";
        }
    }

    public function contarEntregas()
    {
        global $conn;
        try {
            $sql = "SELECT COUNT(idLog) FROM log_inv";
            $resultado = $conn->query($sql);
            while ($row = $resultado->fetch_assoc()) {
                $variedad_log = $row["COUNT(idLog)"];
                return $variedad_log;
            }
        } catch (Exception $e) {
            echo "Error" . $e->getMessage() . "<br>";
        }
    }

    public function rankingInsumos()
    {
        global $conn;
        try {
            $sql = "SELECT PR.idProducto, PR.nombre, SUM(LG.cantidad) as CANT, PR.stock FROM log_inv LG JOIN producto_inv PR ON LG.idProducto = PR.idProducto WHERE LG.accion = 'E' GROUP BY LG.idProducto ORDER BY SUM(LG.cantidad) DESC LIMIT 6";
            $resultado = $conn->query($sql);
            if ($resultado->num_rows > 0) {
                $objetos = new arrayobject();
                while ($fila = $resultado->fetch_object()) {
                    $objetos[] = $fila;
                }
                return $objetos;
            }
        } catch (Exception $e) {
            echo "Error" . $e->getMessage() . "<br>";
        }
    }

    public function ultimosingresosInsumos()
    {
        global $conn;
        try {
            $sql = "SELECT PR.idProducto, PR.nombre, LG.cantidad, LG.fecha, PR.stock FROM log_inv LG JOIN producto_inv PR ON LG.idProducto = PR.idProducto WHERE LG.accion = 'I' ORDER BY LG.fecha DESC LIMIT 6";
            $resultado = $conn->query($sql);
            if ($resultado->num_rows > 0) {
                $objetos = new arrayobject();
                while ($fila = $resultado->fetch_object()) {
                    $objetos[] = $fila;
                }
                return $objetos;
            }
        } catch (Exception $e) {
            echo "Error" . $e->getMessage() . "<br>";
        }
    }


    public function mostrarCategorias()
    {
        global $conn;
        try {
            $sql = "SELECT * FROM categoria_inv ORDER BY idCategoria ASC";
            $resultado = $conn->query($sql);
            if ($resultado->num_rows > 0) {
                $objetos = new arrayobject();
                while ($fila = $resultado->fetch_object()) {
                    $objetos[] = $fila;
                }
                return $objetos;
            }
        } catch (Exception $e) {
            echo "Error" . $e->getMessage() . "<br>";
        }
    }



    public function mostrarOficinas()
    {

        global $conn;

        try {

            $sql = "SELECT * FROM oficinas_muni ORDER BY Nombre ASC";

            $resultado = $conn->query($sql);

            if ($resultado->num_rows > 0) {

                $objetos = new arrayobject();

                while ($fila = $resultado->fetch_object()) {

                    $objetos[] = $fila;
                }

                return ($objetos);
            }
        } catch (Exception $e) {

            echo "Error" . $e->getMessage() . "<br>";
        }
    }



    public function GrabarProducto($user)
    {

        $nom_producto = $this->getNomproducto();
        $cat_producto = $this->getCatproducto();
        $cant_producto = $this->getCantproducto();
        global $conn;
        try {
            $sql = "INSERT INTO producto_inv (nombre, categoria, stock) VALUES ('" . strtoupper($nom_producto) . "', '" . $cat_producto . "', '" . $cant_producto . "')";
            $conn->query($sql);
        } catch (Exception $e) {
            echo "Error" . $e->getMessage() . "<br>";
        }

        try {
            $sql_2 = "SELECT idProducto FROM producto_inv WHERE nombre = '$nom_producto'";

            $resultado = $conn->query($sql_2);

            $array = $resultado->fetch_assoc();

            $id_producto = $array['idProducto'];
        } catch (Exception $e) {

            echo "Error" . $e->getMessage() . "<br>";
        }

        $comentario = ' Ingresó ' . $cant_producto . ' producto(s) al inventario ';
        $accion = 'I';
        $cantidad = $this->getCantproducto();
        try {
            date_default_timezone_set("America/Santiago");
            $sql_3 = "INSERT INTO log_inv (idProducto, fecha, hora, usuario, comentario, accion, cantidad) VALUES ('" . $id_producto . "', '" . date('Y-m-d') . "', '" . date('H:i:s') . "', '" . strtoupper($user) . "', '" . $comentario . "', '" . $accion . "', '" . $cantidad . "')";

            $conn->query($sql_3);
        } catch (Exception $e) {
            echo "Error" . $e->getMessage() . "<br>";
        }
    }


    public function mostrarProdId($id_producto)
    {

        global $conn;

        try {

            $sql = "SELECT * FROM producto_inv WHERE idProducto = '$id_producto'";

            $resultado = $conn->query($sql);

            if ($resultado->num_rows > 0) {

                $objetos = new arrayobject();

                while ($fila = $resultado->fetch_object()) {

                    $objetos[] = $fila;
                }
            }

            return $objetos;
        } catch (Exception $e) {

            echo "Error" . $e->getMessage() . "<br>";
        }
    }



    public function ModificarProducto($id_producto)
    {

        $nom_producto = strtoupper($this->getNomproducto());

        $cat_producto = $this->getCatproducto();

        global $conn;

        try {

            $sql = "UPDATE producto_inv SET nombre = '$nom_producto', categoria = '$cat_producto' WHERE idProducto = '$id_producto'";

            $conn->query($sql);
        } catch (Exception $e) {

            echo "Error" . $e->getMessage() . "<br>";
        }
    }



    public function ModificarMasStock($id_producto, $user)
    {

        global $conn;

        $sql_0 = "SELECT stock FROM producto_inv WHERE idProducto = '$id_producto'";

        $resultado = $conn->query($sql_0);

        $cantidad_bd = $resultado->fetch_object();

        $cant_final = $cantidad_bd->stock + $this->getCantproducto();

        try {

            $sql_1 = "UPDATE producto_inv SET stock = '$cant_final' WHERE idProducto = '$id_producto'";

            $conn->query($sql_1);
        } catch (Exception $e) {

            echo "Error" . $e->getMessage() . "<br>";
        }



        try {

            date_default_timezone_set("America/Santiago");

            $comentario = ' Ingresó ' . $this->getCantproducto() . ' producto(s) al inventario ';
            $accion = 'I';
            $cantidad = $this->getCantproducto();

            $sql_2 = "INSERT INTO log_inv (idProducto, fecha, hora, usuario, comentario, accion, cantidad) VALUES ('" . $id_producto . "', '" . date('Y-m-d') . "', '" . date('H:i:s') . "', '" . strtoupper($user) . "', '" . $comentario . "', '" . $accion . "', '" . $cantidad . "')";

            $conn->query($sql_2);
        } catch (Exception $e) {

            echo "Error" . $e->getMessage() . "<br>";
        }
    }



    public function ModificarMenosStock($id_producto, $user, $responsable)
    {

        global $conn;

        $sql_0 = "SELECT stock FROM producto_inv WHERE idProducto = '$id_producto'";

        $resultado = $conn->query($sql_0);

        $cantidad_bd = $resultado->fetch_object();

        $cant_final = $cantidad_bd->stock - $this->getCantproducto();

        if ($cant_final < 0) {

            $cant_final = 0;
        }

        try {

            $sql = "UPDATE producto_inv SET stock = '$cant_final' WHERE idProducto = '$id_producto'";

            $conn->query($sql);
        } catch (Exception $e) {

            echo "Error" . $e->getMessage() . "<br>";
        }



        try {

            date_default_timezone_set("America/Santiago");

            $comentario = " Entregó " . $this->getCantproducto() . ' producto(s) ';
            $accion = 'E';
            $cantidad = $this->getCantproducto();

            $sql_2 = "INSERT INTO log_inv (idProducto, fecha, hora, usuario, comentario, destino, responsable, accion, cantidad) VALUES ('" . $id_producto . "', '" . date('Y-m-d') . "', '" . date('H:i:s') . "', '" . strtoupper($user) . "', '" . $comentario . "', '" . strtoupper($this->getOficina()) . "', '" . strtoupper($responsable) . "', '" . $accion . "', '" . $cantidad . "')";

            $conn->query($sql_2);
        } catch (Exception $e) {

            echo "Error" . $e->getMessage() . "<br>";
        }
    }



    public function mostrarLogs($id_producto)
    {

        global $conn;

        try {

            $sql = "SELECT
            LG.*,
            PR.nombre
        FROM
            log_inv LG
        JOIN producto_inv PR ON
            LG.idProducto = PR.idProducto
        WHERE
            LG.idProducto = $id_producto
        ORDER BY
            LG.fecha
        DESC
        LIMIT 8";

            $resultado = $conn->query($sql);

            if ($resultado->num_rows > 0) {

                $objetos = new arrayobject();

                while ($fila = $resultado->fetch_object()) {

                    $objetos[] = $fila;
                }
            }

            return $objetos;
        } catch (Exception $e) {

            echo "Error" . $e->getMessage() . "<br>";
        }
    }





    public function mostrarLogsHistorico()
    {

        global $conn;

        try {

            $sql = "SELECT
                            LG.fecha,
                            LG.hora,
                            LG.usuario,
                            LG.comentario,
                            PR.nombre,
                            LG.destino,
                            LG.responsable
                            FROM
                            log_inv LG
                            JOIN producto_inv PR ON
                            LG.idProducto = PR.idProducto
                            ORDER BY
                            LG.fecha
                            DESC
                            ,
                            LG.hora
                            DESC";

            $resultado = $conn->query($sql);

            if ($resultado->num_rows > 0) {

                $objetos = new arrayobject();

                while ($fila = $resultado->fetch_object()) {

                    $objetos[] = $fila;
                }
            }

            return $objetos;
        } catch (Exception $e) {

            echo "Error" . $e->getMessage() . "<br>";
        }
    }




    public function eliminarProducto($id_producto)
    {

        global $conn;

        try {

            $sql = "DELETE FROM producto_inv WHERE idProducto = '$id_producto'";

            $conn->query($sql);
        } catch (Exception $e) {

            echo "Error" . $e->getMessage() . "<br>";
        }
    }
}

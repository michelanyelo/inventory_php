<?php 

class Categorias{
	public $idcategoria;
	public $nomcategoria;
	public $desccategoria;


	public function __construct(){
		$this->idcategoria = '';
		$this->nomcategoria = '';
		$this->desccategoria = '';
	}


	public function setIdcategoria($idcategoria){
		$this->idcategoria = $idcategoria;
	}   

	public function getIdcategoria(){
		return $this->idcategoria;
	}

	public function setNomcategoria($nomcategoria){
		$this->nomcategoria = $nomcategoria;
	}   

	public function getNomcategoria(){
		return $this->nomcategoria;
	} 

	public function setDesccategoria($desccategoria){
		$this->desccategoria = $desccategoria;
	}   

	public function getDesccategoria(){
		return $this->desccategoria;
	}


	//GUARDAR CATEGORIA NUEVA BD
	public function GrabarCategoria(){
		$nom_categoria = strtoupper($this->getNomcategoria());
		$desc_categoria = strtoupper($this->getDesccategoria());
		global $conn;
		try{
			date_default_timezone_set("America/Santiago");
			$sql = "INSERT INTO categoria_inv (nombre, descripcion, fecha) VALUES ('".$nom_categoria."', '".$desc_categoria."', '".date('Y-m-d')."')";
				$conn->query($sql);
			}catch(Exception $e){
				echo "Error" . $e->getMessage() . "<br>";
			}
		} 


			//MOSTRAR TODAS LAS CATEGORIAS
		public function mostrarCategorias(){
			global $conn;
			try{
				$sql = "SELECT * FROM categoria_inv ORDER BY nombre ASC";
				$resultado = $conn->query($sql);
				if($resultado->num_rows > 0){
					$objetos = new arrayobject();
					while($fila = $resultado->fetch_object()){
						$objetos[] = $fila;
					}
					return $objetos;
				}
			}catch(Exception $e){
				echo "Error" . $e->getMessage() . "<br>";
			}
		}

		//MOSTRAR ID SEGUN NOMBRE
		public function mostrarIdCategorias($nombre_cat){
			global $conn;
			try{
				$sql = "SELECT idCategoria FROM categoria_inv WHERE nombre = '$nombre_cat'";
				$resultado = $conn->query($sql);
				if($resultado->num_rows > 0){
					$objetos = new arrayobject();
					while($fila = $resultado->fetch_object()){
						$objetos[] = $fila;
					}
					return $objetos;
				}
			}catch(Exception $e){
				echo "Error" . $e->getMessage() . "<br>";
			}
		}

		//ELIMINAR CATEGORIA
		public function eliminarCategoria($id_categoria){
			global $conn;
			try{
				$sql = "DELETE FROM categoria_inv WHERE idCategoria = '$id_categoria'";
				$conn->query($sql);
			}catch(Exception $e){
				echo "Error" . $e->getMessage() . "<br>";
			}
		}
	}
?>
<?php
	
	include_once 'pelicula.php';

	class ApiPeliculas{

		//Variables globales

		private $imagen;
		private $error;

		//Pedir toda la tabla

		function getAll(){
			$pelicula = new Pelicula();

			//Creamos el array y le agregamos el item
			$peliculas = array();
			$peliculas["items"] = array();

			//Se pide los datos de la base de datos

			$res = $pelicula->obtenerPeliculas();

			//se cuentan las filas y si las hay inicia el ciclo

			if($res->rowCount()){

				while($row = $res->fetch(PDO::FETCH_ASSOC)){

					//se agregan los datos al array de item
					$item = array(
						'id' => $row['id'],
						'nombre' => $row['nombre'],
						'imagen' => $row['imagen']
					);
					//se agregan los datos al array de item
					array_push($peliculas['items'], $item);
				}

				//Se envia el array a la funcion para imprimir el JSON

				// echo json_encode($peliculas);
				$this->printJSON($peliculas);

			}else{

				//valida si hay datos disponibles

				//echo json_encode(array('mensaje' => 'No hay mensaje registrados'));
				$this->error('No hay elementos registrados');
			}
		}

		// Pide los datos segun el id que se mando

		function getById($id){
			$pelicula = new Pelicula();
			$peliculas = array();
			$peliculas["items"] = array();

			$res = $pelicula->obtenerPelicula($id);

			//aqui se valida de que sea una sola fila de datos

			if($res->rowCount() == 1){

				//se agregan los datos al array de item
				$row = $res->fetch();
			
				$item = array(
					'id' => $row['id'],
					'nombre' => $row['nombre'],
					'imagen' => $row['imagen']
				);
				//se agregan los datos al array de item
				array_push($peliculas['items'], $item);

			// echo json_encode($peliculas);
				$this->printJSON($peliculas);

			}else{
				//valida si hay datos disponibles

				//echo json_encode(array('mensaje' => 'No hay mensaje registrados'));
				$this->error('No hay elementos registrados');
			}
		}

		//Añade peliculas 

		function add($item){
			$pelicula = new Pelicula();

			$pelicula->nuevaPelicula($item);
			//$res = $pelicula->nuevaPelicula($item);
			$this->exito('Nueva pelicula registrada');
		}

		function exito($mensaje){
			echo json_encode(array('mensaje' => $mensaje));
		}

		function error($mensaje){
			echo json_encode(array('mensaje' => $mensaje));
		}

		//Imprime el JSON en la vista

		function printJSON($array){
			echo '<code>'. json_encode($array) .'</code>';
		}

		//Sube las imagenes

		function subirImagen($file){
			$directorio = "imagenes/";

			$this->imagen = basename($file["name"]);
			$archivo = $directorio . basename($file["name"]);

			$tipoArchivo = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));

			// valida que es imagen
			$checarSiImagen = getimagesize($file["tmp_name"]);

			//var_dump($size);

			if($checarSiImagen != false){

				//validando tamaño del archivo
				$size = $file["size"];

				if($size > 500000){
						$this->error = "El archivo tiene que ser menor a 500kb";
						return false;
				}else{

					//validar tipo de imagen
					if($tipoArchivo == "jpg" || $tipoArchivo == "jpeg"){
							// se validó el archivo correctamente
							if(move_uploaded_file($file["tmp_name"], $archivo)){
									//$this->error = "El archivo se subió correctamente";
									return true;
							}else{
									$this->error = "Hubo un error en la subida del archivo";
									return false;
							}
					}else{
							$this->error = "Solo se admiten archivos jpg/jpeg";
							return false;
					}
				}
			}else{
					$this->error = "El documento no es una imagen";
					return false;
			}
		}

		//Envia el nombre de la imagen

		function getImagen(){
			return $this->imagen;
		}

		//Envia el error que paso al subir la imagen

		function getError(){
			return $this->error;
		}

	}
	
?>
<?php
	
	include_once 'apipeliculas.php';

	$api = new ApiPeliculas();

	//verifica si se han enviado los datos

	if(isset($_POST['nombre']) && isset($_FILES['imagen'])){

		//se envia la imagen

		if($api->subirImagen($_FILES['imagen'])){

			// Insertar datos
			$item = array(
				'nombre' => $_POST['nombre'],
				'imagen' => $api->getImagen()
			);
			// se mandan los datos
			$api->add($item);
		}else{
			$api->error('Error con el archivo ' . $api->getError());
		}
	}else{
		$api->error('Error al llamar la API');
	}

?>
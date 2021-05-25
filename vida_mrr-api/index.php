<?php
	
	include_once 'apipeliculas.php';

	$api = new ApiPeliculas();
//verifica si hay un id en la urk
	if(isset($_GET['id'])){

		$id = $_GET['id'];
		//verifica si el id es numerico
		if(is_numeric($id)){
			
			$api->getById($id);
		}else{
			$api->error('Los parametros son incorrectos');
		}
	}else{
		$api->getAll();
	}

	
?>
<?php

require_once("comentarios.class.php");

$obj_com = new comentarios;

$obj_com->fky_usu_onl = $_POST["fky_usu_onl"];
$obj_com->res_com_vid = $_POST["res_com_vid"];
$obj_com->tit_com_vid = $_POST["tit_com_vid"];
$obj_com->com_com_vid = $_POST["com_com_vid"];

switch ($_REQUEST["accion"]) {

	case 'agregarComentario':
		$mensaje = $obj_com->agregarComentario();
		if($mensaje == true){
			echo json_encode("paso");
		}else{
			echo json_encode("error");
		}
		break;

	case 'agregarRespuesta':
		$mensaje = $obj_com->agregarRespuesta();
		if ($mensaje == true) {
			echo json_encode("paso");
		} else {
			echo json_encode("error");
		}
		break;
}

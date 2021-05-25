<?php

/* session_start(); */

require_once("like.class.php");
require_once("comentarios.class.php");

$obj_lik = new like;
$obj_com = new comentarios;

$obj_lik->fky_usu_onl = 1;
$obj_lik->fky_com_vid = $_POST["cod_com_vid"];
$obj_com->cod_com_vid = $_POST["cod_com_vid"];

switch ($_REQUEST["valorAccion"]) {

	case 'agregarLike':
		$obj_lik->contador = $obj_lik->verificarLike();
		if ($obj_lik->count() >= 1) {
			// echo json_encode("error");
		} else {
			$obj_lik->agregarLike();
			$obj_com->sumarLike();
			// echo json_encode("paso");
		}
		break;

	case 'agregarDislike':
		$obj_lik->contador = $obj_lik->verificarDislike();
		if ($obj_lik->count() >= 1) {
			// echo json_encode("error");
		} else {
			$obj_lik->agregarDislike();
			$obj_com->sumarDislike();
			// echo json_encode("paso");
		}
		break;

	case 'CambiarLikeDislike':
		$obj_lik->contador = $obj_lik->verificarLike();
		if ($obj_lik->count() >= 1) {
			$obj_lik->puntero = $obj_lik->verificarLike();
			$like = $obj_lik->extractData();
			$obj_lik->cod_lik_vid = $like['cod_lik_vid'];
			$mensaje = $obj_lik->CambiarLikeDislike();
			if ($mensaje == true) {
				$obj_com->restarLike();
				$obj_com->sumarDislike();
				// echo json_encode("paso");
			} else {
				// echo json_encode("error");
			}
		} else {
			// echo json_encode("error");
		}

		break;

	case 'CambiarDislikeLike':
		$obj_lik->contador = $obj_lik->verificarDislike();
		if ($obj_lik->count() >= 1) {
			$obj_lik->puntero = $obj_lik->verificarDislike();
			$like = $obj_lik->extractData();
			$obj_lik->cod_lik_vid = $like['cod_lik_vid'];
			$mensaje = $obj_lik->CambiarDislikeLike();
			if ($mensaje == true) {
				$obj_com->restarDislike();
				$obj_com->sumarlike();
				// echo json_encode("paso");
			} else {
				// echo json_encode("error");
			}
		} else {
			// echo json_encode("error");
		}

		break;

	case 'quitarLike':
		$obj_lik->contador = $obj_lik->verificarLike();
		if ($obj_lik->count() >= 1) {
			$obj_lik->puntero = $obj_lik->verificarLike();
			$like = $obj_lik->extractData();
			$obj_lik->cod_lik_vid = $like['cod_lik_vid'];
			$obj_lik->quitarLike();
			$obj_com->restarLike();
			// echo json_encode("paso");
		} else {
			// echo json_encode("error");
		}
		break;

	case 'quitarDislike':
		$obj_lik->contador = $obj_lik->verificarDislike();
		if ($obj_lik->count() >= 1) {
			$obj_lik->puntero = $obj_lik->verificarDislike();
			$dislike = $obj_lik->extractData();
			$obj_lik->cod_lik_vid = $dislike['cod_lik_vid'];
			$obj_lik->quitarlike();
			$obj_com->restarDislike();
			// echo json_encode("paso");
		} else {
			// echo json_encode("error");
		}
		break;
}
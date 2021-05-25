<?php

/*
CREATE TABLE `comentario_video` (
	`cod_com_vid` INT(11) NOT NULL COMMENT 'Código del comentario',
	`fky_usu_onl` INT(11) NOT NULL COMMENT 'Código del usuario',
	`com_com_vid` TEXT NOT NULL COMMENT 'Responder',
	`res_com_vid` INT(11) NULL COMMENT 'Respuesta del comentario, recursividad',
	`ver_com_vid` ENUM('N','V') NOT NULL COMMENT 'Verificación del comentario',
	`est_com_vid` ENUM('A','I') NOT NULL COMMENT 'Estatus del comentario',
	`reg_com_vid` DATETIME DEFAULT 	Responderamp COMMENT 'Registro del comentario',
	INDEX (fky_usu_onl),
	INDEX (res_com_vid),
	FOREIGN KEY (fky_usu_onl) REFERENCES usuario_online(fky_usu_onl),
	FOREIGN KEY (res_com_vid) REFERENCES comentario_video(res_com_vid)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Comentarios de los videos';
*/

require_once("utilidad.class.php");

class comentarios extends utilidad
{

	public $cod_com_vid;
	public $fky_usu_onl;
	public $com_com_vid;
	public $lik_com_vid;
	public $dis_com_vid;
	public $res_com_vid;
	public $ver_com_vid;
	public $est_com_vid;
	public $reg_com_vid;

	//==============================================================================
	public function agregarComentario()
	{
		$fecha_registro = date("y-m-d h:i:s");

		$this->que_bda = "INSERT INTO comentario_video 
		(fky_usu_onl, tit_com_vid, com_com_vid, lik_com_vid, dis_com_vid, res_com_vid, ver_com_vid, est_com_vid, reg_com_vid)
		VALUES 
		('$this->fky_usu_onl', '$this->tit_com_vid', '$this->com_com_vid', '0', '0', '0', 
		'N', 'A', '$fecha_registro');";
		return $this->run();
	} //Fin Agregar Comentario
	//==============================================================================

	public function agregarRespuesta()
	{
		$fecha_registro = date("y-m-d h:i:s");

		$this->que_bda = "INSERT INTO comentario_video 
		(fky_usu_onl, com_com_vid, lik_com_vid, dis_com_vid, res_com_vid, ver_com_vid, est_com_vid, reg_com_vid)
		VALUES 
		('$this->fky_usu_onl', '$this->com_com_vid', '0', '0', '$this->res_com_vid', 
		'N', 'A', '$fecha_registro');";
		return $this->run();
	} //Fin Agregar Respuesta
	//==============================================================================

	public function sumarLike()
	{
		$this->que_bda = "UPDATE comentario_video SET 
												lik_com_vid=lik_com_vid+1
											WHERE 
												cod_com_vid = '$this->cod_com_vid';";
		return $this->run();
	} //Fin sumar Like
	//==============================================================================

	public function restarLike()
	{
		$this->que_bda = "UPDATE comentario_video SET 
												lik_com_vid=lik_com_vid-1
											WHERE 
												cod_com_vid = '$this->cod_com_vid';";
		return $this->run();
	} //Fin restar Like
	//==============================================================================

	public function sumarDislike()
	{
		$this->que_bda = "UPDATE comentario_video SET 
												dis_com_vid=dis_com_vid+1
											WHERE 
												cod_com_vid = '$this->cod_com_vid';";
		return $this->run();
	} //Fin sumar Dislike
	//==============================================================================

	public function restarDislike()
	{
		$this->que_bda = "UPDATE comentario_video SET 
												dis_com_vid=dis_com_vid-1
											WHERE 
												cod_com_vid = '$this->cod_com_vid';";
		return $this->run();
	} //Fin restar Dislike
	//==============================================================================

	public function listarComentario()
	{
		$this->que_bda = "SELECT * FROM comentario_video WHERE res_com_vid = 0 ORDER BY cod_com_vid DESC;";
		return $this->run();
	} //Fin Listar Comentario
	//==============================================================================

	public function listarRespuestas()
	{
		$this->que_bda = "SELECT * FROM comentario_video WHERE res_com_vid = $this->res_com_vid;";
		return $this->run();
	} //Fin Listar Responder
	//==============================================================================

}//Fin de la Clase
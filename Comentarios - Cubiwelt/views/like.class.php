<?php

/*
CREATE TABLE `like_comentario` (
  `cod_lik_vid` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Código del like del comentario',
	`tip_lik_vid` ENUM('L','D') NOT NULL COMMENT 'Like o Dislike',
  `fky_usu_onl` INT(11) NOT NULL COMMENT 'Código del usuario',
  `fky_com_vid` INT(11) NOT NULL COMMENT 'Código del comentario',
	PRIMARY KEY (cod_lik_vid),
	INDEX (fky_usu_onl),
	INDEX (fky_com_vid),
	FOREIGN KEY (fky_usu_onl) REFERENCES usuario_online(cod_usu_onl) ON DELETE RESTRICT ON UPDATE CASCADE,
	FOREIGN KEY (fky_com_vid) REFERENCES comentario_video(cod_com_vid) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
*/

require_once("utilidad.class.php");

class like extends utilidad
{

	public $cod_lik_vid;
	public $tip_lik_vid;
	public $fky_usu_onl;
	public $fky_com_vid;

	public function agregarLike()
	{
		$this->que_bda = "INSERT INTO like_comentario 
		(tip_lik_vid, fky_usu_onl, fky_com_vid)
		VALUES 
		('L', '$this->fky_usu_onl','$this->fky_com_vid');";
		// echo json_encode($this->que_bda);
		return $this->run();
	} //Fin Agregar like
	//==============================================================================

	public function CambiarLikeDislike()
	{
		$this->que_bda = "UPDATE like_comentario SET
												tip_lik_vid = 'D'
											WHERE 
												cod_lik_vid = '$this->cod_lik_vid';";
		// echo json_encode($this->que_bda);
		return $this->run();
	} //Fin Cambiar like a dislike
	//==============================================================================

	public function CambiarDislikeLike()
	{
		$this->que_bda = "UPDATE like_comentario SET
												tip_lik_vid = 'L'
											WHERE 
												cod_lik_vid = '$this->cod_lik_vid';";
		// echo json_encode($this->que_bda);
		return $this->run();
	} //Fin Cambiar dislike a like
	//==============================================================================

	public function quitarLike()
	{
		$this->que_bda = "DELETE FROM like_comentario WHERE cod_lik_vid = '$this->cod_lik_vid';";
		return $this->run();
		// echo json_encode($this->que_bda);
	} //Fin quitar like
	//==============================================================================

	public function agregarDislike()
	{
		$this->que_bda = "INSERT INTO like_comentario 
		(tip_lik_vid, fky_usu_onl, fky_com_vid)
		VALUES 
		('D', '$this->fky_usu_onl','$this->fky_com_vid');";
		// echo json_encode($this->que_bda);
		return $this->run();
	} //Fin Agregar Dislike
	//==============================================================================
	
	public function verificarLike()
	{
		$this->que_bda = "SELECT * FROM like_comentario WHERE 
												fky_usu_onl = '$this->fky_usu_onl' AND 
												fky_com_vid = '$this->fky_com_vid' AND 
												tip_lik_vid = 'L';";
		// echo json_encode($this->que_bda);
		return $this->run();
	} //Fin Verificar Like
	//==============================================================================
	
	public function verificarDislike()
	{
		$this->que_bda = "SELECT * FROM like_comentario WHERE 
												fky_usu_onl = '$this->fky_usu_onl' AND 
												fky_com_vid = '$this->fky_com_vid' AND 
												tip_lik_vid = 'D';";
		// echo json_encode($this->que_bda);
		return $this->run();
	} //Fin Verificar Dislike

}
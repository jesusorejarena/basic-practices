<?php /*
session_start();
require("../backend/clase/utilidad.class.php");
require("../backend/clase/video.class.php");
require("../backend/clase/video_modulo.class.php");
require("../backend/clase/tipo_curso.class.php");
require("../backend/clase/instructor.class.php");
require("../backend/clase/inscripcion.class.php");
require("../backend/clase/curso_avance.class.php");
require("../backend/clase/alumno.class.php");
require_once('../mobile-detect/mobile_detect.php');

$objUtilidad = new utilidad;
$objVideo = new video;
$objVideoModulo = new video_modulo;
$objTipoCurso = new tipo_curso;
$objInstructor = new instructor;
$objInscripcion = new inscripcion;
$objCursoAvance = new curso_avance;
$objAlumno = new alumno;

$nro_vid = false;
$nro_mod = 1;
$video["pos_vid_mod"] = 1;
$ruta = "";
$margin_top = "";
$font_size = "";
$font_size_clases = "";
$autoplay = "autoplay";
$objVideo->val = "";
$detect = new Mobile_Detect();


if ($detect->isMobile()) {
	// Detecta si es un móvil
}

if ($detect->isTablet()) {
	// Si es un tablet
}

if ($detect->isAndroidOS()) {
	// Si es Android
}

if ($detect->isiOS()) {
	//Si es iOS
}

// Se verifica si se recibe la variable tc(tipo_curso), si no existe lo regresa al index
if (!empty($_GET['tc'])) {
	$tipoCurso = $_GET['tc'];
} else {
	header("Location: ../");
}

foreach ($_REQUEST as $nombre_campo => $valor) {
	@$objVideo->asignar_valor($nombre_campo, $_GET["val"]);
}

foreach ($_REQUEST as $nombre_campo => $valor) {
	@$objVideoModulo->asignar_valor("fky_tipo_curso", $_GET["tc"]);
}

$objInstructor->asignar_valor("cod_tip_cur", $tipoCurso);
$objInstructor->asignar_valor("fky_modalidad", 2); //La modalidad Online es la 2
$objInstructor->asignar_valor("est_cur", "I"); //Buscaremos los cursos no inactivos
$pun_ins = $objInstructor->buscar_instructor();
$instructor = $objInstructor->extraer_dato($pun_ins);

if (empty($instructor['cod_ins'])) {
	header("Location: ../");
}; // Se verifica si existe el id del instructor, en caso de que no exista lo regresa al index

include_once("seguridad/seguridad_online.php");

if (isset($_SESSION["fky_usuario_online"])) {
	$objInscripcion->asignar_valor("fky_modalida", 2); //Buscamos que el curso sea online.
	$objInscripcion->asignar_valor("fky_usuario_online", $_SESSION["fky_usuario_online"]); //Usuario que esta en sesion
	$objInscripcion->asignar_valor("fky_tipo_curso", $tipoCurso);
	$pun_acc = $objInscripcion->filtrar("", "", "", "", "", $est_cur = "A");
	$datos = $objInscripcion->extraer_dato($pun_acc);

	$objInscripcion->asignar_valor("est_ins", $datos["est_ins"]);
	$acceso = $objInscripcion->verificar_status_inscripcion();
	$objAlumno->asignar_valor("fky_usuario_online", $_SESSION["fky_usuario_online"]);
	$resultado = $objAlumno->filtrar("", $ide_alu = "", $nom_alu = "", $ape_alu = "", $te1_alu = "", $ema_alu = "");
	$alumno = $objAlumno->extraer_dato($resultado);

	if ($acceso == false) {
		$boton1 = $boton2 = $url_video = $descarga = $material = $whatsapp = "javascript:invitacion();";
	} elseif ($acceso == true) {
		$nro_vid = (isset($_GET["v"])) ? $_GET["v"] : false;


		if ($nro_vid == false) {
			$objCursoAvance->asignar_valor("fky_inscripcion", $datos["cod_ins"]);
			$pun_ava = $objCursoAvance->ultimo_video();
			$avance = $objCursoAvance->extraer_dato($pun_ava);

			if (!empty($avance["ultimo"])) {
				$nro_vid = $avance["ultimo"];
			} else {
				$objVideo->asignar_valor("est_vid", "A");
				$objVideo->asignar_valor("fky_tipo_curso", $tipoCurso);
				$pun_vi1 = $objVideo->video_inicial();
				$primero = $objVideo->extraer_dato($pun_vi1);
				$nro_vid = $primero["min_cod"];
			}
		}
		$objVideo->asignar_valor("cod_vid", $nro_vid);
		$pun = $objVideo->videos_info();
		$video = $objVideo->extraer_dato($pun);

		$nro_mod = $video["pos_vid_mod"];
		$videoAnterior = (!empty($video['fky_video_anterior'])) ? $video['fky_video_anterior'] : "";
		$videoSiguiente = (!empty($video['fky_video_siguiente'])) ? $video['fky_video_siguiente'] : "";
	}
} else {
	$acceso = false;
	$boton1 = $boton2 = $url_video = $descarga = $material = $whatsapp = "javascript:invitacion();";
}

$objTipoCurso->asignar_valor("order_by", "cod_tip_cur");
$pun1 = $objTipoCurso->filtrar($tipoCurso, $nom_tip_cur = "", $fky_area = "", $fky_empresa = "", $est_tip_cur = "");
$datosCurso = $objTipoCurso->extraer_dato($pun1);
$requisitoCurso = $datosCurso['req_tip_cur'];


if ($acceso == true) {
	$objCursoAvance->asignar_valor("fky_video", $nro_vid);
	$objCursoAvance->asignar_valor("fky_curso", $datos["fky_curso"]);
	$objCursoAvance->asignar_valor("fec_cur_ava", date("Y-m-d H:i:s"));
	$objCursoAvance->asignar_valor("fky_inscripcion", $datos["cod_ins"]);

	if (!empty($objCursoAvance->fky_curso) && !empty($objCursoAvance->fky_video) && !empty($objCursoAvance->fky_inscripcion)) {
		$pun_pri = $objCursoAvance->buscar_repitiente_clase();
		$pri_vez = $objCursoAvance->extraer_dato($pun_pri);

		

		$objCursoAvance->est_cur_ava = ($video["cal_vid"] == 'N') ? "A" : "P";

		if (empty($pri_vez['cod_cur_ava'])) {
			$objCursoAvance->cal_cur_ava = 0;
			$objCursoAvance->obs_cur_ava = "";
			$objCursoAvance->agregar();
		} else {
			$objCursoAvance->actualizar_fecha_avance();
		}
	}
} else {
	$objCursoAvance->fky_inscripcion = "";
}


if (isset($_GET["v"]) && $acceso == true) {
	$vid_sel = $video["pos_vid"];
	$nom_vid = "Módulo $video[pos_vid_mod] - Clase $video[pos_vid]: " . $video["nom_vid"];
	$ruta = "../frontend/vista/video/video/" . $video["url_vid"];
	$autoplay = "autoplay";
} elseif (!isset($_GET["v"]) && $acceso == true) {
	$vid_sel = $video["pos_vid"];
	$nom_vid = "Módulo $video[pos_vid_mod] - Clase $video[pos_vid]: " . $video["nom_vid"];
	$ruta = "../frontend/vista/video/video/" . $video["url_vid"];
	$autoplay = "autoplay";
} else {
	$autoplay = "autoplay";
	$nom_vid = "Video Promocional";
	$vid_sel = "";
	$ruta = $datosCurso["vid_tip_cur"];
	$video["url_vid"] = $datosCurso["vid_tip_cur"];
}

*/ ?>

<!DOCTYPE html>

<html lang="es">

<head>



	<title>Clase Online - Ingeniería Digital</title>

	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<!--

	<link href="https://fonts.googleapis.com/css?family=Anton|Cairo:300,400,600,700,900|Kanit:300,300i,400,400i,500,500i,600,600i,700,700i,900,900i|Oswald:300,400,500,600,700|Play:400,700|Rubik:300i,400,400i,500,500i,700,700i,900,900i|Staatliches|Teko:300,400,500,600,700|Ubuntu:300,300i,400,400i,500,500i,700,700i&amp;subset=arabic,greek,latin-ext" rel="stylesheet">
-->

	<!--
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,700,900' rel='stylesheet' type='text/css'> -->

	<link rel="stylesheet" href="../frontend/css/style-cubiwelt.css">

	<link rel="stylesheet" href="../frontend/bootstrap-4.0/css/bootstrap.css">

	<link rel="stylesheet" href="../frontend/bootstrap-4/css/bootstrap.css">

	<link rel="shortcut icon" type="image/x-icon" href="../frontend/img/icono-explorador.png" />

	<link rel="stylesheet" href="../frontend/icons-fonts/style.css">

	<link rel="stylesheet" href="../frontend/slider-3d/swiper.css"><!-- slider 3D-->

	<link rel="stylesheet" href="../frontend/slider-3d/style3d.css"><!-- slider 3D-->

	<!--
	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'> -->
	<!--
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"> -->

	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css'>



	<script>
		function invitacion()

		{

			alert("Para poder accesar debes comprar el curso.");

		}
	</script>

</head>

<?php /*

if ($objVideo->val != "") {

	echo "

	<script>

			alert('Tu pago se estará validando en las próximas horas.');

	</script>

	";
}

*/ ?>

<body style="overflow-x: hidden; width: 100%;">



	<span class=" ir-arribaa icon-expand_less"></span>



	<?php /* include("menu-login.php") */ ?>



	<div class="container-fluid video-conte-cur m-0 p-0" style="width: 100%; max-width: 99.52vw;">



		<div class="container-fluid pt-2">

			<br><br>

		</div><!-- Div que hace espacio poor debajo del menu cuando baja el Scroll para esconder el menu-->



		<!--........... ENCABEZADO ............... -->

		<div class="container-fluid top-ti-tu pt-3 pb-3" style="height: 100%;">

			<div class="row col-md-12 m-0 p-0">



				<div class="col-md-9 text-white arial pl-4">

					<h3 class="text-left"><strong>Curso de <?php /* echo $datosCurso["nom_tip_cur"] */ ?></strong></h3>



					<div class="row m-0 p-0">

						<img src="<?php /* echo "../frontend/vista/instructor/fotos/$instructor[url_ins]"; */ ?>" class="rounded-circle align-self-start mr-2 ml-3" alt="..." width="30">

						<h6 class="text-left pt-2"><i>Instructor:
								<?php /* echo $instructor['gra_ins'] . ". " . $instructor['nom_ins'] . " " . $instructor['ape_ins'] */ ?></i>
						</h6>

					</div>

				</div>



			</div>

		</div>



		<!--................ VIDEO TUTORIAL........................................................-->



		<!--  poster="//shaka-player-demo.appspot.com/assets/poster.jpg" -->

		<div class="row p-0 m-0">

			<div class="col-xs-12  col-md-7 mb-5" style="max-height: 5000px;">

				<div class="container-fluid text-center ml-md-2 pl-md-3 mr-md-2 m-auto pb-xs-5 mb-xs-5" style="max-width: 770px;">

					<video data-shaka-player id="video" <?php /* echo $autoplay */ ?> width="100%" poster="<?php /* echo $video['por_vid'] */ ?>" crossorigin="anonymous"></video>



					<div class="row mt-2 mb-0 p-0  arial pl-3 text-center">

						<div class="col m-3 text-muted">

							<h6><i><?php /* echo $nom_vid; */ ?></i></h6>

						</div>

					</div>

					<?php /*
					if ($acceso == true) {
						if (empty($videoAnterior) && empty($videoSiguiente)) {
							$classAnterior = 'd-none';
							$botonAnterior = '';

							$classSiguiente = 'd-none';
							$botonSiguiente = '';
						} elseif (empty($videoAnterior) && !empty($videoSiguiente)) {
							$classAnterior = 'd-none';
							$botonAnterior = '';

							$objVideo->asignar_valor("cod_vid", $videoSiguiente);
							$punSiguiente = $objVideo->videos_info();
							$datoSiguiente = $objVideo->extraer_dato($punSiguiente);

							$moduloSiguiente = $datoSiguiente['fky_video_modulo'];
							$classSiguiente = 'd-inline';
							$botonSiguiente = 'curso_online.php?v=' . $videoSiguiente . '&tc=' . $tipoCurso . '&n=' . $moduloSiguiente;
						} elseif (!empty($videoAnterior) && !empty($videoSiguiente)) {
							$objVideo->asignar_valor("cod_vid", $videoAnterior);
							$punAnterior = $objVideo->videos_info();
							$datoAnterior = $objVideo->extraer_dato($punAnterior);

							$moduloAnterior = $datoAnterior['fky_video_modulo'];
							$classAnterior = 'd-inline';
							$botonAnterior = 'curso_online.php?v=' . $videoAnterior . '&tc=' . $tipoCurso . '&n=' . $moduloAnterior;

							$objVideo->asignar_valor("cod_vid", $videoSiguiente);
							$punSiguiente = $objVideo->videos_info();
							$datoSiguiente = $objVideo->extraer_dato($punSiguiente);

							$moduloSiguiente = $datoSiguiente['fky_video_modulo'];
							$classSiguiente = 'd-inline';
							$botonSiguiente = 'curso_online.php?v=' . $videoSiguiente . '&tc=' . $tipoCurso . '&n=' . $moduloSiguiente;
						} elseif (!empty($videoAnterior) && empty($videosiguiente)) {
							$objVideo->asignar_valor("cod_vid", $videoAnterior);
							$punAnterior = $objVideo->videos_info();
							$datoAnterior = $objVideo->extraer_dato($punAnterior);

							$moduloAnterior = $datoAnterior['fky_video_modulo'];
							$classAnterior = 'd-inline';
							$botonAnterior = 'curso_online.php?v=' . $videoAnterior . '&tc=' . $tipoCurso . '&n=' . $moduloAnterior;

							$classSiguiente = 'd-none';
							$botonSiguiente = '';
						}
					} else {
						$classAnterior = 'd-none';
						$botonAnterior = '';

						$classSiguiente = 'd-none';
						$botonSiguiente = '';
					}
					*/ ?>

					<div class="buttons">

						<a href='<?php /* echo $botonAnterior */ ?>'>
							<button id="prev" class="<?php /* echo $classAnterior */ ?>">
								<span class="icon-chevron-small-left">
								</span>
							</button>
						</a>

						<a href='<?php /* echo $botonSiguiente */ ?>'>
							<button id="next" class="<?php /* echo $classSiguiente */ ?>">
								<span class="icon-chevron-small-right">
								</span>
							</button>
						</a>

					</div>

				</div>
			</div>

			<?php /*
			if (!isset($_GET["v"])) {
				if ($detect->isMobile()) {
					$margin_top = "margin-top: 60px;";
					$font_size = "font-size: 0.9rem;";
					$font_size_clases = "font-size: 1.3rem;";
				}
				if (empty($requisitoCurso)) {
			*/ ?>
					<div class="xs-p-5 col-xs-12 col-md-4" style="max-height: 420px;">
						<div class="container-fluid bg-gradient-uno ml-md-5 mr-md-5 m-sm-auto mt-sm-5 mt-xs-5 p-3 shadow-perfil-per" style="border-radius: 8px; <?php /* echo $margin_top; */ ?>">
							<span class="text-muted"><?php /* echo $sexo = ($instructor["sex_ins"] == "M") ? "Instructor" : "Instructora"; */ ?>
								del
								Curso</span>

							<hr class="m-0 p-0 mb-4 mt-2">

							<div class="text-center mt-2">
								<a href="">
									<img src="<?php /* echo "../frontend/vista/instructor/fotos/$instructor[url_ins]"; */ ?>" alt="" class="rounded-circle" width="150" style="border: 4px solid #811bff;">
								</a>
							</div>

							<div class="text-center pt-4 arial">
								<a href="" class="link-nom-per">
									<h4 class="mb-0 pb-0">
										<strong><?php /* echo $instructor['gra_ins'] . ". " . $instructor['nom_ins'] . " " . $instructor['ape_ins'] */ ?></strong>
									</h4>
								</a>
								<span class="badge badge-primary pb-1 pt-1" style="font-size: 16px;"><?php /* echo $sexo = ($instructor["sex_ins"] == "M") ? "Instructor" : "Instructora"; */ ?></span>
							</div>

							<div class="text-center mt-4 mb-1">
								<a href="#" class="link-follower">
									<?php /* echo $instructor["res_ins"]; */ ?>
								</a>
							</div>

						</div>
					</div>
				<?php /*
				} else {
				*/ ?>
					<div class="xs-p-5 col-xs-12 col-md-4" style="max-height: 420px;">
						<div class="container-fluid bg-gradient-uno ml-md-5 mr-md-5 m-sm-auto mt-sm-5 mt-xs-5 p-3 shadow-perfil-per" style="border-radius: 8px; <?php /* echo $margin_top; */ ?>">
							<!-- <img src="<?php /* echo "../frontend/vista/instructor/fotos/$instructor[url_ins]"; */ ?>" alt="" class="rounded-circle" width="30" style="border: 2px solid #811bff;"> -->
							<span class="text-muted"><?php /* echo $sexo = ($instructor["sex_ins"] == "M") ? "Instructor" : "Instructora"; */ ?>:
								<?php /* echo $instructor['gra_ins'] . ". " . $instructor['nom_ins'] . " " . $instructor['ape_ins'] */ ?></span>

							<hr class="m-0 p-0 mb-4 mt-2">

							<div class="text-center mt-4 mb-1">
								<p>
									<h6>
										Requisitos del curso:
									</h6>
								</p>

								<p class="text-justify">
									<?php /* echo $requisitoCurso */ ?>
								</p>
							</div>

						</div>
					</div>
				<?php /*
				}
			} else {
				*/ ?>

				<div class="col-md-5 p-0 m-0" style="max-height: 420px;">
					<div class="container-fluid bg-gradient-uno m-sm-auto mt-sm-5 p-3 shadow-perfil-per" style="border-radius: 8px;">
						<span class="text-muted">Información de la Clase</span>

						<hr class="m-0 p-0 mb-4 mt-2">

						<div class="text-center mt-4 mb-1">

							<p>
								<h6>
									<i>
										<?php /* echo $video["nom_vid"]; */ ?>
									</i>
								</h6>
							</p>

							<p class="text-justify">
								<?php /* echo str_replace("@usuario", $_SESSION["usuario"], $video["des_vid"]) */ ?>
							</p>

							<?php /*
							if ($video["cal_vid"] == "S") {
								echo "<p class='text-justify'>

									<b>Clase Evaluada: </b> " . $_SESSION['usuario'] . " debes hacer la misma actividad del video en casa y enviar tu asignación al correo $instructor[ema_ins]

								</p>";
							}
							*/ ?>

						</div>

					</div>
				</div>
			<?php /*
			}
			*/ ?>

		</div>

		<div class="img-conte-cur m-0 p-0">
			<img src="../frontend/img/banner-conte-curso.jpg" alt="" style="width: 99.52vw; height: 70vh;" align="text-left">
		</div>

		<div class="row m-1 p-0">

			<!-- MENU Del VIDEO....................................................-->

			<div class="col pr-3">

				<div class="row  p-0 m-0 bg-white mt-5">

					<div class="col-md-12">

						<ul class="nav nav-tabs" id="myTab" role="tablist">

							<li class="nav-item">

								<a class="nav-link vin-ho active" id="clase-tab" data-toggle="tab" href="#clases" role="tab" aria-controls="home" aria-selected="true"><strong <?php /* echo "style= $font_size;" */ ?>>Clases</strong></a>

							</li>

							<li class="nav-item">

								<a class="nav-link vin-ho" id="documentacion-tab" data-toggle="tab" href="#documentacion" role="tab" aria-controls="profile" aria-selected="false"><strong <?php /* echo "style= $font_size;" */ ?>>Blog</strong></a>

							</li>

							<li class="nav-item">

								<a class="nav-link vin-ho" id="comentarios-tab" data-toggle="tab" href="#comentarios" role="tab" aria-controls="profile" aria-selected="false"><strong <?php /* echo "style= $font_size;" */ ?>>Blog</strong></a>

							</li>

							<li class="nav-item">

								<a class="nav-link vin-ho" id="glosario-tab" data-toggle="tab" href="#glosario" role="tab" aria-controls="profile" aria-selected="false"><strong <?php /* echo "style= $font_size;" */ ?>>Glosario</strong></a>

							</li>

							<li class="nav-item">

								<a class="nav-link vin-ho" id="atajos-tab" data-toggle="tab" href="#atajos" role="tab" aria-controls="profile" aria-selected="false"><strong <?php /* echo "style= $font_size;" */ ?>>Atajos</strong></a>

							</li>

							<li class="nav-item">

								<a class="nav-link vin-ho" id="archivos-tab" data-toggle="tab" href="#archivos" role="tab" aria-controls="contact" aria-selected="false"><strong <?php /* echo "style= $font_size;" */ ?>>Archivos</strong></a>

							</li>

							<li class="nav-item">

								<a class="nav-link vin-ho" id="whatsapp-tab" data-toggle="tab" href="#whatsapp" role="tab" aria-controls="contact" aria-selected="false"><strong <?php /* echo "style= $font_size;" */ ?>>Chat</strong></a>

							</li>

							<li class="nav-item">

								<a class="nav-link vin-ho" id="zoom-tab" data-toggle="tab" href="#zoom" role="tab" aria-controls="contact" aria-selected="false"><strong <?php /* echo "style= $font_size;" */ ?>>Clase en
										Vivo</strong></a>

							</li>

						</ul>

					</div>

				</div>



				<!-- Inicio menu acordion...........................................................................-->

				<div class="col-md-12 mt-md-5 m-md-3">

					<div class="tab-content" id="myTabContent">

						<div class="tab-pane fade show active" id="clases" role="tabpanel" aria-labelledby="clase-tab">



							<h2 class="text-gray-dark pb-4 pr-5 pl-5 text-center" style="line-height: 40px;">

								<strong <?php /* echo " style= $font_size_clases; " */ ?>>¡Selecciona la clase que desees ver!</strong>

							</h2>



							<!-----------------------------------------------INICIO ACORDEON---------------------------------------------------------------->



							<div class="accordion js-accordion col-md-7 col-xs-12">



								<?php /*

								$con_mod = 1;

								$con_eva = 1;

								$guion = "";

								$titulo = "";

								$glosario = "";
								$objVideoModulo->order_by = "pos_vid_mod asc";
								$pun_vid = $objVideoModulo->filtrar();

								while (($modulo = $objVideoModulo->extraer_dato($pun_vid)) > 0) {

									$objVideo->est_vid = "A";

									$objVideo->cal_vid = "S";



									$objVideo->fky_video_modulo = $modulo["cod_vid_mod"];

									$pun_cla = $objVideo->contar_clases_modulo();

									$clases = $objVideo->extraer_dato($pun_cla);



									$pun_eva = $objVideo->contar_evaluaciones_modulo();

									$evaluaciones = $objVideo->extraer_dato($pun_eva);



									$active = ($con_mod == $video["pos_vid_mod"]) ? "active" : "";





								*/ ?>



									<div class="accordion__item js-accordion-item <?php /* echo $active */ ?>">

										<div class="accordion-header js-accordion-header ">

											<span class="icon-play_circle_filled"> </span> Módulo
											<?php /* echo $con_mod . ": " . $modulo["nom_vid_mod"] */ ?>



										</div>



										<div class="accordion-body js-accordion-body">

											<?php /*
											$con_cla = 1;
											$objVideo->est_vid = "A";
											$objVideo->fky_video_modulo = $modulo["cod_vid_mod"];
											$pun_vid_mod = $objVideo->videos_por_modulo();
											while (($video_inf = $objVideo->extraer_dato($pun_vid_mod)) > 0) {
												if (($con_mod == $nro_mod) && ($con_cla == $vid_sel)) {
													$reproductor = "<span class='badge badge-danger ml-2 pt-2 pb-2' style='width:120px;'>Reproduciendo</span>";
													$guion = $video_inf["blo_vid"];
													$glosario = $video_inf["glo_vid"];
													$titulo = $video_inf["nom_vid"];
													$atajo = $video_inf["ata_vid"];
												} else {
													$reproductor = "";
												}

												if ($acceso == true) {
													$url_video = "curso_online.php?v=" . $video_inf["cod_vid"] . "&tc=" . $video_inf["fky_tipo_curso"] . "&n=" . $con_mod;
													$descarga = "../frontend/vista/video/material/$video_inf[arc_vid]";
													$target = "target='_blank'";
												} else {
													$target = "";
												}

											*/ ?>

												<div class="accordion-body__contents">
													<div class="row">

														<div class="col-md-1 text-center d-xs-none  pt-md-1">
															<?php /* echo "<a href='$url_video'>"; */ ?>
															<h1><span class="icon-play2 text-dark"></span> </h1>
														</div>

														<div class="col-md-11 col-xs-12">
															<div class="mt-3 pl-md-4">

																<?php /* echo $reproductor; */ ?>
																<span class="float-left text-left text-dark"><b><?php /* echo "Clase $con_cla:  " . $video_inf["nom_vid"]; */ ?></b></span>
																<span class="float-right text-right text-muted">

																	<span class="pr-2"></span>

																	<?php /*
																	if (!empty($video_inf["cod_vid"]) && !empty($objCursoAvance->fky_inscripcion)) {
																		$objCursoAvance->cod_vid = $video_inf["cod_vid"];
																		$objCursoAvance->cod_ins = $objCursoAvance->fky_inscripcion;
																		$pun_vis_ava = $objCursoAvance->verificar_clase_aprobada();
																		$clase_vista = $objCursoAvance->extraer_dato($pun_vis_ava);
																		$iconClase = (!empty($clase_vista["aprobado"])) ? $clase_vista["aprobado"] : "";
																		$icono_avance = $objCursoAvance->iconos_aprobacion($iconClase);
																	} else {
																		$icono_avance = $objCursoAvance->iconos_aprobacion("L");
																	}
																	*/ ?>

																	<span class="<?php /* echo $icono_avance */ ?> pr-1"></span>

																	<?php /*
																	if ($acceso == true) {
																	*/ ?>

																		<span class="pr-1"><?php /* echo $objUtilidad->formato_tiempo($video_inf["tie_vid"]); */ ?>
																		</span>

																	<?php /*
																	}
																	*/ ?>

																</span>

																<br>

																<?php /*

																if (!empty($video_inf["arc_vid"])) {
																	echo "<div class='text-left' class='p-0 m-0'>

														<a href='$descarga' $target>

														<span class='icon-download3 pr-1'></span>

														Descargar para la Clase</a>

												</div>";
																}
																*/ ?>

																</a>&nbsp;

															</div>
														</div>
													</div>
												</div>
												<hr class="m-0 p-0">

											<?php /*
												$con_cla++;
											}
											*/ ?>

										</div><!-- end of accordion body -->
									</div><!-- end of accordion item -->



								<?php /*

									$con_mod++;
								}

								*/ ?>



							</div><!-- end of accordion -->



							<!-----------------------------------------------FIN ACORDEON---------------------------------------------------------------->

							<?php /*

							if ($acceso != true) {

								echo "

<div class='text-center align-content-center m-0 p-0 mt-3 col-xs-12 arial'>

	<a href='../bienvenida_login.php?p=i' class='btn btn-xs color-blue-c'>

		<img src='../frontend/img/icono-carrito.png' alt='' width='25' class='pb-1 pr-1'>

			<b>Comprar el Curso</b> <span style='font-size: 12px;'></span>

	

	</a>

</div>";
							}

							*/ ?>

						</div>
						<!--Fin del TAB............................-->

						<!-- DOCUMENTACION........................................ -->

						<!--Comienzo Pestaña de Documentación -->
						<div class="tab-pane fade pr-md-4 pl-md-4" id="documentacion" role="tabpanel" aria-labelledby="documentacion-tab">
							<div>
								<div class="container-fluid text-center">
									<div class="badge-success pt-4 pb-3" style="line-height: 20px; border-radius: 0px; background-color: #392a68;">
										<div>
											<span class="icon-file-text" style="font-size: 40px;"></span>
										</div>
										<div>
											<h4 class="text-white text-center p-0 m-0 pt-1">
												<strong>Blog</strong>
											</h4>
										</div>
									</div>
								</div>
								<div class="text-center pt-3 mt-0">
									<h5 class="m-0 p-0 arial text-muted"><?php /* echo "$titulo"; */ ?></h5>
								</div>
							</div>
							<hr>
							<div class="container-fluid">
								<p class="text-justify ml-md-5 mr-md-5 ml-xs-1 mr-xs-1">
									<?php /*
									echo $guion = ($acceso == true) ? $guion : "<h4>Para poder accesar debes comprar el curso.</h4>";
									*/ ?>
								</p>
							</div>
						</div>
						<!--Fin Pestaña de Documentación -->

						<!--Comienzo Pestaña de Comentarios -->
						<div class="tab-pane fade pr-md-4 pl-md-4" id="comentarios" role="tabpanel" aria-labelledby="comentarios-tab">
							<div>
								<div class="container-fluid text-center">
									<div class="badge-success pt-4 pb-3" style="line-height: 20px; border-radius: 0px; background-color: #392a68;">
										<div>
											<span class="icon-file-text" style="font-size: 40px;"></span>
										</div>
										<div>
											<h4 class="text-white text-center p-0 m-0 pt-1">
												<strong>Blog</strong>
											</h4>
										</div>
									</div>
								</div>
								<div class="text-center pt-3 mt-0">
									<h5 class="m-0 p-0 arial text-muted"><?php /* echo "$titulo"; */ ?></h5>
								</div>
							</div>
							<hr>
							<div class="container-fluid">
								<p class="text-justify ml-md-5 mr-md-5 ml-xs-1 mr-xs-1">
									<?php /*
									echo $guion = ($acceso == true) ? $guion : "<h4>Para poder accesar debes comprar el curso.</h4>";
									*/ ?>
								</p>
							</div>
						</div>
						<!--Fin Pestaña de Comentarios -->

						<!--Comienzo Pestaña de Glosario -->
						<div class="tab-pane fade pr-md-4 pl-md-4" id="glosario" role="tabpanel" aria-labelledby="profile-tab">
							<div>
								<div class="container-fluid text-center">
									<div class="badge-success pt-4 pb-3" style="line-height: 20px; border-radius: 0px; background-color: #663366;">
										<div>
											<span class="icon-book" style="font-size: 40px;"></span>
										</div>
										<div>
											<h4 class="text-white text-center p-0 m-0 pt-1">
												<strong>Glosario</strong>
											</h4>
										</div>
									</div>
								</div>
								<div class="text-center pt-3 mt-0">
									<h5 class="m-0 p-0 arial text-muted"><?php /* echo $titulo; */ ?></h5>
								</div>
							</div>
							<hr>
							<p class="text-justify ml-md-5 mr-md-5 ml-xs-1 mr-xs-1">
								<?php /*
								echo $glosario = ($acceso == true) ? $glosario : "<h4>Para poder accesar debes comprar el curso.</h4>";
								*/ ?>
							</p>
						</div>
						<!--Fin Pestaña de Glosario -->

						<!--Comienzo Pestaña de Atajos -->
						<div class="tab-pane fade pr-md-4 pl-md-4" id="atajos" role="tabpanel" aria-labelledby="profile-tab">
							<div>
								<div class="container-fluid text-center">
									<div class="badge-success pt-4 pb-3" style="line-height: 20px; border-radius: 0px; background-color: #392a68;">
										<div>
											<span class="icon-book" style="font-size: 40px;"></span>
										</div>
										<div>
											<h4 class="text-white text-center p-0 m-0 pt-1">
												<strong>Atajos del Programa</strong>
											</h4>
										</div>
									</div>
								</div>
								<div class="text-center pt-3 mt-0">
									<h5 class="m-0 p-0 arial text-muted"><?php /* echo $titulo; */ ?></h5>
								</div>
							</div>
							<hr>
							<?php /*
							if ($acceso) {
								if (!empty($atajo)) {
									$tituloPrincipal = "<div class='container-fluid px-lg-3'> <div class='row mx-lg-n3'> <div class='col-md-1'></div> <div class='col-md-10 border bg-light py-3 px-lg-3 text-center'>";
									$finTituloPrincipal = "</div> <div class='col-md-1'></div> </div> </div>";
									$inicioContainer = "<div class='container-fluid px-lg-3'> <div class='row mx-lg-n3'>";
									$inicioDiv = "<div class='col-md-1'></div> <div class='col-md-5 border py-3 px-lg-3'>";
									$mitadDiv = "</div> <div class='col-md-5 border py-3 px-lg-3'>";
									$finDiv = "</div> <div class='col-md-1'> </div>";
									$finContainer = "</div> </div> <br>";
									$busqueda = array("@tituloPrincipal", "@finTituloPrincipal", "@inicioContainer", "@inicioDiv", "@mitadDiv", "@finDiv", "@finContainer");
									$reemplazo = array($tituloPrincipal, $finTituloPrincipal, $inicioContainer, $inicioDiv, $mitadDiv, $finDiv, $finContainer);

									echo str_replace($busqueda, $reemplazo, $atajo);
								} else {
									echo "<h4>Los Atajos del Programa estarán disponibles próximamente.</h4>";
								}
							} else {
								echo "<h4>Para poder accesar debes comprar el curso.</h4>";
							}
							*/ ?>
						</div>
						<!--Fin Pestaña de Atajos -->

						<!--Comienzo de la pestaña de Archivos-->
						<div class="tab-pane fade pr-4 pl-4" id="archivos" role="tabpanel" aria-labelledby="profile-tab">
							<div>
								<div class="container-fluid text-center">
									<div class="badge-success pt-4 pb-3" style="line-height: 20px; border-radius: 0px; background-color: #663366;">
										<div>
											<span class="icon-download" style="font-size: 40px;"></span>
										</div>
										<div>
											<h4 class="text-white text-center p-0 m-0 pt-1">
												<strong>Archivos</strong>
											</h4>
										</div>
									</div>
								</div>
								<div class="text-center pt-3 mt-0">
									<h5 class="m-0 p-0 arial text-muted">Archivos de todo el Curso</h5>
								</div>
							</div>
							<hr>
							<p class="text-justify ml-md-5 mr-md-5 ml-xs-1 mr-xs-1">
								En el siguiente link puedes descargar el material necesario para realizar todo el curso. El material
								consta de diapositivas, imagenes para hacer los ejercicios y otros recursos multimedia. &nbsp;
								<?php /*
								if ($acceso == true) {
									$material = "../frontend/vista/tipo_curso/material/$datosCurso[arc_tip_cur]";
									$target = "target='_blank'";
								} else {
									$target = "";
								}
								if (!empty($datosCurso["arc_tip_cur"])) {
									echo "<a href='$material' $target>
								<span class='icon-download3 pr-2'></span>Descargar</a>";
								}
								*/ ?>
							</p>
							<small>
								<p class="text-muted ml-md-5 mr-md-5 ml-xs-1 mr-xs-1">
									<i>Debes tener instalado el programa winrar o winzip para descomprimir el archivo descargado. Si
										tienes problemas al descomprimir el archivo es muy probable que debas actualizar el winrar, puedes
										descargarlo desde la pagina oficial: https://www.winrar.es/descargas</i>
								</p>
							</small>
						</div>
						<!--Fin de la pestaña de Archivos-->

						<!--Comienzo de la pestaña de Whatsapp-->
						<div class="tab-pane fade pr-4 pl-4" id="whatsapp" role="tabpanel" aria-labelledby="whatsapp-tab">
							<div>
								<div class="container-fluid text-center">
									<div class="badge-success pt-4 pb-3" style="line-height: 20px; border-radius: 0px; background-color: #1bd741;">
										<div>
											<span class="icon-whatsapp" style="font-size: 40px;"></span>
										</div>
										<div>
											<h4 class="text-white text-center p-0 m-0">
												<strong>Whatsapp</strong>
											</h4>
										</div>
									</div>
								</div>
								<div class="text-center pt-3 mt-0">
									<h5 class="m-0 p-0 arial text-muted">Grupo de estudio en Whatsapp</h5>
								</div>
							</div>
							<hr>
							<div class="container-fluid">
								<p class="text-justify ml-md-5 mr-md-5 ml-xs-1 mr-xs-1">
									En este grupo de whatsapp podrás interactuar con tu instructor y con una comunidad de alumnos
									pertenecientes al curso, la finalidad es poder resolver cualquier tipo de duda y si lo deseas dar tus
									aportes al curso.
									<br><br>
									<b>Las normas del grupo son:</b>
									<br>
									1) No enviar cadenas ni enviar publicidad de ningún tipo.
									<br>
									2) No hablar de temas que no estén relacionados al curso.
									<br>
									En el siguiente link puedes unirte al grupo de Whatsapp del Curso &nbsp;
									<?php /*
									if ($acceso == true) {
										$whatsapp = "$datosCurso[was_tip_cur]";
										$target = "target='_blank'";
									} else {
										$target = "";
									}
									if (!empty($datosCurso["arc_tip_cur"])) {
										echo "<a href='$whatsapp' $target>
										<button class='btn btn-outline-success' style='cursor: pointer;'>
										<span class='icon-whatsapp pr-2'></span>Unirte al Grupo
										</button>
									</a>";
									}
									*/ ?>
								</p>
							</div>
						</div>
						<!--Fin de la pestaña de Whatsapp-->

						<!--Comienzo de la pestaña Clase en Vivo-->
						<div class="tab-pane fade pr-4 pl-4" id="zoom" role="tabpanel" aria-labelledby="profile-tab">
							<div>
								<div class="container-fluid text-center">
									<div class="badge-success pt-4 pb-3" style="line-height: 20px; border-radius: 0px; background-color: #3882ff;">
										<div>
											<span class="icon-play2" style="font-size: 40px;"></span>
										</div>
										<div>
											<h4 class="text-white text-center p-0 m-0 pt-1">
												<strong>Clases en Vivo</strong>
											</h4>
										</div>
									</div>
								</div>
								<div class="text-center pt-3 mt-0">
									<h5 class="m-0 p-0 arial text-muted">Clases en vivo vía Zoom con el Instructor</h5>
								</div>
							</div>
							<hr>
							<p class="text-justify ml-md-5 mr-md-5 ml-xs-1 mr-xs-1">
								Tendrás clases complementarias en vivo, en donde podrás aclarar dudas con el instructor. Estaremos
								informando en nuestro foro-chat la fecha y hora de la próxima clase en vivo. &nbsp;
							</p>
						</div>
						<!--Fin de la pestaña Clase en Vivo-->

					</div><!-- FIN de menu acordion-->
				</div>

				<!--....................................................... PARTE DERECHA DE PRECIO y CATEGORIAS..........-->



			</div>





			<br><br><br><br>

		</div>







		<!--.................................................-->

		<!--..................SLIDER 3D......................-->

		<!--.................................................-->

		<!--<?php /* //include("modal-card.php") 
				*/ ?>-->

		<!--.................................................-->

		<!--.................................................-->

		<!--.................................................-->



		<?php /* include("footer.php") */ ?>
		<!-- LOS DOS FOOTER's -->



		<!-- ------------------------- SCRIPT's -------------------------  -->



		<!-- script de Video-js-->



		<script src="../frontend/js/jqueryv3.3.1.js"></script>

		<script type="text/javascript" src="../frontend/js/js.accordeon.js"></script>

		<script src="../frontend/js/mi_js.js"></script>

		<script src="../frontend/bootstrap-4.0/js/bootstrap.bundle.min.js"></script>

		<script src="../frontend/bootstrap-4.0/js/bootstrap.min.js"></script>

		<!--<script src="shaka-player/dist/shaka-player.compiled.js"></script>  -->
		<script src="shaka-player/dist/shaka-player.ui.js"></script>
		<link rel="stylesheet" type="text/css" href="shaka-player/dist/controls.css">
		<script src="shaka-player/myapp.js"></script>

		<?php /*

		echo "<script>

				 var manifestUri = '$objVideo->ruta_video$video[url_vid]';    

			</script>";

		*/ ?>

</body>

</html>
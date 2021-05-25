<!DOCTYPE html>
<html lang='es'>

<head>

	<meta charset='UTF-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<link rel='icon' href=''>
	<link rel='stylesheet' href='estilos.css'>
	<title>Mail Form</title>

</head>

<body>

	<form action="" method="POST">
		<input type="text" placeholder="Name" name="name" require>
		<input type="email" placeholder="Email" name="email" require>
		<input type="text" placeholder="Asunto" name="asunto" require>
		<textarea placeholder="Mensaje" name="mensaje" require></textarea>
		<input type="submit" name="enviar">
	</form>

	<?php	include ("correo.php");	?>

</body>

</html>
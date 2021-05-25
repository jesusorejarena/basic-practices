<?php

if (isset($_POST["enviar"])) {

	if (!empty($_POST["name"]) && !empty($_POST["asunto"]) && !empty($_POST["mensaje"]) && !empty($_POST["email"])) {
		
		$name = $_POST["name"];
		$asunto = $_POST["asunto"];
		$mensaje = $_POST["mensaje"];
		$email = $_POST["email"];
		$header = "From: noreply@example.com" . "\r\n";
		$header .= "Reply-To: noreply@example.com" . "\r\n";
		$header .= "X-Mailer: PHP/" . phpversion();
		mail($email, $asunto, $mensaje, $header);

		if($email){
			echo "<h4>¡Mail enviado exitosamente!</h4>";
		}
	}
}

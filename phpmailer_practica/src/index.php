<?php

require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer();

$mail->isSMTP();
$mail->Host = 'smtp.mailtrap.io';
$mail->SMTPAuth = true;
$mail->Username = '18bf053833f72d';
$mail->Password = '49280c91d64e3c';
$mail->SMTPSecure = 'tls';
$mail->Port = 2525;

$mail->setFrom('cubiwelt@cubiwelt.com', 'Cubiwelt');
$mail->addAddress('jesusorejarena@gmail.com', 'Jesus');

$mail->Subject = 'Cubiwelt tiene cursos para ti';
$mail->isHTML(true);

/* $mailContent = "
		<h1>Send HTML Email using SMTP in PHP</h1>
		<p>This is a test email I’m sending using SMTP mail server with PHPMailer.</p>
	";
	
$mail->Body = $mailContent; */

// Archivo separado
$mail->msgHTML(file_get_contents('contents.html'), __DIR__);

$mail->CharSet = 'UTF-8';

if ($mail->send()) {
	echo 'El mensaje ha sido enviado';
} else {
	echo 'El mensaje no ha podido ser enviado.';
	echo 'Error de mail: ' . $mail->ErrorInfo;
}

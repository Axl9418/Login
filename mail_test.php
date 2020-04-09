<?php
	
	require '/usr/share/php/libphp-phpmailer/class.phpmailer.php';
	require '/usr/share/php/libphp-phpmailer/class.smtp.php';


	
	$mail = new PHPMailer();
	
	$mail->isSMTP();
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'tls';
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 587;
	
	$mail->Username = 'yamelsarabia@gmail.com'; 
	$mail->Password = 'jhyik20_89'; 
	
	$mail->setFrom('yamelsarabia@gmail.com', 'Emisor');
	$mail->addAddress('axlmonreal@gmail.com', 'Receptor'); 
	
	
	$mail->Subject = 'Test mail using php';
	$mail->Body    = 'Hello!';
	
	if($mail->send()) {
		echo 'Correo Enviado';
		} else {
		echo 'Error al enviar correo';
	}
?>
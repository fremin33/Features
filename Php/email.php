<?php
	// Header configuration
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf8' . "\r\n";
	$headers .= 'From: Florian Fremin<florian@definima.com>' . "\r\n";

	$to = 'florian@definima.com';	

	// Get form values
	$nom = htmlentities($_POST['name']);
	$email = htmlentities($_POST['email']);
	$object = htmlentities($_POST['object']);
	$message = htmlentities($_POST['message']);

	$subject = 'Demande de contact' ;
	$message = 'Bonjour,<br><br>Vous avez reçu une demande de contact:<br>
	De la part de : <strong>'.$nom.'<br></strong>
	Email: <strong>'.$email.'</strong><br>
	Objet : <strong>' .$object . '</strong><br>
	Message : <br><br>' . $message;

mail($to, $subject, $message, $headers) ;


header('Location: http://mywebsite.com/');



<?php

require 'conection.php';
require 'functions.php';

if (isset($_POST['data'])) {

	//Get json values
	$obj = json_decode( $_POST['data']);

	$id = $obj->{'userId'};
	$username = $obj->{'user'};
	$email = $obj->{'mail'};


	//Generate new token
	$newtoken = newToken();

	//Update new token generated on BD
	updateToken($newtoken,$id);

	$url = 'http://'.$_SERVER["SERVER_NAME"].'/Portfolio/Login/activate.php?id='.$id.'&val='.$newtoken;
	$subject = 'Email confirmation';
	$body = "To finish your register, please press the following link <a href='$url'>Activate Account</a>";

		//Sending again email
		if(sendEmail($email,$username, $subject, $body);){

			echo true;

		}
	
				
}


?>
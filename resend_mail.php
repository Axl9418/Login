<?php


//print_r(json_decode($_POST['userData']));

print_r($_POST['data'] -> userId);


//Sending again email

/*
require 'functions.php';


if (isset($_POST['userId'])) {
			
	$id = $_POST['userId'];

	//Generate new token
	$newtoken = newToken();

	//Update new token generated on BD
	updateToken($newtoken,$id);

	$url = 'http://'.$_SERVER["SERVER_NAME"].'/Portfolio/Login/activate.php?id='.$id.'&val='.$newtoken;
	$subject = 'Email confirmation';
	$body = "To finish your register, please press the following link <a href='$url'>Activate Account</a>";

	sendEmail($email,$username, $subject, $body);
				
}
*/

?>
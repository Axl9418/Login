<?php
	require 'conection.php';
	require 'functions.php';
	
	$user_id = $mysqli->real_escape_string($_POST['user_id']);
	$token = $mysqli->real_escape_string($_POST['token']);
	$password = $mysqli->real_escape_string($_POST['password']);
	$con_password = $mysqli->real_escape_string($_POST['con_password']);
	
	if(validatePassword($password, $con_password)){
		
		$pass_hash = hashPassword($password);
		
		if(restorePassword($pass_hash, $user_id, $token)){
			echo "Password changed successfully <br> <a href='login.html' >Login</a>";
		}
		else {
			echo "Error to try to restore password!";
		}
	}
	else{
		echo 'Please verify your password.';
	}
?>
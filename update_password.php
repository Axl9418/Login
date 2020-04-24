<?php
	require 'conection.php';
	require 'functions.php';


	if(!isset($_POST["user_id"]) && !isset($_POST['user_token']) && !isset($_POST['password']) && !isset($_POST['con_password'])){
		header('Location: login.html');
	}
	else{
		

	$msg = '';
	

		$user_id = $mysqli->real_escape_string($_POST['user_id']);
		$token = $mysqli->real_escape_string($_POST['user_token']);
		$password = $mysqli->real_escape_string($_POST['password']);
		$con_password = $mysqli->real_escape_string($_POST['con_password']);

		if($user_id != 0 && $token != 0){

		
			if(!validateTokenPass($user_id, $token)){
				$msg = "We cannot validate data! <br> <a href='forgot_password.html' >Try again</a>";		
			}
			else{

					if(validatePassword($password, $con_password)){
						
						$pass_hash = hashPassword($password);
						
						if(restorePassword($pass_hash, $user_id, $token)){
							$msg = "Password changed successfully <br> <a href='login.html' >Login</a>";
						}
						else {
							$msg = "Error to try to restore password!";
						}
					}
					else{
						$msg = 'Please verify your password.';
					}

			}

		}
		else{
			$msg = false;
		}

		echo $msg;

	}

	
?>
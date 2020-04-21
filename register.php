<?php
	require 'conection.php';
	require 'functions.php';
	
	$msg = "";
	$errors = array();
	
	if(!empty($_POST)){
		$username = $mysqli->real_escape_string($_POST['username']);
		$password = $mysqli->real_escape_string($_POST['password']);
		$con_password = $mysqli->real_escape_string($_POST['con_password']);
		$email = $mysqli->real_escape_string($_POST['email']);
		// 1=Active,0=Inactive
		$status = 0;
		/*
		//Validate inputs
		if(isEmpty($username,$email,$password,$con_password)){
			$errors[] = "Please, fill all the fields";
		}

		if(!isEmail($email)){
			$errors[] = "This email is invalid!";
		}

		if(!validatePassword($password, $con_password)){

			$errors[] = "Passwords do not match!, please check again.";

		}
	
		//Validate if the email adress already exists in the database.
		if(existsUser($email) > 0){
			$errors[] = "The email: $email has already used in other register, please use another emai";
		}
		*/
	
		if(count($errors) == 0){
			$pass_hash = hashPassword($password);
			$token = newToken();
			
			$register = newUser($username, $pass_hash, $email, $status, $token);			

			if($register > 0){				
				$url = 'http://'.$_SERVER["SERVER_NAME"].'/Portfolio/Login/activate.php?id='.$register.'&val='.$token;
				
				$subject = 'Email confirmation';
				$body = "To finish your register, please press the following link <a href='$url'>Activate Account</a>";
				
				if(sendEmail($email,$username, $subject, $body)){
					
					echo "To finish your register, follow the instructions sended to your email address: $email";	
								
					
					} else {
					$errors[] = "Error to send email";
						
				}
				
				} else {
				$errors[] = "Error to register";
						
			}
				
				
		}
		
	}

	//echo json_encode($errors);
	
?>


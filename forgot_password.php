<?php
	require 'conection.php';
	require 'functions.php';
	
	$errors = array();
	
	if(!empty($_POST)){

		$email = $mysqli->real_escape_string($_POST['email']);
		
		if(!isEmail($email)){
			$errors[] = "Please enter an email valid!";
		}
		
		$id = existsUser($email);
		$username = "";

		if($id > 0){			
					
			$token = newTokenPass($id);
			
			$url = 'http://'.$_SERVER["SERVER_NAME"].'/Portfolio/Login/restore_password.php?id='.$id.'&token='.$token;
			
			$subject = 'Restore Password';
			$body = "To restore your password, please press the following link: <a href='$url'>Restore Password</a>";
			
				if(sendEmail($email,$username, $subject, $body)){
					echo "We have sent you an email to restore your password.";
					//echo "<a href='login.html' >Login</a>";				
				}

			} 
			else {
				//$errors[] = "You are not a member yet. Please join us here:";
				echo "You are not a member yet. Please join us here:";
			}
	}

?>
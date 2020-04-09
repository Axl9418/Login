<?php

  function displayErrors($errors){
		if(count($errors) > 0)
		{
			echo "<div id='error'>
			<a href='#' onclick=\"showHide('error');\"></a>
			<ul>";
			foreach($errors as $error)
			{
				echo "<li>".$error."</li>";
			}
			echo "</ul>";
			echo "</div>";
		}
	}
	
   //Validate empty inputs
  function isEmpty($username,$email,$password,$con_password){

	  	if(empty($_POST['username'])||empty($_POST['email'])||empty($_POST['password'])
	  		||empty($_POST['con_password'])){
	  			return true;
				} 
				else {
				return false;
	  	}
  }

   //validate that email is valid
  function isEmail($email)
	{
		$sanitized = filter_var($email, FILTER_SANITIZE_EMAIL);
		if ($email === $sanitized &&filter_var($email, FILTER_VALIDATE_EMAIL)){
			return true;
			} 
			else {
			return false;
		}
	}

	//Validate that both password are equals
	function validatePassword($password, $con_password)
	{
		if (strcmp($password, $con_password) !== 0){
			return false;
			} 
			else {
			return true;
		}
	}

	//Check if the email exist in the database
	function existsUser($email){
		global $mysqli;
		
		$query = $mysqli->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");
		$query->bind_param("s", $email);
		$query->execute();
		$query->store_result();
		$num = $query->num_rows;
		$query->close();
		
		if ($num > 0){
			return true;
			} else {
			return false;
		}
	}

	//Generate a random token
	function newToken(){
		$random = md5(uniqid(mt_rand(), false));	
		return $random;
	}
	
	//Encritp a password for securiry
	function hashPassword($password) {
		$hash = password_hash($password, PASSWORD_BCRYPT);
		return $hash;
	}
	
	//Insert a new user into database users.
	function newUser($username, $pass_hash, $email, $status, $token){
		
		global $mysqli;
		
		$query = $mysqli->prepare("INSERT INTO users (username, password, email, status, token) VALUES(?,?,?,?,?)");
		$query->bind_param('sssss', $username, $pass_hash, $email, $status, $token);
		
		if ($query->execute()){
			return $mysqli->insert_id;
		} 
		else {
			return 0;	
		}		
	}
	
	//Send email to user to finish the register
	function sendEmail($email,$username, $subject, $body){
		
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
		
		$mail->setFrom('yamelsarabia@gmail.com', 'Bastardos'); 
		$mail->addAddress($email, $username);
		
		$mail->Subject = $subject;
		$mail->Body    = $body;
		$mail->IsHTML(true);
		
		if($mail->send())
			return true;
		else
			return false;
	}

	//Validate that token and id storage in BD is the same that user receive by email. 
	function validateToken($id, $token){
		global $mysqli;
		
		$query = $mysqli->prepare("SELECT status FROM users WHERE id = ? AND token = ? LIMIT 1");
		$query->bind_param("ss", $id, $token);
		$query->execute();
		$query->store_result();
		$rows = $query->num_rows;
		
		if($rows > 0) {
			$query->bind_result($status);
			$query->fetch();
			
			if($status == 1){
				$msg = "This account has been already activated previously.";
				}
		    else {
				if(activateUser($id)){
					$msg = 'Account activated successfully!';
				} 
				else {
					$msg = 'Error to activate account.';
				}
			}
		} 
		return $msg;
	}

	//Change the status value from 0 to 1 
	function activateUser($id)
	{
		global $mysqli;
		
		$query = $mysqli->prepare("UPDATE users SET status=1 WHERE id = ?");
		$query->bind_param('s', $id);
		$result = $query->execute();
		$query->close();
		return $result;
	}
		
?>
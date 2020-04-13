<?php
	
	//validate emty form login
	function nullLogin($username, $password){
		if(strlen(trim($username)) < 1 || strlen(trim($password)) < 1){
			return true;
		}
		else{
			return false;
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


	//LOGIN VALIDATION
	function checkLogin($username, $password){
		global $mysqli;
		
		$query = $mysqli->prepare("SELECT id, password, status, token, email, username FROM users WHERE username = ? || email = ? LIMIT 1");
		$query->bind_param("ss", $username, $username);
		$query->execute();
		$query->store_result();
		$rows = $query->num_rows;

		$query->bind_result($id, $db_password, $status, $token, $email, $username);
		$query->fetch();
		
		if($rows > 0) {
			
			if($status == 1){
				
					$validPassw = password_verify($password, $db_password);
				
					if($validPassw){
						lastSession($id);
						$_SESSION['userId'] = $id;
						
						header("location: main.php");
					} 
					else {
						$msg = "Wrong password!";
					}
			}
			else {
				$msg = 'Please check your inbox to finish your register
			 or <a id="mailto" href="#" onclick="newEmail("'.$id.'");">send again</a> to receive a new email with the instructions.';
				//Sending again email
				//Generate new token
			 /*
				$newtoken = newToken();

				//Update new token generated on BD
				updateToken($newtoken,$id);

				$url = 'http://'.$_SERVER["SERVER_NAME"].'/Portfolio/Login/activate.php?id='.$id.'&val='.$newtoken;
				$subject = 'Email confirmation';
				$body = "To finish your register, please press the following link <a href='$url'>Activate Account</a>";

				sendEmail($email,$username, $subject, $body);
				*/
			}
		}
		else {
			$msg = "Username or Password does not exists!";			
		}
			//return $msg;
			echo $msg;
			//echo json_encode($msg);
	}

	//Update new token generated on BD
	function updateToken($newtoken,$id)
	{
		global $mysqli;
		
		$query = $mysqli->prepare("UPDATE users SET token= $newtoken WHERE id = ?");
		$query->bind_param('s', $id);
		$query->execute();
		$query->close();
	}	

	//Update date of last session success from user
	function lastSession($id)
	{
		global $mysqli;
		
		$query = $mysqli->prepare("UPDATE users SET last_session=NOW(), token_password='', password_request=1 WHERE id = ?");
		$query->bind_param('s', $id);
		$query->execute();
		$query->close();
	}
		
?>
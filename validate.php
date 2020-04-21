<?php
	require 'conection.php';
	require 'functions.php';

	session_start();
	
	if(empty($_GET['id'])){
		header('Location: login.html');
	}
	
	if(empty($_GET['token'])){
		header('Location: login.html');
	}
	
	$id = $mysqli->real_escape_string($_GET['id']);
	$token = $mysqli->real_escape_string($_GET['token']);
	
	if(!validateTokenPass($id, $token)){
		$msg = 'We cannot validate data!';		
		$error = 1;
	} 
	else{ $msg = 'Success!';
		  $error = 0; 
		}
?>

<html>
	<head>
		<title>Password</title>	

	</head>
	
	<body>
		<div>
			<div>
				
				<h1><?php echo "$msg"; ?></h1>
				<?php if($error > 0){ ?>

					<meta http-equiv="Refresh" content="4;url=http://localhost/Portfolio/Login/login.html">

				<?php } else { ?>

					<meta http-equiv="Refresh" content="4;url=http://localhost/Portfolio/Login/restore_password.html">

				<?php }  ?>
			</div>
		</div>
	</body>
</html>


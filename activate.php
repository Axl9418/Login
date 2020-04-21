<?php
	require 'conection.php';
	require 'functions.php';
	
	if(isset($_GET["id"]) AND isset($_GET['val']))
	{	
		$id = $_GET['id'];
		$token = $_GET['val'];
	
		$msg = validateToken($id, $token);
	}
?>
<html>
	<head>
		<title>Register</title>	

	</head>
	
	<body>
		<div>
			<div>
				
				<h1><?php echo $msg; ?></h1>
				<meta http-equiv="Refresh" content="4;url=http://localhost/Portfolio/Login/login.html">
			</div>
		</div>
	</body>
</html>
<?php

	session_start();

	require 'conection.php';
	require 'functions.php';
	
	if(!isset($_SESSION["userId"])){ 
		header("Location: login.html");
	}
	else{

		$userId = $_SESSION['userId'];

		isLogged($userId);

	}
	
	echo '<a href=logout.php>Logout</a>'
	
?>
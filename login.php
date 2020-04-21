<?php

	require 'conection.php';
	require 'functions.php';

	session_start(); //Start a new session or restart
	
	if(isset($_SESSION["userId"])){ 
		//header("Location: main.php");
	}

	$errors = array();
	
	if(!empty($_POST)){
		$username = $mysqli->real_escape_string($_POST['username']);
		$password = $mysqli->real_escape_string($_POST['password']);
		
		if(nullLogin($username, $password)){
			$errors[] = "Please, complete the form!";
		}
		
		if(count($errors) == 0){
			checkLogin($username, $password);	
		}
	}

?>
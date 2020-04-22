<?php
	require 'conection.php';
	require 'functions.php';

	session_start();

	$errors = array();
	
	if(empty($_GET['id']) || empty($_GET['token'])){
		header('Location: login.html');
	}
		
	$id = $mysqli->real_escape_string($_GET['id']);
	$token = $mysqli->real_escape_string($_GET['token']);
	
	if(!validateTokenPass($id, $token)){
		$errors = 'We cannot validate data!';		
	} 
	
?>


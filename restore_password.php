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



<!DOCTYPE html>
<html>
<head>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<title>restore password</title>

	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

	<!--validate-->
	<script language="javascript" type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.min.js"></script>

	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="test.css">

	<script src="restore_password.js"></script>



	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>	

	

</head>
<body>
<div>
	
	<div class="main">

		<div class="header">
		<h2>Restore my password</h2>
	</div>

	<form id="restore_pass" class="modal-content animate" method="post" autocomplete="off">
		<div class="imgcontainer">	      
	      <img src="user.png" alt="Avatar" class="avatar">
	    </div>

	    <div class="align-items-login">
	    	<input id="password" class="input-style" type="password" placeholder="Enter password" name="password">
	    </div>

	    <div class="align-items-login">
	    	 <input id="con_password" class="input-style" type="password" placeholder="Confirm your password" name="con_password">
	    </div>


	    <div class="align-items-login">
	    	<button id="update" type="button" name="update" class="button" onclick="restore_pass(<?php echo $id ?>)">Update</button>
	    </div>


	    <!-- Modal -->
		<div class="modal fade" id="dialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      <div class="modal-header modal-color modal-font-style">
		        <h5 class="modal-title" id="exampleModalLabel">Ups!</h5>
		        <button type="button" class="close modal-font-style" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div id="msg" class="modal-body">
		        
		      </div>
		      <div class="modal-footer dialog-footer">
		        <button type="button" class="btn button-modal modal-color modal-font-style" data-dismiss="modal">OK</button>
		      </div>
		    </div>
		  </div>
		</div>



	    <div class="align-items-login">
	     	<a href="login.html">I have an account</a> 
	 	</div>

	    <p class="align-sing-up">
	    	Not yet a member? <a href="register.html">Sig up</a>
	    </p>
			
	</form>

	</div>

</div>
	

</body>
</html>

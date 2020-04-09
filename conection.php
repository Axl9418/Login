<?php

	$mysqli=new mysqli("localhost","root","","users_login"); 

	if(mysqli_connect_errno()){
		echo 'Conection Fail!: ', mysqli_connect_error();
		exit();
	}

?>
<!DOCTYPE html>
<html>
<head>

	<title>login</title>
	<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
<div>
	
	<div class="main">

		<div class="header">
		<h2>My account</h2>
	</div>

	<form class="modal-content animate" method="post" action="login.php" autocomplete="off">
		<div class="imgcontainer">	      
	      <img src="user.png" alt="Avatar" class="avatar">
	    </div>

	    <div class="align-items-login">
	      <label for="username"><b>Username</b></label>
	      <input class="input-style" type="text" placeholder="Enter Username" name="username" required>
	    </div>

	    <div class="align-items-login">
	      <label for="password"><b>Password</b></label>
	      <input class="input-style" type="password" placeholder="Enter Password" name="password" required>
	    </div>

	    <div class="align-items-login">
	    	<button type="submit" name="login" class="button">Login</button>
	    </div>

	    <div class="align-items-login">or <a href="forgot_password.php">forgot password</a> </div>

	    <p class="align-sing-up">
	    	Not yet a member? <a href="register.php">Sig up</a>
	    </p>
			
	</form>

	</div>

</div>
	

</body>
</html>

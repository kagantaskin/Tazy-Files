<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="style/images/favicon.ico">
	<link rel="stylesheet" type="text/css" href="style/style.css">
	<meta charset="utf-8">
	<title></title>
</head>
<body>

	<div class="header">
		<ul>
			<li><img src="uploads/gangstazy/TazyFiles.png"></li>
		</ul>
	</div>

	<?php /*include 'header.html';*/ include 'functions.php';  ?>

	<div id="container">
		<center>
			<div id="LoginHeader">
				<div id="loginraid">
					<div id="logo">
						<img style="margin-top: 2.5%; border: 1.5px outset #F7AA35; border-radius: 20%;" src="style/images/TazyFiles.png" width="150" height="150">
					</div>
				</div>
			</div>
		</center>

		<div class="userFirstButtons">
			<form method="POST">
						<input style="width: 50%;" type="text" name="uRegisterName" placeholder="Username"><br>
						<input style="width: 50%;" type="text" name="uRegisterFullName" placeholder="Full Name" ><br>
						<input style="width: 50%;" type="email" name="uRegisterEMail" placeholder="E-mail" ><br>
						<input style="width: 50%;" type="password" name="uRegisterPass" placeholder="Password" ><br>
						<input style="width: 50%;" type="submit" name="uRegister" value="Register"><br>
						<a style="text-decoration: none;" href="index.php">Already have an Account? Sign In.</font></a>
			</form>
		</div>
	</div>

<!--
	<div class="userFirstButtons">
		<form style="margin-top: 6%;" method="POST">
			<p style="border-bottom: 1.5px inset #F7AA35">Login</p>
			<input type="text" name="uLoginName" placeholder="Username"><br>
			<input type="password" name="uLoginPass" placeholder="Password"><br>
			<input type="submit" name="uLogin" value="Login">
		</form>

	<form method="POST">
		<p style="border-bottom: 1.5px inset #F7AA35">Register</p>
		<input type="text" name="uRegisterName" placeholder="Username"><br>
		<input type="text" name="uRegisterFullName" placeholder="Full Name"><br>
		<input type="password" name="uRegisterPass" placeholder="Password"><br>
		<input type="submit" name="uRegister" value="Register">
	</form>

	</div>
-->
	<?php

	if (isset($_POST['uLogin'])) {

		userLogin();

	}elseif (isset($_POST['uRegister'])) {

		userRegister();

	}

	?>

</body>
</html>
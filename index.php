<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="style/images/favicon.ico">
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style/style.css">
	<title>Tazy Files</title>
</head>
<body>


	<div class="formInput">
		<form method="POST">
			<p>Login</p>
			<input type="text" name="uLoginName" placeholder="Username">
			<input type="password" name="uLoginPass" placeholder="password">
			<input type="submit" name="uLogin" value="Login">
		</form>
	</div>

	<?php

	session_start();

	require 'db_connection.php';

	if (!isset($_POST['uLoginName']) && !isset($_POST['uLoginPass'])) {
		echo "Please fill in the Form.";
	}else{

		$userLoginName = $_POST['uLoginName'];
		$userLoginPass = $_POST['uLoginPass'];
		$userLoginEncryptedPass = md5($_POST['uLoginPass']);

		$checkUser = "SELECT * FROM users WHERE username = '".$userLoginName."' AND password = '".$userLoginEncryptedPass."'";

		$checkResult = mysqli_query($con, $checkUser) or die(mysqli_error($con));

		$countResult = mysqli_num_rows($checkResult);

		if ($countResult == 1) {
			while ($row = mysqli_fetch_assoc($checkResult)) {

			$_SESSION['uNameSession'] = $row['name'];
			$_SESSION['uFileNameSession'] = $row['username'];
			header('Location: homepage.php');
			exit();

			}

		}else{

			echo "Can't Logged In.";

		}
	}


	?>

	<form method="POST">
		<p>Register</p>
		<input type="text" name="uRegisterName" placeholder="Username">
		<input type="text" name="uRegisterFullName" placeholder="Full Name">
		<input type="password" name="uRegisterPass" placeholder="Password">
		<input type="submit" name="uRegister" value="Register">
	</form>

	<?php

	if (!isset($_POST['uRegisterName']) && !isset($_POST['uRegisterFullName']) && !isset($_POST['uRegisterPass'])) {
		echo "Please fill in the Form.";
	}else{

		$userRegisterName = $_POST['uRegisterName'];
		$userRegisterFullName = $_POST['uRegisterFullName'];
		$userRegisterPass = $_POST['uRegisterPass'];
		$userRegisterEncryptedPass = md5($_POST['uRegisterPass']);

		$insertUser = "INSERT INTO users (name, username, password, fileName) VALUES ('$userRegisterFullName', '$userRegisterName', '$userRegisterEncryptedPass', '$userRegisterName')";

		mysqli_query($con, $insertUser);

		mkdir('uploads/'.$userRegisterName.'/', 0700);

		echo "User Registered Succesfully";

	}

	mysqli_close($con);


	?>

</body>
</html>
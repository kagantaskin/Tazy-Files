<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="style/images/favicon.ico">
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style/style.css">
	<title>Tazy Files</title>
</head>
<body>

	<?php include 'header.php'; ?>

	<center>
	<div style="font-family: Corbel; margin-top: 7%;" class="formInput">
		<span>Your file name is <?php echo $_SESSION['uFileNameSession']; ?></span><br>

		<div class="userProfileButtons">
			<a href="#">User Settings</a>
			<a href="logout.php">Logout</a>
		</div>

		<form style="margin-top: 1.5%;" action="upload.php" method="POST"  enctype="multipart/form-data">
			<div style="border-bottom: 1px solid black; width: 350px;">
			<input type="hidden" name="MAX_FILE_SIZE" value="1000000">
			<input type="file" name="fileToUpload" id="fileToUpload">
			<input type="submit" name="submitFile" value="Upload">
			</div>
		</form>


	</div>

	<?php

		include 'functions.php';

		dataToTables();

	?>

</center>

</body>
</html>
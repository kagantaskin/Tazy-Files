<link rel="stylesheet" type="text/css" href="style/style.css">

<?php

	include 'functions.php';
	require 'db_connection.php';

	$fileOwner = $_SESSION['uFileNameSession'];

	$uploadLocation = 'uploads/'.$fileOwner.'/';
	$uploadFile = $uploadLocation . basename($_FILES["fileToUpload"]["name"]);

	echo "<pre>";

	if (file_exists($uploadFile)) {

		fileExists();

	}else{

		uploadFiles();

			$fileName = $_FILES['fileToUpload']['name'];
			$fileType = $_FILES['fileToUpload']['type'];
			$fileSize = $_FILES['fileToUpload']['size'];

			$insertFile = "INSERT INTO userfiles (fileOwner, fileName, fileType, fileSize) VALUES ('$fileOwner', '$fileName', '$fileType', '$fileSize')";

			mysqli_query($con, $insertFile);


	}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<center><a href="homepage.php">Ana Sayfa</a></center>

</body>
</html>
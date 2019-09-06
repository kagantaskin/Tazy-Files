<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style/style.css">
	<title></title>
</head>
<body>


	<div style="font-family: Corbel" class="formInput">
		<form action="upload.php" method="POST"  enctype="multipart/form-data">
			<span> Welcome, <?php session_start(); echo $_SESSION['uNameSession']; ?></span> <br>
			<span>Your file name is <?php echo $_SESSION['uFileNameSession']; ?></span><br>
			<input type="hidden" name="MAX_FILE_SIZE" value="1000000">
			<input type="file" name="fileToUpload" id="fileToUpload">
			<input type="submit" name="submitFile" value="Upload">
		</form>

		<a href="logout.php">Logout</a>

	</div>

	<?php

		$fileOwner = $_SESSION['uFileNameSession'];

		require 'db_connection.php';

		$selectFiles = "SELECT * FROM userfiles WHERE fileOwner = '".$fileOwner."'";

		$checkFiles = mysqli_query($con, $selectFiles);

		$resultCheck = mysqli_num_rows($checkFiles);

		if ($resultCheck > 0) {
				echo "<div style='font-family: Corbel'>";
				echo "<br>";
				echo "Your Files Listed Here";
				echo "<br>";
			while ($row = mysqli_fetch_assoc($checkFiles)) {
				echo "File Name: " . $row['fileName'] . " | File Type: " . $row['fileType'] . " | File Size: " . $row['fileSize'] . "<br>";
			}
			echo "</div>";
		}

	?>

</body>
</html>
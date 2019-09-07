<!--<head><link rel="stylesheet" type="text/css" href="style/style.css"></head>-->

<?php


function userLogin(){

	session_start();

	include 'db_connection.php';

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
	mysqli_close($con);
}

function userRegister(){

include 'db_connection.php';

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

}

function fileImage(){

	echo "<div class=filesystem>";
	echo "<div class=imagebox>";
	if ($_FILES['fileToUpload']['type'] == "text/plain") {
		echo "<img src='images/folder.svg'>";
		echo "<div class='imagetext'>";
		echo "TXT";
		echo "</div>";
	}elseif ($_FILES['fileToUpload']['type'] == "application/octet-stream") {
		echo "<img src='images/folder.svg'>";
		echo "<div class='imagetext'>";
		echo "DOC";
		echo "</div>";
	}elseif ($_FILES['fileToUpload']['type'] == "image/jpeg") {
		echo "<img src='images/folder.svg'>";
		echo "<div class='imagetext'>";
		echo "JPG";
		echo "</div>";
	}
	
	echo "</div>\n";

}

function fileExists(){

	fileImage();

	echo "Dosya zaten var, yüklenemedi.\n";
	echo "Dosya Adı : " . $_FILES['fileToUpload']['name'] . "\n";
	echo "Dosya Tipi : " . $_FILES['fileToUpload']['type'] . "\n";
	echo "Dosya Boyutu : " . ($_FILES['fileToUpload']['size'] / 1024) . " Kb\n";
	echo "</div>";

}

function uploadFiles(){
//session_start();


	if (isset($_POST['submitFile'])) {

		date_default_timezone_set("Europe/Istanbul");

		$fileOwner = $_SESSION['uFileNameSession'];

		$uploadLocation = 'uploads/'.$fileOwner.'/';
		$uploadFile = $uploadLocation . basename($_FILES["fileToUpload"]["name"]);

		$imageFileType = strtolower(pathinfo($uploadFile,PATHINFO_EXTENSION));
		
		if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $uploadFile)) {

			fileImage();

			echo "File Uploaded Succesfully.\n";
			echo "File Name : " . $_FILES['fileToUpload']['name'] . "\n";
			echo "File Type : " . $_FILES['fileToUpload']['type'] . "\n";
			echo "File Size : " . ($_FILES['fileToUpload']['size'] / 1024) . " Kb\n";
			echo "<a href=". $uploadLocation . $_FILES['fileToUpload']['name']. ">Go To File</a>";
			echo "</div>";




		} else {
			print_r($_FILES['fileToUpload']);
			//echo ($_FILES['fileToUpload']['error']);
		}
		
	}
}

function dataToTables(){

		$fileOwner = $_SESSION['uFileNameSession'];

		require 'db_connection.php';

		$selectFiles = "SELECT fileName, fileType, fileSize FROM userfiles WHERE fileOwner = '".$fileOwner."'";

		$checkFiles = mysqli_query($con, $selectFiles);

		$resultCheck = mysqli_num_rows($checkFiles);

		if ($resultCheck > 0) {

			echo '<table  style="margin-top: 1%;" cellpadding="0" cellspacing="0" class="db-table">';
			echo '<tr><th>File Name</th><th>File Type</th><th>File Size</th><th width="10px">Settings</th></tr>';

			while ($row = mysqli_fetch_assoc($checkFiles)) {

				echo '<tr>';

				echo '<td>' . $row['fileName'] . '</td>';
				echo '<td>' . $row['fileType'] . '</td>';
				echo '<td>' . $row['fileSize'] . '</td>';
				echo '<td class="settingsButton">' . "<img style='width: 50%' src='style/images/settings.svg'>" . '</td>';

				echo '</tr>';

				/*echo "<div style='font-family: Corbel; border-bottom: 1px solid black; width: 700px; margin-top: 1%;'>" . "File Name: " . $row['fileName'] . " | File Type: " . $row['fileType'] . " | File Size: " . $row['fileSize'] . "</div><br>";*/

			}
			echo '</table><br />';
		}
}


?>
<?php

session_start();

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



	if (isset($_POST['submitFile'])) {

		date_default_timezone_set("Europe/Istanbul");

		$fileOwner = $_SESSION['uFileNameSession'];

		$uploadLocation = 'uploads/'.$fileOwner.'/';
		$uploadFile = $uploadLocation . basename($_FILES["fileToUpload"]["name"]);

		$imageFileType = strtolower(pathinfo($uploadFile,PATHINFO_EXTENSION));
		
		if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $uploadFile)) {

			fileImage();

			echo "Dosya başarıyla yüklendi.\n";
			echo "Dosya Adı : " . $_FILES['fileToUpload']['name'] . "\n";
			echo "Dosya Tipi : " . $_FILES['fileToUpload']['type'] . "\n";
			echo "Dosya Boyutu : " . ($_FILES['fileToUpload']['size'] / 1024) . " Kb\n";
			echo "</div>";



		} else {
			print_r($_FILES['fileToUpload']);
			//echo ($_FILES['fileToUpload']['error']);
		}
		
	}
}



?>
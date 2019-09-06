<?php

function OpenCon(){

	$Server = "localhost";
	$ServerUsername = "root";
	$ServerPass = "";
	$dbName = "TazyFiles";

	$con = new mysqli($Server, $ServerUsername, $ServerPass, $dbName) or die(mysqli_error($con));

	mysqli_query($con, "SET NAMES UTF8");

	return $con;

}

function CloseCon($con){
	mysqli_close($con);
}

$con = OpenCon();

?>
<?php
/* 
Name: connect.php
Programmer: William Tippet
*/


$username = "cody";
$password = "marley";
$db= "Bayside";

// Address error handling
ini_set('display_errors',1);
error_reporting(E_ALL & ~E_NOTICE);

//Attempt to Connect
$connection = mysqli_connect ("localhost", $username, $password, $db);
if (mysqli_connect_errno()){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
else {
	echo "Connected to $db";
}
mysqli_select_db($connection, $db);



?>

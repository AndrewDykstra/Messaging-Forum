<?php
//See original: https://www.w3schools.com/php/php_mysql_connect.asp
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "chatlog";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
	
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$user = $_GET["username"];
	$password = $_GET["pass"];
	$email = $_GET["email"];
	$firstName = $_GET["firstname"];
	$lastName = $_GET["lastname"];
	
	$sqlToRunThingsHaHa = "INSERT INTO users ".
		"(username, password, email, firstName, lastName) VALUES ".
		"('$user', '$password', '$email', '$firstName', '$lastName')";
		
	$conn->exec( $sqlToRunThingsHaHa );
	
	print "New user added!";
	
	$newUserID = $conn->lastInsertID();
	
	print "New ID #: $newUserID";
}

catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

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
	
	$to = explode(",",$_GET["to"]);
	$from = $_GET["from"];
	$subject = $_GET["subject"];
	$body = $_GET["body"];

	$fromUsers = $conn-> query("SELECT * FROM users WHERE username = '$from'");
	$fromUser = $fromUsers -> fetch();
	$fromUserID = $fromUser["userID"];
	
	
	$insertContent = "INSERT INTO messages (subject, body, fromUserID) VALUES ('$subject', '$body', $fromUserID)";
	$statement1 = $conn -> exec($insertContent);
	
	$messageID = $conn -> lastInsertID(); 
	
	foreach($to as $tempName){
	$toUsers = $conn -> query("SELECT * FROM users WHERE username = '$tempName'");
	$toUser = $toUsers -> fetch();
	$toUserID = $toUser["userID"];
	$insertMessageRecipients = "INSERT INTO messagerecipients (messageID, toUserID) VALUES ($messageID, $toUserID)";
	$statement2 = $conn -> exec($insertMessageRecipients);
	}
	
	echo "message has been sent";
	}

catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
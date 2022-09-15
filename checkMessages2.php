<?php
//See original: https://www.w3schools.com/php/php_mysql_connect.asp
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "chatLog";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);

  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $user = $_GET["username"];

  $getMessages = "SELECT username, subject, body FROM users, messages, messageRecipients WHERE messageRecipients.toUserID = users.userID 
	AND messages.messageID = messageRecipients.messageID 
	AND username = '$user'";

  $statement = $conn -> query($getMessages);

  //print "<style> table, th, td {border: 1px solid black;} </style>";
  print "<table><tr><th>Subject</th><th>Body</th></tr>";

  foreach ($statement as $row) {
    print "<tr>";
    print "<td>" .  $row['subject'] .  "</td>";
    print "<td>" .  $row['body'] .  "</td>";
    print "</tr>";
  }
  print "</table>";

}
catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>
	
<?php

if (isset($_GET['comicid']) && isset($_GET['comment'])){
    $comicid = htmlspecialchars(filter_var($_GET['comicid'], FILTER_SANITIZE_STRING), );
    $comment = substr(htmlspecialchars(filter_var($_GET['comment'], FILTER_SANITIZE_STRING), ENT_QUOTES, 'UTF-8'), 0, 99);
    $servername = "localhost";
$username = "comrate";
$password = "Q1234567890";
$dbname = "comrate";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo $comicid;
$query = $conn->prepare("Insert into comments (comicid, comments) Values (?, ?)");
$query->bind_param("ss", $comicid, $comment);
// echo $query;
if ($query->execute() === TRUE) {
    // echo "New record created successfully";
  } else {
    // echo "Error: " . $sql . "<br>" . $conn->error;
  }
}





?>
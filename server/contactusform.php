<?php

if (isset($_GET['name']) && isset($_GET['email']) && isset($_GET['reason']) && isset($_GET['message'])) {
  $name = htmlspecialchars(filter_var($_GET['name'], FILTER_SANITIZE_STRING));
  $email = htmlspecialchars(filter_var($_GET['email'], FILTER_SANITIZE_STRING));
  $reason = htmlspecialchars(filter_var($_GET['reason'], FILTER_SANITIZE_STRING));
  $message = htmlspecialchars(filter_var($_GET['message'], FILTER_SANITIZE_STRING));
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "comrate";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  echo $_SERVER['REMOTE_ADDR'];
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  // echo $comicid;
  $query = "Insert into contactus (name, email, reason, message) Values ('" . $name  . "','" . $email ."', '". $reason ."', '". $message ."' )";
  echo $query;
  // echo $query;
  if ($conn->query($query) === TRUE) {
    echo "message added successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
?>
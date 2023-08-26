<?php

if (isset($_GET['comicid']) && isset($_GET['rating'])) {
  $comicid = htmlspecialchars(filter_var($_GET['comicid'], FILTER_SANITIZE_STRING));
  $rating = htmlspecialchars(filter_var($_GET['rating'], FILTER_SANITIZE_STRING));
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "comrate";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  // echo $comicid;
  $query = "update comics_list set userrating = " . $rating . " where comicid = " . $comicid;
  // echo $query;
  if ($conn->query($query) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
?>
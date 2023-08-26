<?php
// Connect to the MySQL database
$servername = "localhost";
$username = "comrate";
$password = "Q1234567890";
$dbname = "comrate";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Retrieve JSON data from the TMDb API
$json_data = file_get_contents("https://api.themoviedb.org/3/discover/movie?api_key=0a62787a9abad7c433287d227c84c3a8&with_genres=35&certification_country=US&certification=R&vote_count.gte=1000&page=1&include_adult=true");

// Convert JSON data to PHP array
$data = json_decode($json_data, true);

// Prepare SQL statement with bound parameters
$stmt = $conn->prepare("INSERT INTO movies (id, title, overview, genres, release_date, vote_average, popularity, original_language, original_title, poster_path, vote_count) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

// Bind parameters to SQL statement
$stmt->bind_param("isssddssssi", $id, $title, $overview, $genre, $release_date, $vote_average, $popularity, $original_language, $original_title, $poster_path, $vote_count);

// Loop through each movie in the data array
foreach ($data["results"] as $movie) {
  // Replace commas in genre with spaces
  $genres = implode(", ", array_map(function ($genre) {
    return $genre["name"];
  }, $movie["genre_ids"]));

  $release_date = date("Y-m-d", strtotime($movie["release_date"]));
  
  // Set values for bound parameters
  $id = $movie["id"];
  $title = $movie["title"];
  $overview = $movie["overview"];
//   $release_date = $movie["release_date"];
  $vote_average = $movie["vote_average"];
  $popularity = $movie["popularity"];
  $original_language = $movie["original_language"];
  $original_title = $movie["original_title"];
  $poster_path = $movie["poster_path"];
  $vote_count = $movie["vote_count"];
  
  // Execute SQL statement
  $stmt->execute();
}


// Close prepared statement and database connection
$stmt->close();
$conn->close();

?>
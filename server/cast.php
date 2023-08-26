<?php
// Set up database connection
$servername = "localhost";
$usename = "root";
$password = "";
$dbname = "comrate";
$conn = mysqli_connect($servername, $usename, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Set up TMDB API connection
$api_key = "0a62787a9abad7c433287d227c84c3a8";
$base_url = "https://api.themoviedb.org/3/movie/";
$cast_url = "/credits";

// Retrieve movie IDs from database
$sql = "SELECT id FROM movies";
$result = mysqli_query($conn, $sql);
$update_sql = "UPDATE movies SET cast = ? WHERE id = ?";
$stmt = mysqli_prepare($conn, $update_sql);

$movie_id = array();
// Loop through movie IDs and get cast data from TMDB API
while ($row = mysqli_fetch_assoc($result)) {
    $movie_id[] = $row['id'];
}

//set index of required cast rows from db
for($i=199; $i!= 200; $i++){
    $url = $base_url . $movie_id[$i] . $cast_url . "?api_key=" . $api_key;
    $json_data = file_get_contents($url);
    $cast_data = json_decode($json_data, true);
    $cast = array();
    foreach ($cast_data['cast'] as $actor) {
        if ($actor['known_for_department'] == 'Acting')
            $cast[] = $actor['name'];
    }

    // Update the database with the cast information
    $cast_string = implode(",", $cast);
    mysqli_stmt_bind_param($stmt, "si", $cast_string, $movie_id[$i]);
    mysqli_stmt_execute($stmt);
    if (mysqli_stmt_error($stmt)) {
        $error_msg = mysqli_stmt_error($stmt);
        echo "Error: " . $error_msg;
      }
}

// Close database connection
// mysqli_close($conn);
?>
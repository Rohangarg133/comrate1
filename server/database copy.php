<?php

$q = $_GET['q'];

function get_data()
{
    $servername = "localhost";
    $usename = "comrate";
    $password = "Q1234567890";
    $dbname = "comrate";
    $conn = mysqli_connect($servername, $usename, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $specials = array();
    $allcomics = array();
    $popular = array();
    $standup = array();
    $trending = array();
    $movies = array();

    $query = "SELECT * FROM comic_special";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $specials[] = $row;
        }
    }
    $query = "SELECT * FROM popular_list";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $popular[] = $row;
        }
    }
    $query = "SELECT * FROM trending_list";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $trending[] = $row;
        }
    }
    $query = "SELECT * FROM comicvideos";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $standup[] = $row;
        }
    }
    $query = "SELECT imagesource, comicyt, comicid, comiccolor, comicname, comicrating, imgur  FROM comics_list";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $allcomics[] = $row;
        }
    }
//SELECT adult, original_title, poster_path from movies
    $query = "SELECT poster_path, title from movies";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $movies[] = $row;
        }
    }

    $final_data = json_encode(array('specials' => $specials, 'popular' => $popular, 'trending' => $trending, 'standup' => $standup, 'allcomics' => $allcomics, 'movies' => $movies));
    echo $final_data;
}

function get_all_data($type)
{
    $servername = "localhost";
    $usename = "comrate";
    $password = "Q1234567890";
    $dbname = "comrate";
    $conn = mysqli_connect($servername, $usename, $password, $dbname);
    $array = array();
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT * FROM " . $type;
    $result = $conn->query($query);
    $array = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $array[] = $row;
        }
    }
    $comics_data = json_encode($array);
    echo $comics_data;
}

function get_movies_data(){

}

function get_comments($comicid)
{
    $servername = "localhost";
    $usename = "comrate";
    $password = "Q1234567890";
    $dbname = "comrate";
    $conn = mysqli_connect($servername, $usename, $password, $dbname);
    $array = array();
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT comments FROM comments where comicid = " . $comicid;
    $result = $conn->query($query);
    $array = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $array[] = $row;
        }
    }
    echo json_encode($array);
}

if ($q == 'data') {
    get_data();
} else if ($q == 'comics') {
    get_all_data('comics_list');
} else if ($q == 'movies') {
    get_all_data('movies');
} else {
    get_comments($q);
}


// if ($q == 'trending') {
//     $database->get_trending_list();
//     echo $database->trending_data;
// } else if ($q == 'comicscomplete') {
//     $database->get_comics_list('complete');
//     echo $database->comics_data;
// } else if ($q == 'comicsincomplete'){
//     $database->get_comics_list('incomplete');
//     echo $database->comics_data;
// } else if ($q == 'popular') {
//     $database->get_popular_list();
//     echo $database->popular_data;
// } else if ($q == 'specials') {
//     $database->get_specials_list();
//     echo $database->specials_data;
// } else if ($q == 'standup') {
//     $database->get_standupvideos();
//     echo $database->standup_videos;
// } else {
//     $database->get_comments($q);
//     echo $database->comments_data;
// }

// class Database
// {
//     public static $count = 0;
//     public $conn;
//     private $servername = "localhost";
//     private $usename = "comrate";
//     private $password = "Q1234567890";
//     private $dbname = "comrate";
//     public $comics_data;
//     public $trending_data;
//     public $popular_data;
//     public $specials_data;
//     public $comments_data;
//     public $standup_videos;
//     private static $instance = null;

//     function __construct()
//     {
//         $this->conn = mysqli_connect($this->servername, $this->usename, $this->password, $this->dbname);
//         if ($this->conn->connect_error) {
//             die("Connection failed: " . $this->conn->connect_error);
//         }
//         // $this->get_trending_list();
//         // $this->get_comics_list();
//         // $this->get_popular_list();
//         // $this->get_specials_list();
//         // $this->get_standupvideos();
//     }

//     public function get_comics_list($amount)
//     {
//         if ($amount == 'incomplete')
//             $query = "SELECT imagesource, comicyt, comicid, comiccolor, comicname, comicrating  FROM comics_list";
//         else
//             $query = "SELECT * FROM comics_list";
//         $result = $this->conn->query($query);
//         $array = array();
//         if ($result->num_rows > 0) {
//             while ($row = $result->fetch_assoc()) {
//                 $array[] = $row;
//             }
//         }
//         $this->comics_data = json_encode($array);
//     }

//     public function get_trending_list()
//     {
//         $myfile = fopen("log.txt", "a") or die("Unable to open file!");
//         if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
//             $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
//         } else
//             $ip_address = $_SERVER['REMOTE_ADDR'];
//         $log_message = date('Y-m-d H:i:s') . ' ' . $ip_address . "\n";
//         fwrite($myfile, $log_message);

//         $query = "SELECT * FROM trending_list";
//         $result = $this->conn->query($query);
//         $array = array();
//         if ($result->num_rows > 0) {
//             while ($row = $result->fetch_assoc()) {
//                 $array[] = $row;
//             }
//         }
//         $this->trending_data = json_encode($array);
//     }

//     public function get_popular_list()
//     {
//         $query = "SELECT * FROM popular_list";
//         $result = $this->conn->query($query);
//         $array = array();
//         if ($result->num_rows > 0) {
//             while ($row = $result->fetch_assoc()) {
//                 $array[] = $row;
//             }
//         }
//         $this->popular_data = json_encode($array);
//     }

//     public function get_specials_list()
//     {
//         $query = "SELECT * FROM comic_special";
//         $result = $this->conn->query($query);
//         $array = array();
//         if ($result->num_rows > 0) {
//             while ($row = $result->fetch_assoc()) {
//                 $array[] = $row;
//             }
//         }
//         // $myfile = fopen("newfile.txt", "a") or die("Unable to open file!");
//         $this->specials_data = json_encode($array);
//         // fwrite($myfile, $this->specials_data);
//     }

//     public function get_comments($coimcid)
//     {
//         $query = "SELECT comments FROM comments where comicid = " . $coimcid;
//         $result = $this->conn->query($query);
//         $array = array();
//         if ($result->num_rows > 0) {
//             while ($row = $result->fetch_assoc()) {
//                 $array[] = $row;
//             }
//         }
//         $this->comments_data = json_encode($array);
//     }

//     public function get_standupvideos()
//     {
//         $query = "SELECT * FROM comicvideos";
//         $result = $this->conn->query($query);
//         $array = array();
//         if ($result->num_rows > 0) {
//             while ($row = $result->fetch_assoc()) {
//                 $array[] = $row;
//             }
//             $this->standup_videos = json_encode($array);
//         } else {

//         }


//     }

//     public static function getInstance()
//     {
//         if (empty(self::$instance)) {
//             self::$instance = new Database();
//         }

//         return self::$instance;
//     }

//     public function __destruct()
//     {
//         mysqli_close($this->conn);
//     }

//     public function query($query)
//     {
//         return mysqli_query($query, $this->conn);
//     }
// }


// $database = Database::getInstance();

?>
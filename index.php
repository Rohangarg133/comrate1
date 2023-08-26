
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Comrate - keep laughing</title>
  <link rel="icon" href='assets/icons/titleicon1.webp' type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" ></script>
  <!-- <script src='https://www.hCaptcha.com/1/api.js' async defer></script> -->
  <script src="js/myutilities.js"></script>
  <script src="js/fetchdata.js"></script>
  <script src="js/search.js"></script>
  <script src="js/recommendation1.js"></script>
</head>
<style>
  *:not(i):not(.fa) {
    font-family: poppins;
  }

  body {
    /* background-image: url('assets/space-wallpaper.jpg');
    background-repeat: repeat; */
    /* background-color: rgb(4, 2, 16); */

    /* background-color: #070211; */
    /* background-image: linear-gradient(90deg, #070211 0%, #110019 100%); */
    background-color: rgb(11, 9, 20);
  }

  /* Next & previous buttons */
  .prev,
  .next {
    display: none;
    cursor: pointer;
    position: absolute;
    /* top: 40%; */
    /* width: auto; */
    padding: 12px;
    margin-top: 8%;
    color: white;
    background-color: rgba(0, 0, 0, 0.4);
    font-weight: bold;
    font-size: 22px;
    border-radius: 0px 3px 3px 0;
    border-color: white;
    border: 1px white solid;
    z-index: 3;
    text-decoration: none;
    /* user-select: none; */
    /* -webkit-user-select: none; */
  }

  .prev {
    left: 13px;
  }

  /* Position the "next button" to the right */
  .next {
    right: 13px;
    z-index: 5;
    border-radius: 3px 0 0 3px;
  }

  /* On hover, add a black background color with a little bit see-through */
  .prev:hover,
  .next:hover {
    color: yellow;
    background-color: rgba(0, 0, 0, 0.8);
  }
</style>

<body>
  <?php  
  include "htmlfiles/nav.html";
  include "htmlfiles/trending.html";
  include "htmlfiles/standup.html";
  include "htmlfiles/specials.html";
  include "htmlfiles/tales.html";
  // include "htmlfiles/birthday.html";
  include "htmlfiles/movies.html";
  include "htmlfiles/allcomics.html";
  // include "htmlfiles/popularcomics.html";
  include "htmlfiles/footer.html";
  include "htmlfiles/modals.html";
  ?>
</body>

</html>
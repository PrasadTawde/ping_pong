<?php
session_start();
 
// check if user is logged in, if not redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ping Pong</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <div class="background" style="background-image: url(img/background.jpg);">
    <div id="center">
      <center><h1>Pong Game</h1></center>
      <div class="div">
        <p class="p">
          <button type="button" onclick="window.location.href='pong.php'">
            Play
          </button>
        </p>
      </div>
      <!-- <br> -->
      <div class="div">
        <p class="p">
          <button type="button" onclick="window.location.href='rules.php'">
            Game Rules
          </button>
        </p>
      </div>
      <!-- <br> -->
      
      <div class="div">
        <p class="p">
          <button type="button" onclick="window.location.href='ranking.php'">
            Ranking
          </button>
        </p>
      </div>
      <!-- <br> -->
      <div class="div">
        <p class="p">
          <button type="button" onclick="window.location.href='profile.php'">Profile</button>
        </p>
      </div>
      <!-- <br> -->
    </div>
  </div>  
</body>
</html>
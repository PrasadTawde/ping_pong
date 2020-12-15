<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!-- CREATE TABLE RANKS(RANK_ID INT NOT NULL AUTO_INCREMENT, USER_ID INT, TOTAL_EXP VARCHAR(100), CURRENT_RANK INT, PRIMARY KEY(RANK_ID), FOREIGN KEY(USER_ID) REFERENCES USERS(USER_ID)); -->

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
      <br>
      <div class="div">
        <p class="p">
          <button type="button" onclick="window.location.href='rules.php'">
            Game Rules
          </button>
        </p>
      </div>
      <br>
      
      <div class="div">
        <p class="p">
          <button type="button" onclick="window.location.href='#'">
            Ranking
          </button>
        </p>
      </div>
      <br>
    </div>
  </div>

  
</body>
</html>
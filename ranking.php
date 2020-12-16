<?php
  require_once "config.php";
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
  <div class="background" style="background-image: url(img/background.jpg);">
    <div style="width:50%;margin:10px auto; background-color: white;">
      <p style="text-align: center; font: 50px Arial, sans-serif;"><b>Ranking</b></p>
      <table class="table table-bordered center">
        <thead>
          <tr>
            <th>Name</th>
            <th>Total Rank Points</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $result = $dbh->prepare( "SELECT * FROM RANKS INNER JOIN USERS ON RANKS.USER_ID = USERS.USER_ID ORDER BY TOTAL_RANK_POINT DESC LIMIT 10;" );
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();
            $srno = 0;
            while ($result2=$result->fetch()) {

              $srno++;
              $id = $result2['USER_ID'];
              $name = $result2['USER_NAME'];
              $totalExpPoints = $result2['TOTAL_RANK_POINT'];
          ?>
          <tr>
            <td><?php echo $name; ?></td>
            <td><?php echo $totalExpPoints; ?></td>
          </tr>
          <?php
            }
          ?>
        </tbody>
      </table>
      <p class="p">
        <button type="button" class="btn btn-info" onclick="window.location.href='index.php'">Back</button>
      </p>
    </div> 
  </div>  
</body>
</html>
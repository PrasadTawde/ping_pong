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
      <p style="text-align: center; font: 50px Arial, sans-serif;"><b>Profile</b></p>
      <table class="table table-bordered center">
        <tbody>
          <?php
            $query = "SELECT RANKS.USER_ID, USERS.USER_NAME, RANKS.TOTAL_RANK_POINT FROM RANKS INNER JOIN USERS ON RANKS.USER_ID = USERS.USER_ID WHERE RANKS.USER_ID = :userid ORDER BY RANKS.TOTAL_RANK_POINT DESC LIMIT 10";
            $stmt = $dbh->prepare($query);
            $stmt->execute(array(':userid' => $_SESSION["id"]));

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($stmt->rowCount() == 1) {

              // $query = "SELECT RANKS.USER_ID, USERS.USER_NAME, RANKS.TOTAL_RANK_POINT FROM RANKS INNER JOIN USERS ON RANKS.USER_ID = USERS.USER_ID WHERE RANKS.USER_ID = :userid ORDER BY RANKS.TOTAL_RANK_POINT DESC LIMIT 10";

              // $stmt2 = $dbh->prepare($query);
              // $stmt2->execute(array(':userid' => $_SESSION["id"]));

              // $result = $stmt2->fetch(PDO::FETCH_ASSOC);
              $name = $row['USER_NAME'];
              $totalRankPoints = $row['TOTAL_RANK_POINT'];
              unset($stmt);
          ?>
          <tr>
            <th>Name</th>
            <td><?php echo $name; ?></td>
          </tr>
          <tr>
            <th>Rank</th>
            <td><?php echo $totalRankPoints; ?></td>
          </tr>
          <?php }else{ 
            $query = "SELECT * FROM USERS I WHERE USER_ID = :userid";
            $stmt = $dbh->prepare($query);
            $stmt->execute(array(':userid' => $_SESSION["id"]));

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $name = $row['USER_NAME'];
          ?>
          <tr>
            <th>Name</th>
            <td><?php echo $name; ?></td>
          </tr>
          <tr>
            <th>Rank</th>
            <td><?php echo "0"; }?></td>
          </tr>
        </tbody>
      </table>
      <p class="p">
        <button type="button" class="btn btn-warning" onclick="window.location.href='reset.php'">Reset Password</button>
      </p>
      <p class="p">
        <button type="button" class="btn btn-danger" onclick="window.location.href='logout.php'">Log Out</button>
        <button type="button" class="btn btn-info" onclick="window.location.href='index.php'">Back</button>
      </p>
    </div> 
  </div>  
</body>
</html>
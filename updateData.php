<?php
	require_once "config.php";
	session_start();
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
	    header("location: login.php");
	    exit;
	}

    $rankPoint = 1;

	if(isset($_REQUEST['score'])){

        $query = "SELECT * FROM RANKS WHERE USER_ID = :userid";

        $stmt = $dbh->prepare($query);
        $stmt->execute(array(':userid' => $_SESSION["id"]));

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row['USER_ID'] > 0) {
            # user alredy exits so update data
            $totalRankPoints = $row['TOTAL_RANK_POINT'];
            $rankPoint = $rankPoint + $totalRankPoints;
            $record = "UPDATE RANKS SET TOTAL_RANK_POINT =:exp WHERE USER_ID = :id";
            $stmt2 = $dbh->prepare($record);
            $stmt2->execute(array(':id' => $_SESSION["id"], ':exp' => $rankPoint));
            unset($stmt2);
        }else {
            # user does not exits so create record aka. 1st match
            $record = "INSERT INTO RANKS (USER_ID, TOTAL_RANK_POINT) VALUES (:id, :exp)";
            $stmt2 = $dbh->prepare($record);
            $stmt2->execute(array(':id' => $_SESSION["id"], ':exp' => $rankPoint));
        }
        unset($stmt);
        unset($stmt2);
	}
?>


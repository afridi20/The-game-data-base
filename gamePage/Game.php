<?php
session_start();
include('../conn.php');

$username = $_SESSION['username'] ?? null;
$GameID = $_GET['id'];



if ($username) {
    $sql = "SELECT id FROM user WHERE username= '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $userid = $row['id'] ?? null;
    }
}

$isinwantlist = false;
$isinplayedlist=false;
$isinplayinglist=false;


if($GameID != null && $userid != null){
    //korllar om det finns i want to play list
    $sql = $conn->prepare("SELECT 1 FROM wanttoplay WHERE userid=? AND gameid=?");
    $sql->bind_param("ss", $userid, $GameID);
    $sql->execute();
    $sql->store_result();

    if ($sql->num_rows > 0) {
    
    $isinwantlist=true;
    }

    //kollar om det finn i played list
    $sql = $conn->prepare("SELECT 1 FROM played WHERE userid=? AND gameid=?");
    $sql->bind_param("ss", $userid, $GameID);
    $sql->execute();
    $sql->store_result();

    if ($sql->num_rows > 0) {
    $isinplayedlist=true;
    }

    //kollar om det finn i played list
    $sql = $conn->prepare("SELECT 1 FROM playing WHERE userid=? AND gameid=?");
    $sql->bind_param("ss", $userid, $GameID);
    $sql->execute();
    $sql->store_result();

    if ($sql->num_rows > 0) {
    $isinplayinglist=true;
    }
    
}




if ($_POST) {

   
    if (!$username || !$userid) {
        echo "<script>
            alert('måste logga in först');
            window.location='../index.php';
        </script>";
        exit;
    }

    if ($_POST["posttype"] === "Wanttoplay") {

        $stmt = $conn->prepare("INSERT INTO wanttoplay(userid, gameid) VALUES(?, ?)");
        $stmt->bind_param("ss", $userid, $GameID);
        $stmt->execute();
        $stmt->close();

        header("Location: Game.php?id=" . $GameID);
        exit;
    }

    elseif ($_POST["posttype"] === "played") {

        $stmt = $conn->prepare("INSERT INTO played(userid, gameid) VALUES(?, ?)");
        $stmt->bind_param("ss", $userid, $GameID);
        $stmt->execute();
        $stmt->close();

        header("Location: Game.php?id=" . $GameID);
        exit;
    }

    elseif ($_POST["posttype"] === "Playing") {

        $stmt = $conn->prepare("INSERT INTO playing(userid, gameid) VALUES(?, ?)");
        $stmt->bind_param("ss", $userid, $GameID);
        $stmt->execute();
        $stmt->close();

        header("Location: Game.php?id=" . $GameID);
        exit;
    }

    elseif($_POST["posttype"] === "delete"){
        $stmt = $conn->prepare("DELETE FROM  wanttoplay  WhERE userid=? AND gameid=?");
        $stmt->bind_param("ss", $userid, $GameID);
        $stmt->execute();
        $stmt->close();

        $stmt = $conn->prepare("DELETE FROM  played WhERE userid=? AND gameid=?");
        $stmt->bind_param("ss", $userid, $GameID);
        $stmt->execute();
        $stmt->close();


        $stmt = $conn->prepare("DELETE FROM  playing WhERE userid=? AND gameid=?");
        $stmt->bind_param("ss", $userid, $GameID);
        $stmt->execute();
        $stmt->close();


     
        header("Location: Game.php?id=" . $GameID);
        exit;
     
     
    }
}
?>


 




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="Game.css">
    <title>Document</title>
</head>
<body>
     <a type="button" class="btn btn-outline-primary previous" href="../index.php">back</a>
     <div id="Game-info"></div>
     
     <form action="" method="post" id="buttons">
        <div id="SendButton">
        
       
        <?php if($isinwantlist): ?>

            <button disabled style="color:green;"s>&#x2713; Want to play</button>

        <?php else: ?>

            <button type="submit" name="posttype" value="Wanttoplay" class="btn btn-primary">Want To Play</button>

        <?php endif; ?>
       
        
        <?php if($isinplayedlist): ?>

            <button disabled style="color:green;">&#x2713; Played </button>

        <?php else: ?>

            <button type="submit" name="posttype" value="played" class="btn btn-primary">Played</button>

        <?php endif; ?>
            
       
         <?php if($isinplayinglist): ?>

            <button disabled style="color:green;">&#x2713; Playing </button>

        <?php else: ?>

            <button type="submit" name="posttype" value="Playing" class="btn btn-primary">Playign</button>

        <?php endif; ?>

        <?php if($isinplayinglist || $isinplayedlist || $isinwantlist): ?>

            <button type="submit" name="posttype" value="delete" class="btn btn-primary"  >Remove the gmae</button>

        <?php else: ?>
         
            <button hidden></button>
        
        <?php endif; ?>

        
        
          
        </div>
       </form>
  

     <div id="game-screenshots"></div>


       
     <script src="../Api.js"></script>
     <script src="Gamepage_scirpt.js"></script>
</body>
</html>


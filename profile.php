<?php
session_start();
 
if(!isset($_SESSION['username']) || !isset($_SESSION['token'])){
    header("Location: RegisterPage.php"); 
    exit;

  }
include("conn.php");

// hämta user id
$username =$_SESSION['username'];
$sql= "SELECT id from user where username= '$username' ";
    $result= mysqli_query($conn,$sql);
    if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $userid= $row['id'];
    } 

//hämta all spels id from wanttoplay tabel
$stmt=$conn->prepare("SELECT gameid from wanttoplay WHERE userid=?");
$stmt->bind_param("s",$userid);
$stmt->execute();
$results=$stmt->get_result();
$wantgameIds = [];
while ($row = $results->fetch_assoc()) {
    $wantgameIds[] = $row['gameid'];
   
}
$stmt->close();

//hämta all spels id from palyed  tabel
$stmt=$conn->prepare("SELECT gameid from played WHERE userid=?");
$stmt->bind_param("s",$userid);
$stmt->execute();
$results=$stmt->get_result();
$playedgameIds = [];
while ($row = $results->fetch_assoc()) {
    $playedgameIds[] = $row['gameid'];
   
}
$stmt->close();

//hämta all spels id from palying  tabel
$stmt=$conn->prepare("SELECT gameid from playing WHERE userid=?");
$stmt->bind_param("s",$userid);
$stmt->execute();
$results=$stmt->get_result();
$playingameIds = [];
while ($row = $results->fetch_assoc()) {
    $playingameIds[] = $row['gameid'];
   
}
$stmt->close();










?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="profile.css">
    <title>Document</title>
</head>
<body>
    <nav class="navbar navbar-light  " id="navbutton" >
    
        <a type="button" class="btn btn-outline-light" href="index.php">home</a>
        <a type="button" class="btn btn-outline-light" href="Allgames/Games.php">Game</a>
        <a type="button" class="btn btn-outline-light" href="profile.php">Profile</a>
           
        
        <?php if (!isset($_SESSION['username'])): ?>
        <a href="RegisterPage.php" class="btn btn-outline-light">Log in</a>
        <?php else: ?>
            <a href="logout.php" class="btn btn-outline-light">Log out</a>
        <?php endif; ?>

    </nav>

    <div id="profile">
        <div id="prof-pic"><img src="style\fed0cab36aed374529d59e58350eb8d0.jpg" alt="">  </div>
       <div id="stats" >
       <p>Games Played: <?php echo count($playedgameIds)?></p>
       <p>Games Playing: <?php echo count($playingameIds) ?></p>
       <p>Games Want to play: <?php echo count($wantgameIds) ?></p>
       </div>
    </div>
    <h1>Playing </h1>
    <div id="playing"></div>
    <h1>Want to play</h1>
    <div id="want-to-play"></div>
    <h1>Played</h1>
    <div id="played"></div>
   



    
    <script>
        const wantToPlayIds = <?= json_encode($wantgameIds) ?>;
        const playingameIds = <?= json_encode($playingameIds) ?>;
        const playedgameIds = <?= json_encode($playedgameIds) ?>
    </script>
   <script src="Api.js"></script>
   <script src="profile.js"></script>
</body>
</html>
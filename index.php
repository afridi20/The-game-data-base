<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style/index.css">
    <title>Document</title>
</head>
<body>
 <nav class="navbar navbar-light " id="navbutton" >
 
  <a type="button" class="btn btn-outline-light" href="index.php">home</a>
  <a type="button" class="btn btn-outline-light" href="Allgames/Games.php">Game</a>
  <a type="button" class="btn btn-outline-light" href="profile.php">Profile</a>
    
    <?php if (!isset($_SESSION['username'])): ?>
    <a href="RegisterPage.php" class="btn btn-outline-light">Log in</a>
    <?php else: ?>
        <a href="logout.php" class="btn btn-outline-light">Log out</a>
    <?php endif; ?>


</nav>

     
    <div id="search">
        
        <input type="text" placeholder="search For games">
        <div class="search-result"></div>
    </div>
    
<h2 id="newgame"> Upcoming Game</h2>
<div id="Upcoming_game" class="Card-row"></div>
<h2 id="topgame">Top rated game</h2>
<div id="TopRatedGame" class="Card-row"></div>


   
   
   
    
    
    
    
    
    
    <script src="Api.js"></script>
    <script src="script.js"></script>
    <script src="search.js"></script>
   
  
    
</body>
</html>
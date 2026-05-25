<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="GamesStyle.css">
    <title>Document</title>
</head>
<body>
   <nav class="navbar navbar-light " id="navbutton" >
 
    <a type="button" class="btn btn-outline-light" href="../index.php">home</a>
    <a type="button" class="btn btn-outline-light" href="Games.php">Game</a>
    <a type="button" class="btn btn-outline-light" href="../profile.php">Profile</a>
   
    <?php if (!isset($_SESSION['username'])): ?>
    <a href="../RegisterPage.php" class="btn btn-outline-light">Log in</a>
    <?php else: ?>
        <a href="../logout.php" class="btn btn-outline-light">Log out</a>
    <?php endif; ?>

   


 </nav>

<div id="All-games"></div>  

<div id="prenext">
<Button id="Next-Button" class="btn btn-primary">Next</Button>
<input type="text" name="" id="" placeholder="Enter page Number ">
<button  id="Previous" class="btn btn-primary">Previous</button>  
</div>

<script src="../Api.js"></script>
<script src="Games.js"> </script>
</body>
</html>
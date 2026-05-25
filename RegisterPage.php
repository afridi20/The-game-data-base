<?php
session_start();
 
if(isset($_SESSION['username']) || isset($_SESSION['token'])){
    header("Location:Index.html"); 
    exit;

  }

?>
<?php if (isset($_GET['error']) && $_GET['error'] == 'username_taken'): ?>
<script>
    alert("Username already exists. Please choose another one.");
</script>
<?php endif; ?>

<?php
 
 include('conn.php');

 if($_POST){
    $username= $_POST["username"];
    $password= $_POST["password"];



    if($_POST["posttype"] == "Register"){
            $stmt = $conn->prepare("SELECT id FROM user WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
               
                $stmt->close();
                header("Location: RegisterPage.php?error=username_taken");
                    exit;

            }

            $stmt->close();
        
        
        
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);
        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8){
              echo 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
        }else{
        $hashed=password_hash($password , PASSWORD_DEFAULT);
        $stmt=$conn->prepare("INSERT INTO user(username,password) values(?,?) ");
        $stmt->bind_param("ss", $username, $hashed);
            $stmt->execute();
            $stmt->close();

             $_SESSION['username'] = $username;
             $_SESSION['token'] = bin2hex(random_bytes(32));

            header("Location: index.php");
            exit;
        }
        

    
    }elseif($_POST["posttype"]== "Login"){
        $stmt=$conn -> prepare("SELECT password From  user  where username=?");
        $stmt->bind_param("s" ,$username);
        $stmt->execute();
         $result = $stmt->get_result();
        if($result -> num_rows > 0){
            $row= $result  ->fetch_assoc();
            if(password_verify($password, $row["password"])){
                   
                    $_SESSION['username'] = $username;
                    $_SESSION['token'] = bin2hex(random_bytes(32));

                    header("Location: index.php");
                    exit;
                }

            }else{}
            echo "Fel användarnamn eller lösenord";
            $stmt->close();
            

        }


    

        

        
}
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Registerpage.css">
    <title>Document</title>
</head>
<body>
    

   
        <form action="" method="post" id="logincontainer">
        <div>
        <h1>Register</h1>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="posttype" value="Register">Register</button>
        <button type="submit" name="posttype" value="Login">Login</button>
        </div>
        </form>
    
</body>
</html>

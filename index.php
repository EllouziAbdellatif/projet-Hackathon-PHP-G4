<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
        <?php 
             
             include("php/config.php");
             if(isset($_POST['submit'])){
               $email = $_POST['email'];
               $password = $_POST['password'];

               $query = $pdo->prepare("SELECT * FROM users WHERE Email = ? AND Password = ?");
               $query->execute([$email, $password]);
               $row = $query->fetch(PDO::FETCH_ASSOC);

               if($row){
                   $_SESSION['valid'] = $row['Email'];
                   $_SESSION['username'] = $row['Username'];
                   $_SESSION['age'] = $row['Age'];
                   $_SESSION['id'] = $row['Id'];
               }else{
                   echo "<div class='message'>
                     <p>Wrong Username or Password</p>
                      </div> <br>";
                  echo "<a href='index.php'><button class='btn'>Go Back</button>";
        
               }
               if(isset($_SESSION['valid'])){
                   header("Location: home.php");
                   exit; // Arrêter l'exécution du script après la redirection
               }
             }else{

           
           ?>
            <header>Login</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" required>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Login" required>
                </div>
                <div class="links">
                    Don't have an account? <a href="register.php">Sign Up Now</a>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>
</body>
</html>

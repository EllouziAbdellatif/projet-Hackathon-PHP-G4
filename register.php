<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Register</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
        <?php 
        
        include("php/config.php");
        if(isset($_POST['submit'])){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $age = $_POST['age'];
            $password = $_POST['password'];

            // Vérification de l'email unique
            $verify_query = $pdo->prepare("SELECT Email FROM users WHERE Email = ?");
            $verify_query->execute([$email]);

            if($verify_query->rowCount() != 0 ){
                echo "<div class='message'>
                            <p>This email is used, Please try another one!</p>
                        </div> <br>";
                echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
            }
            else{
                $insert_query = $pdo->prepare("INSERT INTO users (Username, Email, Age, Password) VALUES (?, ?, ?, ?)");
                $insert_query->execute([$username, $email, $age, $password]);

                echo "<div class='message'>
                            <p>Registration successful!</p>
                        </div> <br>";
                echo "<a href='index.php'><button class='btn'>Login Now</button>";
            }
        }else{
        
        ?>

            <header>Sign Up</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="age">Age</label>
                    <input type="number" name="age" id="age" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Register" required>
                </div>
                <div class="links">
                    Already a member? <a href="index.php">Sign In</a>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>
</body>
</html>

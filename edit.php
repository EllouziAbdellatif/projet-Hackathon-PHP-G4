<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Change Profile</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php"> Logo</a></p>
        </div>
        <div class="right-links">
            <a href="#">Change Profile</a>
            <a href="logout.php"><button class="btn">Log Out</button></a>
        </div>
    </div>
    <div class="container">
        <div class="box form-box">
        <?php 
         
         include("php/config.php");
         if(isset($_POST['submit'])){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $age = $_POST['age'];
            $password = $_POST['password'];

            // vérification de l'e-mail unique
            $verify_query = $pdo->prepare("SELECT Email FROM users WHERE Email = ?");
            $verify_query->execute([$email]);

            if($verify_query->rowCount() != 0) {
                echo "<div class='message'>
                          <p>This email is used, Try another one please!</p>
                      </div> <br>";
                echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
            } else {
                $insert_query = $pdo->prepare("INSERT INTO users (Username, Email, Age, Password) VALUES (?, ?, ?, ?)");
                $insert_query->execute([$username, $email, $age, $password]);

                echo "<div class='message'>
                          <p>Registration successfully!</p>
                      </div> <br>";
                echo "<a href='index.php'><button class='btn'>Login Now</button>";
            }
         } else {
         
        ?>
            <header>Change Profile</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="<?php echo isset($username) ? $username : ''; ?>" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?php echo isset($email) ? $email : ''; ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="age">Age</label>
                    <input type="number" name="age" id="age" value="<?php echo isset($age) ? $age : ''; ?>" autocomplete="off" required>
                </div>
                
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Update" required>
                </div>
                
            </form>
        </div>
        <?php } ?>
    </div>
</body>
</html>

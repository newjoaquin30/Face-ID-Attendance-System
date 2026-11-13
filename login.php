<?php
    session_start();
    require_once "connection/db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login.css">
    <title>Login -- International College Tech University</title>
</head>
<body>
    <div class="login-container">
        <form action="login.php" method="post">
            <h4 class="logo"><img src="./img/International_College_Tech_University-removebg-preview.png" alt="">International College Tech University</h4>
            <h2 class="welcome">Welcome back, sign in to start being a future tech.</h2>
            <p class="text">A website built by myself that I came up with.</p>
            <?php if(isset($_GET['error'])): ?>
                <div class="error">
                    <?php echo $_GET['error']; ?>
                </div>
            <?php endif ?>
            <div class="line"></div>
            <label for="email">Email: </label><br>
            <input type="email" name="email" id="email" placeholder="example@gmail.com"><br>
            <label for="password">Password: </label><br>
            <input type="password" name="password" id="password"><br>
            <div class="password-show">
                <p class="show"><input type="checkbox" name="check" id="chck">Show Password</p>
                <p class="pas"><a href="">Forgot Password?</a></p>
            </div>
            <button type="submit" class="signin">Sign in</button>
        </form>

        <aside class="text-aside">
            <h4 class="title">Build / Solve / Innovate</h4>
            <h2 class="logo"><img src="./img/International_College_Tech_University-removebg-preview.png" alt="">International College Tech University</h2>
            <p class="text">ICTU LMS in its singularity for one's tasks.</p>
            <div class="copyright" id="copyright"></div>
            <p class="acc">Don't have an account? <a href="register.php">Sign up</a></p>
        </aside>
    </div>


    <script src="./js/copyright.js"></script>
    <script src="./js/password.js"></script>
</body>
</html>
<?php 
    if(isset($_POST["email"]) && isset($_POST["password"])){
        $email = $_POST["email"];
        $password = $_POST["password"];

        if(empty($email)){
            $em = "Email is missing :/";
            header("Location: login.php?error=$em");
        }else if(empty($password)){
            $em = "Password is missing :/";
            header("Location: login.php?error=$em");
        }else{
            $sql = "SELECT * FROM `register-form` WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$email]);

            if($stmt->rowCount() == 1){
                $user = $stmt->fetch();
                $address = $user["email"];
                $pass = $user["password"];
                $firstname = $user["fname"];
                $middlename = $user["mname"];
                $lastname = $user["lname"];
                $id = $user["id"];
                if($address === $email){
                    if(password_verify($password, $pass)){
                        $_SESSION["email"] = $address;
                        $_SESSION["fname"] = $firstname;
                        $_SESSION["mname"] = $middlename;
                        $_SESSION["lname"] = $lastname;
                        header("Location: pages/dashboard.php");
                    }else{
                        $em = "Incorrect email or password";
                        header("Location: login.php?error=$em");
                    }
                }
            }else{
                $em = "No email has been found, Try Registering an account.";
                header("Location: login.php?error=$em");
            }
        }
    }
?>
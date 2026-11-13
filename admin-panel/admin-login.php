<?php
    require_once "php/database.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="../css/login.css">
    <title>Admin Panel -- International College Tech University</title>
</head>
<body>
    <div class="login-container">
        <form action="admin-login.php" method="post">
            <h4 class="logo"><img src="../img/International_College_Tech_University-removebg-preview.png" alt="">International College Tech University</h4>
            <h2 class="welcome">Welcome back, sign in to start being a future tech.</h2>
            <p class="text">A website built by myself that I came up with.</p>
            <?php if(isset($_GET['error'])): ?>
                <div class="error">
                    <?php echo $_GET['error']; ?>
                </div>
            <?php endif ?>
            <div class="line"></div>
            <label for="username">Username: </label><br>
            <input type="text" name="email" id="email"><br>
            <label for="password">Password: </label><br>
            <input type="password" name="password" id="password"><br>
            <div class="password-show">
                <p class="show"><input type="checkbox" name="check" id="chck">Show Password</p>
            </div>
            <button type="submit" class="signin">Sign in</button>
        </form>

        <aside class="text-aside">
            <h4 class="title">Build / Solve / Innovate</h4>
            <h2 class="logo"><img src="../img/International_College_Tech_University-removebg-preview.png" alt="">International College Tech University</h2>
            <p class="text">ICTU Admin for Administrators only.</p>
            <div class="copyright" id="copyright"></div>
        </aside>
    </div>


    <script src="../js/copyright.js"></script>
    <script src="../js/password.js"></script>
</body>
</html>

<?php 
    if(isset($_POST["email"]) && isset($_POST["password"])){
        $email = $_POST["email"];
        $password = $_POST["password"];

        if(empty($email)){
            $em = "Email is missing :/";
            header("Location: admin-login.php?error=$em");
        }else if(empty($password)){
            $em = "Password is missing :/";
            header("Location: admin-login.php?error=$em");
        }else{
            header("Location: admin-page.php");
        }
    }
?>
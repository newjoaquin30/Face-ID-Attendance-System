<?php
    session_start();
    require_once "connection/db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/register.css">    
    <title>Register -- International College Tech University</title>
</head>
<body>
    
    <div class="login-container">
        <aside class="text-aside">
            <h4 class="title">Build / Solve / Innovate</h4>
            <h2 class="logo"><img src="./img/International_College_Tech_University-removebg-preview.png" alt="">International College Tech University</h2>
            <p class="text">ICTU LMS in its singularity for one's tasks.</p>
            <div class="copyright" id="copyright"></div>
            <p class="acc">Already have an account? <a href="login.php">Sign in</a></p>
        </aside>

        <form action="register.php" method="post">
            <h4 class="logo"><img src="./img/International_College_Tech_University-removebg-preview.png" alt="">International College Tech University</h4>
            <h2 class="welcome">Hello user, sign up to start being a future tech.</h2>
            <p class="text">A website built by myself that I came up with.</p>
            <?php if(isset($_GET['error'])): ?>
                <div class="error">
                    <?php echo $_GET['error']; ?>
                </div>
            <?php endif ?>
            <div class="line"></div>
            <label for="firstname">First Name:</label><br>
            <input type="text" name="fname" id="fname"><br>
            <label for="middlename">Middle Name:</label><br>
            <input type="text" name="mname" id="mname"><br>
            <label for="lastname">Last Name:</label><br>
            <input type="text" name="lname" id="lname"><br>
            <label for="email">Email: </label><br>
            <input type="email" name="email" id="email" placeholder="example@gmail.com"><br>
            <label for="password">Password: </label><br>
            <input type="password" name="password" id="password"><br>
            <label for="password">Confirm Password: </label><br>
            <input type="password" name="password" id="password"><br>
            <div class="password-show">
                <p class="show"><input type="checkbox" name="check" id="chck">I agree to the terms & services.</p>
            </div>
            <button type="submit" class="signin">Sign in</button>
        </form>
    </div>
</body>
</html>
<?php 
    if(isset($_POST["fname"]) &&
       isset($_POST["mname"]) &&
       isset($_POST["lname"]) &&
       isset($_POST["email"]) &&
       isset($_POST["password"])){
        $fname = $_POST["fname"];
        $mname = $_POST["mname"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $data = "fname=".$fname."&mname=".$mname."&lname=".$lname;

        if(empty($fname)){
            $em = "First name is required.";
            header("Location: register.php?error=$em&$data");
        }else if(empty($mname)){
            $em = "Middle name is required.";
            header("Location: register.php?error=$em&$data");
        }else if(empty($lname)){
            $em = "Last name is required.";
            header("Location: register.php?error=$em&$data");
        }else if(empty($email)){
            $em = "Email is required.";
            header("Location: register.php?error=$em&$data");
        }else if(empty($password)){
            $em = "Password is required.";
            header("Location: register.php?error=$em&$data");
        }else{
            try{
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `register-form` (fname, mname, lname, email, password) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$fname, $mname, $lname, $email, $hash]);

            $sm = "Account Created Successfully!";
            header("Location: login.php?success=$sm");
            }catch(PDOException $e){
                $em = "Username already taken.";
                header("Location: register.php?error=$em");
            }
        }
    }
?>
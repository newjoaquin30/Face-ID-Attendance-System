<?php
    session_start();
    require_once "php/database.php";
    require_once "../admin-panel/php/admin.php";
    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $site_read = readById($conn, $id);
        $students = read($conn, $id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/website.css">
    <link rel="stylesheet" href="./css/admin-page.css">
    <title>Manage Website -- International College Tech University</title>
</head>
<body>
    <nav class="admin-nav">
        <div class="nav-logo">
            <h3 class="logo">
                <img src="../img/International_College_Tech_University-removebg-preview.png" alt="">
                <?php if($site_read != 0){ ?>
                    <?= htmlspecialchars($site_read['web_name']); ?>
                <?php }?>
            </h3>
        </div>

        <span class="active">🟢 System Active</span>

        <div class="logout">
            <a href="admin-login.php">Logout</a>
        </div>
    </nav>

    <header class="login-form-container">
        <div class="login-form-contents">
            <form action="edit-student.php" method="post">
                <h3 class="logo">
                    <img src="../img/International_College_Tech_University-removebg-preview.png" alt="">
                    Manage Student Details
                </h3>
                <div class="line"></div>
                <input type="hidden" name="id" value="<?= $students["id"] ?>">
                <label for="fname">First Name:</label><br>
                <input type="text" name="fname" id="fname" value="<?= $students["fname"] ?>"><br>
                <label for="mname">Middle Name:</label><br>
                <input type="text" name="mname" id="mname" value="<?= $students["mname"] ?>"><br>
                <label for="lname">Last Name:</label><br>
                <input type="text" name="lname" id="lname" value="<?= $students["lname"] ?>"><br>
                <label for="email">Email:</label><br>
                <input type="email" name="email" id="email" value="<?= $students["email"] ?>"><br>
                <button class="update" type="submit">Update Student Details</button>
            </form>
        </div>
    </header>
</body>
</html>
<?php } ?>
<?php 
    function readById($conn, $id){
        $sql = "SELECT * FROM `website_settings` WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);

        if($stmt->rowCount() > 0){
            $site = $stmt->fetch();
        }else{
            $site = 0;
        }
        return $site;
    }
?>
<?php 
    function read($conn, $id){
        $sql = "SELECT * FROM `register-form` WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);

        if($stmt->rowCount() > 0){
            $site = $stmt->fetch();
        }else{
            $site = 0;
        }
        return $site;
    }
?>
<?php 
    if(isset($_POST["fname"]) && 
       isset($_POST["mname"]) && 
       isset($_POST["lname"]) && 
       isset($_POST["email"]) && isset($_POST["id"])){
        $fname = $_POST["fname"];
        $mname = $_POST["mname"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $id = $_POST["id"];

        if(empty($fname)){
            $em = "No firstname inserted.";
            header("Location: admin-details.php?error=$em");
        }else if(empty($mname)){
            $em = "No middlename inserted.";
            header("Location: admin-details.php?error=$em");
        }else if(empty($lname)){
            $em = "No lastname inserted.";
            header("Location: admin-details.php?error=$em");
        }else if(empty($email)){
            $em = "No email inserted.";
            header("Location: admin-details.php?error=$em");
        }else if(empty($id)){
            $em = "No ID inserted.";
            header("Location: admin-details.php?error=$em");
        }else{
            $sql = "UPDATE `register-form` SET `fname`=?, `mname`=?, `lname`=?, `email`=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$fname, $mname, $lname, $email, $id]);

            $sm = "Successfully Updated!";
            header("Location: admin-details.php?success=$sm");
        }
    }
?>
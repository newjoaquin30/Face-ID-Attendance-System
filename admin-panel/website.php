<?php
    session_start();
    require_once "php/database.php";
    require_once "../admin-panel/php/admin.php";
    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $site_read = readById($conn, $id);
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
            <form action="website.php" method="post">
                <h3 class="logo">
                    <img src="../img/International_College_Tech_University-removebg-preview.png" alt="">
                    Manage Website Details
                </h3>
                <div class="line"></div>
                <input type="hidden" name="id" value="<?= $site_read["id"] ?>">
                <label for="webname">Website Name:</label><br>
                <input type="text" name="ictu-name" id="ictu" value="<?= $site_read["web_name"] ?>"><br>
                <label for="schoolyear">School Year:</label><br>
                <input type="text" name="ictu-year" id="year" value="<?= $site_read["school_year"] ?>"><br>
                <button class="update" type="submit">Update Website</button>
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
    if(isset($_POST["ictu-name"]) && isset($_POST["ictu-year"]) && isset($_POST["id"])){
        $name = $_POST["ictu-name"];
        $year = $_POST["ictu-year"];
        $id = $_POST["id"];

        if(empty($name)){
            $em = "No name inserted.";
            header("Location: admin-webpage.php?error=$em");
        }else if(empty($year)){
            $em = "No year inserted.";
            header("Location: admin-webpage.php?error=$em");
        }else if(empty($id)){
            $em = "No ID inserted.";
            header("Location: admin-webpage.php?error=$em");
        }else{
            $sql = "UPDATE `website_settings` SET `web_name`=?, `school_year`=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$name, $year, $id]);

            $sm = "Successfully Updated!";
            header("Location: admin-webpage.php?success=$sm");
        }
    }
?>
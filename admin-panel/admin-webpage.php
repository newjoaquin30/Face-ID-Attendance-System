<?php
    session_start();
    require_once "php/database.php";
    require_once "../admin-panel/php/admin.php";
    $site_read = read($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/webpage.css">
    <link rel="stylesheet" href="./css/admin-page.css">
    <title>Website Settings -- International College Tech University</title>
</head>
<body>
    <nav class="admin-nav">
        <div class="nav-logo">
            <h3 class="logo">
                <img src="../img/International_College_Tech_University-removebg-preview.png" alt="">
                <?php if($site_read != 0){
                    foreach($site_read as $row){ ?>
                <?= $row['web_name']; ?>
                <?php } }?>
            </h3>
        </div>

        <span class="active">🟢 System Active</span>

        <div class="logout">
            <a href="admin-login.php">Logout</a>
        </div>
    </nav>

    <aside class="navbar">
        <a href="./admin-page.php"><ion-icon name="grid-outline"></ion-icon> Overview</a>
        <a href="./admin-webpage.php"><ion-icon name="globe-outline"></ion-icon> Website Settings</a>
        <a href="./admin-details.php"><ion-icon name="school-outline"></ion-icon> Student Details</a>
    </aside>

    <header class="website-container">
        <div class="website-contents">
            <h2 class="web-title">Website Configuration</h2>
            <?php if(isset($_GET["success"])){ ?>
            <div class="success">
                <?php echo $_GET["success"] ?>
            </div>
            <?php } ?>
            <?php if(isset($_GET["error"])){ ?>
            <div class="error">
                <?php echo $_GET["error"] ?>
            </div>
            <?php } ?>

            <?php if($site_read != 0){
                foreach($site_read as $rows){ ?>
            <div class="website-details">
                <p class="id" style="display: none;"><?= $rows["id"] ?></p>
                <p class="name">Website Name: <span class="text"><?= $rows['web_name'] ?></span></p>
                <p class="name">School Year: <span class="text"><?= $rows['school_year'] ?></span></p>
                <a href="website.php?id=<?= $rows["id"] ?>">Edit Website</a>
            </div>
            <?php } } ?>
        </div>
    </header>



    <script type="module" src="https://unpkg.com/ionicons@8.0.13/dist/ionicons/ionicons.esm.js"></script>
</body>
</html>
<?php 
    function read($conn){
        $sql = "SELECT * FROM `website_settings`";
        $stmt = $conn->prepare($sql);
        $stmt->execute([]);

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return count($rows) > 0 ? $rows : 0;
    }
?>
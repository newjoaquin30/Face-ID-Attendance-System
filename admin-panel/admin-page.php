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
    <link rel="stylesheet" href="./css/admin-page.css">
    <title>Admin Dashboard -- International College Tech University</title>
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

    <header class="admin-page-container">
        <div class="admin-page-contents">
            <h2 class="admin-title">Admin Dashboard</h2>

            <div class="boxes">
                <div class="card">
                    <h3 class="enrolled">Students Enrolled</h3>
                    <p class="no">0</p>
                </div>
                <div class="card">
                    <h3 class="enrolled">Faculty</h3>
                    <p class="no">0</p>
                </div>
            </div>
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
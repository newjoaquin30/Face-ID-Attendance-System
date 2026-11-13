<?php
    session_start();
    require_once "../connection/db.php";
    require_once "../admin-panel/php/admin.php";
    require_once "../admin-panel/php/database.php";
    $site_read = read($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="../css/dashboard.css">
    <title>User Profile -- International College Tech University</title>
</head>
<body>
    <nav class="dashboard-nav">
        <div class="nav-logo">
            <h3 class="logo">
                <img src="../img/International_College_Tech_University-removebg-preview.png" alt="">
                <span class="name">
                <?php if($site_read != 0){
                    foreach($site_read as $row){ ?>
                <?= $row['web_name']; ?>
                <?php } }?></span>
            </h3>
        </div>

        <ul class="nav-links">
            <li class="link">
                <img src="../img/profile.png" alt=""><span class="name"><?php echo $_SESSION["fname"]; ?></span>
            </li>
            <li class="link-2">
                <ion-icon name="notifications-outline"></ion-icon>
            </li>
            <li class="link-3">
                <ion-icon name="chatbox-outline"></ion-icon>
            </li>
            <li class="link-4">
                <ion-icon name="menu-outline"></ion-icon>
                <div class="dropdown-contents">
                    <a href="../assets/preference.php">Preference</a>
                    <a href="../assets/profile.php">Profile</a>
                    <a href="">Support</a>
                    <a href="../login.php">Logout</a>
                </div>
            </li>
        </ul>
    </nav>
    
    <header class="profile-container">
        <div class="profile-contents">
            <div class="box-profile">
                <h1 class="pfp-title">User Profile</h1>
                <p class="nav"><a href="../pages/dashboard.php">Dashboard</a> / <a href="../assets/profile.php">Profile</a></p>
            </div>

            <div class="profile-details">
                <h2 class="pfp-text">Profile Details</h2>
                <p class="fname">First Name: <span class="name"><?php echo $_SESSION["fname"]; ?></span></p>
                <p class="fname">Middle Name: <span class="name"><?php echo $_SESSION["mname"]; ?></span></p>
                <p class="fname">Last Name: <span class="name"><?php echo $_SESSION["lname"]; ?></span></p>
                <p class="fname">Email: <span class="name"><?php echo $_SESSION["email"]; ?></span></p>
            </div>
        </div>
    </header>

    
    <script type="module" src="https://unpkg.com/ionicons@8.0.13/dist/ionicons/ionicons.esm.js"></script>
    <script src="../js/darkmode.js"></script>
</body>
</html>
<?php 
    function read($conn){
        $sql = "SELECT * FROM `website_settings`";
        $stmt = $conn->prepare($sql);
        $stmt->execute([]);

        $result = $stmt->get_result();

        if($result->num_rows > 0){
            $site_read = $result->fetch_all(MYSQLI_ASSOC);
        }else {
            $site_read = 0;
        }
        return $site_read;
    }
?>
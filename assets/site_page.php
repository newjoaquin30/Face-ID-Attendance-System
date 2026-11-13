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
    <link rel="stylesheet" href="../css/site.css">
    <title>Site Page -- International College Tech University</title>
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

    <header class="site-container">
        <div class="site-contents">
            <div class="box-site">
                <h1 class="site-title">Site Page</h1>
                <p class="nav"><a href="../pages/dashboard.php">Dashboard</a> / <a href="../assets/site_page.php">Site Page</a></p>
            </div>

            <div class="information">
                <h2 class="site-text">Website Information</h2>

                <div class="infos">
                    <h3 class="website-name">Website Name: 
                        <span class="name"><?php if($site_read != 0){
                            foreach($site_read as $row){ ?>
                        <?= $row["web_name"]; ?>
                        <?php } } ?></span>
                    </h3>
                    <h3 class="website-name">School Year: 
                        <span class="name"><?php if($site_read != 0){
                            foreach($site_read as $row){ ?>
                        <?= $row["school_year"]; ?>
                        <?php } } ?></span>
                    </h3>
                    <h3 class="website-name">Creator / Developer: 
                        <span class="name">Joaquin Rafael P. Riosa</span>
                    </h3>
                </div>
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
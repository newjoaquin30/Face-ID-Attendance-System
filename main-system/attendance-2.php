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
    <link rel="stylesheet" href="../css/attendance.css">
    <link rel="stylesheet" href="../css/dashboard.css">
    <title>Attendance -- International College Tech University</title>
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

    <header class="attendance-container">
        <div class="attendance-contents">
            <h2 class="title">Take Attendance</h2>

            <div class="main-system">
                <div class="attendance">
                    <h3 class="cam">Look at the Camera</h3>
                    <div class="camera">
                        <video id="vid" autoplay muted playsinline></video>
                        <canvas id="overlay"></canvas>
                    </div>
                    <div id="face-status" class="face-status">Loading...</div>

                    <div class="time">
                        <p class="clock">--:--:--</p>
                        <p class="date" id="date"></p>
                        <h2 class="marked">Marked for today</h2>
                        <ul id="log">
                            <li>No students yet</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="main">
        <a href="../pages/subjects/self.php">Back to subject</a>
    </div>

    


    <script type="module" src="https://unpkg.com/ionicons@8.0.13/dist/ionicons/ionicons.esm.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@vladmandic/face-api/dist/face-api.js"></script>
    <script src="../opencv_js/main.js"></script>
    <script src="../models/api/attendance-2.js"></script>
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
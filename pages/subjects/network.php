<?php
    session_start();
    require_once "../../connection/db.php";
    require_once "../../admin-panel/php/admin.php";
    require_once "../../admin-panel/php/database.php";
    $site_read = read($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/subject-css/database.css">
    <title>ITC122LEC - Introduction to Database System</title>
</head>
<body>
    <nav class="dashboard-nav">
        <div class="nav-logo">
            <h3 class="logo">
                <img src="../../img/International_College_Tech_University-removebg-preview.png" alt="">
                <span class="name"><?php if($site_read != 0){
                    foreach($site_read as $row){ ?>
                <?= $row['web_name']; ?>
                <?php } }?></span>
            </h3>
        </div>

        <ul class="nav-links">
            <li class="link">
                <img src="../../img/profile.png" alt=""><span class="name"><?php echo $_SESSION["fname"]; ?></span>
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
                    <a href="../../assets/preference.php">Preference</a>
                    <a href="../../assets/profile.php">Profile</a>
                    <a href="">Support</a>
                    <a href="../login.php">Logout</a>
                </div>
            </li>
        </ul>
    </nav>

    <header class="major-container">
        <div class="major-contents">
            <div class="box-sub">
                <h1 class="sub-name">ICTU - ITC211NLEC - Fundamentals of Networking</h1>
                <p class="nav"><a href="../dashboard.php">Dashboard</a> / <a href="../subjects/database.php">ITC211NLEC - Fundamentals of Networking</a></p>
            </div>

            <aside class="nav-links-1">
                <h3 class="dash">Dashboard</h3>
                <div class="line"></div>

                <ul class="navs">
                    <li class="nav-link"><a href="../dashboard.php"><ion-icon name="grid-outline"></ion-icon> Overview</a></li>
                    <li class="nav-link"><a href="../../assets/site_page.php"><ion-icon name="cog-outline"></ion-icon> Site Page</a></li>
                    <li class="nav-link"><a href="../../pages/grades.php"><ion-icon name="clipboard-outline"></ion-icon> Grades</a></li>
                    <li class="nav-link"><a href="../../pages/courses.php"><ion-icon name="library-outline"></ion-icon> Courses</a></li>
                    <li class="nav-link"><a href="../subjects/database.php">ITC122LEC - Introduction to Database System</a></li>
                    <li class="nav-link"><a href="../subjects/database(lab).php">ITC122LAB - Introduction to Database System</a></li>
                    <li class="nav-link"><a href="../subjects/network.php">ITC211NLEC - Fundamentals of Networking</a></li>
                    <li class="nav-link"><a href="../subjects/network(lab).php">ITC211NLAB - Fundamentals of Networking</a></li>
                    <li class="nav-link"><a href="../subjects/self.php">GCAS 20 - Understanding the Self</a></li>
                    <li class="nav-link"><a href="../subjects/ethics.php">GCAS 05 - Ethics</a></li>
                    <li class="nav-link"><a href="../subjects/research.php">GCAS 17 - Introduction to Research Writings</a></li>
                    <li class="nav-link"><a href="../subjects/dance.php">PATHFIT 3 - Dance</a></li>
                </ul>
            </aside>

            <div class="terms-contents">
                <h2 class="announce">Announcements</h2>
                <div class="line"></div>
                <a href=""><ion-icon name="megaphone"></ion-icon> See announcement</a>
                <div class="line"></div>
                
                <div class="attendance">
                    <h2 class="atten-title">Attendance</h2>
                    <div class="line"></div>
                    <a href="../../main-system/attendance-1.php"><ion-icon name="shield-checkmark-outline"></ion-icon>Attendance</a>
                    <div class="line-1"></div>                    
                </div>

                <div class="terms">
                    <h2 class="prelim">Prelim</h2>
                    <div class="line"></div>
                    <div class="line-1"></div>                    
                </div>
                
                <div class="terms">
                    <h2 class="prelim">Midterm</h2>
                    <div class="line"></div>
                    <div class="line-1"></div>                    
                </div>
                
                <div class="terms">
                    <h2 class="prelim">Semi-Finals</h2>
                    <div class="line"></div>
                    <div class="line-1"></div>                    
                </div>
                
                <div class="terms">
                    <h2 class="prelim">Finals</h2>
                    <div class="line"></div>
                    <div class="line-1"></div>                    
                </div>
            </div>
        </div>
    </header>


    <script type="module" src="https://unpkg.com/ionicons@8.0.13/dist/ionicons/ionicons.esm.js"></script>
    <script src="../../js/darkmode.js"></script>
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
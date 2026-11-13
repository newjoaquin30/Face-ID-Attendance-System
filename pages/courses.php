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
    <link rel="stylesheet" href="../css/course.css">
    <title>Courses -- International College Tech University</title>
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

    <header class="course-container">
        <div class="course-contents">
            <div class="box-course">
                <h1 class="course-title">My Courses</h1>
                <p class="nav"><a href="../pages/dashboard.php">Dashboard</a> / <a href="../pages/courses.php">Course</a></p>
            </div>

            <div class="course">
                <table>
                    <tr>
                        <th>Subject Name & Code</th>
                        <th>Schedule</th>
                    </tr>
                    <tr>
                        <td>ITC122LEC - Introduction to Database System</td>
                        <td>THU 01:00 - 04:00PM</td>
                    </tr>
                    <tr>
                        <td>ITC122LAB - Introduction to Database System</td>
                        <td>FRI 01:00 - 3:00PM</td>
                    </tr>
                    <tr>
                        <td>ITC211NLEC - Fundamentals of Networking</td>
                        <td>THU 05:30 - 7:30PM</td>
                    </tr>
                    <tr>
                        <td>ITC211NLAB - Fundamentals of Networking</td>
                        <td>FRI 05:30 - 8:30PM</td>
                    </tr>
                    <tr>
                        <td>GCAS 20 - Understanding the Self</td>
                        <td>SAT 09:30 - 12:30PM</td>
                    </tr>
                    <tr>
                        <td>GCAS 05 - Ethics</td>
                        <td>WED 02:30 - 5:30PM</td>
                    </tr>
                    <tr>
                        <td>GCAS 17 - Introduction to Research Writings</td>
                        <td>FRI 10:30 - 12:00PM</td>
                    </tr>
                    <tr>
                        <td>PATHFIT 3 - Dance</td>
                        <td>FRI 07:30 - 9:30AM</td>
                    </tr>
                </table>
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

        $result = $stmt->get_result();

        if($result->num_rows > 0){
            $site_read = $result->fetch_all(MYSQLI_ASSOC);
        }else {
            $site_read = 0;
        }
        return $site_read;
    }
?>
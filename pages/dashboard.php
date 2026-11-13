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
    <link rel="stylesheet" href="../css/dashboard.css">
    <title>Dashboard -- International College Tech University</title>
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

    <header class="dashboard-container">
        <div class="dashboard-contents">
            <div class="box">
                <h1 class="dash">Dashboard</h1>
            </div>

            <h3 class="welcome">Greetings, <?php echo $_SESSION["fname"] . " " . $_SESSION["mname"]; ?></h3>
        </div>

        <div class="boxes-contents">
            <aside class="nav-links-1">
                <h3 class="dash">Dashboard</h3>
                <div class="line"></div>

                <ul class="navs">
                    <li class="nav-link"><a href="../pages/dashboard.php"><ion-icon name="grid-outline"></ion-icon> Overview</a></li>
                    <li class="nav-link"><a href="../assets/site_page.php"><ion-icon name="cog-outline"></ion-icon> Site Page</a></li>
                    <li class="nav-link"><a href="../pages/grades.php"><ion-icon name="clipboard-outline"></ion-icon> Grades</a></li>
                    <li class="nav-link"><a href="../pages/courses.php"><ion-icon name="library-outline"></ion-icon> Courses</a></li>
                    <li class="nav-link"><a href="../pages/subjects/database.php">ITC122LEC - Introduction to Database System</a></li>
                    <li class="nav-link"><a href="../pages/subjects/database(lab).php">ITC122LAB - Introduction to Database System</a></li>
                    <li class="nav-link"><a href="../pages/subjects/network.php">ITC211NLEC - Fundamentals of Networking</a></li>
                    <li class="nav-link"><a href="../pages/subjects/network(lab).php">ITC211NLAB - Fundamentals of Networking</a></li>
                    <li class="nav-link"><a href="../pages/subjects/self.php">GCAS 20 - Understanding the Self</a></li>
                    <li class="nav-link"><a href="../pages/subjects/ethics.php">GCAS 05 - Ethics</a></li>
                    <li class="nav-link"><a href="../pages/subjects/research.php">GCAS 17 - Introduction to Research Writings</a></li>
                    <li class="nav-link"><a href="../pages/subjects/dance.php">PATHFIT 3 - Dance</a></li>
                </ul>
            </aside>

            <div class="announcements">
                <h2 class="announce">Announcements</h2>
                <div class="line"></div>

                <div class="image">
                    <img src="../img/none.jfif" alt="">
                </div>
            </div>
        </div>
        
        <div class="calendar">
            <h2 class="calendar-text">Calendar</h2>
            <div class="line"></div>
            <h3 class="month" id="month-year"></h3>
            <table>
                <tr>
                    <th id="days">Mon</th>
                    <th id="days">Tue</th>
                    <th id="days">Wed</th>
                    <th id="days">Thu</th>
                    <th id="days">Fri</th>
                    <th id="days">Sat</th>
                    <th id="days">Sun</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>2</td>
                    <td>3</td>
                    <td>4</td>
                    <td>5</td>
                    <td>6</td>
                    <td>7</td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>9</td>
                    <td>10</td>
                    <td>11</td>
                    <td>12</td>
                    <td>13</td>
                    <td>14</td>
                </tr>
                <tr>
                    <td>15</td>
                    <td>16</td>
                    <td>17</td>
                    <td>18</td>
                    <td>19</td>
                    <td>20</td>
                    <td>21</td>
                </tr>
                <tr>
                    <td>22</td>
                    <td>23</td>
                    <td>24</td>
                    <td>25</td>
                    <td>26</td>
                    <td>27</td>
                    <td>28</td>
                </tr>
                <tr>
                    <td>29</td>
                    <td>30</td>
                    <td>31</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </div>

        <div class="m-v">
            <aside class="mission-vision">
                <h3 class="mission">Mission</h3>
                <li class="text">To achieve, succeed, and prepare for what the future holds us as future tech leaders.</li>

                <h3 class="vision">Vision</h3>
                <li class="text">To provide equitable access to students that will teach them basic, simple technologies.</li>
            </aside>
        </div>
    </header>

    <script type="module" src="https://unpkg.com/ionicons@8.0.13/dist/ionicons/ionicons.esm.js"></script>
    <script src="../js/calendar.js"></script>
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
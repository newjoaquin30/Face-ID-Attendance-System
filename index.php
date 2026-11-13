<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="css/style.css">
    <title>International College Tech University</title>
</head>
<body>
    <nav class="navigation-bar" id="navbar">
        <div class="nav-logo">
            <h2 class="logo"><img src="img/International_College_Tech_University-removebg-preview.png" alt="Logo"> <span class="name">International College Tech University</span></h2>
            <ion-icon name="menu-outline" class="menu" onclick="openNav()"></ion-icon>
        </div>

        <ul class="nav-links" id="nav-links">
            <li class="link"><a href="index.php">Home</a></li>
            <li class="link"><a href="">About us</a></li>
            <li class="link"><a href="">History</a></li>
            <li class="link"><a href="">Founder</a></li>
            <li class="link"><a href="">Mission & Vision</a></li>
            <li class="link"><a href="./login.php">Sign in</a></li>
            <li class="link"><a href="./register.php">Sign up</a></li>
        </ul>
    </nav>

    <div class="blur-effect">
        <span class="blur"></span>
        <span class="blur"></span>
        <span class="blur"></span>
        <span class="blur"></span>
    </div>

    <header class="main-container">
        <div class="main-contents">
            <div class="icon" data-aos="fade-up" data-aos-duration="1450">
                <ion-icon name="school-outline"></ion-icon>
            </div>

            <h2 class="title" data-aos="fade-up" data-aos-duration="1550">Build, Solve, and Innovate</h2>
            <h3 class="sub-title" data-aos="fade-up" data-aos-duration="1650">Welcome to ICTU</h3>
            <p class="text" data-aos="fade-up" data-aos-duration="1750">Enroll to become a future tech innovater</p>

            <div class="button" data-aos="fade-up" data-aos-duration="1850">
                <button class="start">Get Started</button>
            </div>

            <ion-icon name="alarm-outline" class="alarm"></ion-icon>
            <ion-icon name="cafe-outline" class="cafe"></ion-icon>
        </div>
    </header>

    <section class="about-container">
        <div class="about-contents">
            <h2 class="contacts">Contact us from other branches</h2>

            <div class="contact">
                <div class="card">
                    <p class="title">ICTU Manila Branch</p>
                    <p class="phone">(02) 998-992-989</p>
                </div>
                <div class="card">
                    <p class="title">ICTU Mandaluyong Branch</p>
                    <p class="phone">(02) 998-992-902</p>
                </div>
                <div class="card">
                    <p class="title">ICTU Taft Branch</p>
                    <p class="phone">(02) 998-940-854</p>
                </div>
                <div class="card">
                    <p class="title">ICTU Taguig Branch</p>
                    <p class="phone">(02) 998-222-234</p>
                </div>
                <div class="card">
                    <p class="title">ICTU Makati Branch</p>
                    <p class="phone">(02) 998-651-455</p>
                </div>
                <div class="card">
                    <p class="title">ICTU Pasig Branch</p>
                    <p class="phone">(02) 998-990-901</p>
                </div>
            </div>
        </div>

        <div class="programs-contents">
            <div class="program-text">
                <h3 class="program-title">Program Offering</h3>
                <p class="text">We offer programs that teach students and train students
                    to prepare for IT jobs in their future tech.
                </p>
            </div>

            <div class="programs">
                <div class="program-cards">
                    <div class="card">
                        <h3 class="web"><ion-icon name="desktop-outline" class="desktop"></ion-icon> Web Development</h3>
                        <p class="text">This is where students will focus on building an application or website
                            using html, css, and js. It masters them about details, arrangement, etc.
                        </p>
                    </div>
                    <div class="card" id="card1">
                        <h3 class="web"><ion-icon name="desktop-outline" class="desktop"></ion-icon> Software Engineering</h3>
                        <p class="text">This is all about managing, creating, and analyzing an application that teach students
                            of the foundation of the software.
                        </p>
                    </div>
                    <div class="card" id="card2">
                        <h3 class="web"><ion-icon name="desktop-outline" class="desktop"></ion-icon> UI/UX Design</h3>
                        <p class="text">A program that offers students who are willing to design with creativity,
                            captivating prototypes that lets developers examine the design.
                        </p>
                    </div>
                    <div class="card" id="card3">
                        <h3 class="web"><ion-icon name="shield-outline" class="desktop"></ion-icon> CyberSecurity</h3>
                        <p class="text">An interesting program that teach students how to detect any harmful environment
                            to the software and protect from viruses and malwares.
                        </p>
                    </div>
                    <div class="card" id="card4">
                        <h3 class="web"><ion-icon name="desktop-outline" class="desktop"></ion-icon> Mobile App Development</h3>
                        <p class="text">This is where students learn and train how to create a mobile application using a specific
                            language such as dart, swift, etc.
                        </p>
                    </div>
                    <div class="card" id="card">
                        <h3 class="web">More programs to be added in the future. . .</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="shs-contents">
            <h2 class="shs-title">Senior High Strands</h2>
            <p class="text">We also offer shs for students to choose what they want. It includes ICT,
                STEM, ABM, GAS, and HE.
            </p>

            <h3 class="tvl">Technical, Vocational and Livelihood</h3>
            <div class="strands">
                <div class="card">
                    <h3 class="ict">ICT</h3>
                    <ul class="strand">
                        <li class="strand">Data Networking</li>
                        <li class="strand">Data Analyzing</li>
                        <li class="strand">Computer Programming</li>
                    </ul>
                </div>
                <div class="card">
                    <h3 class="ict">HE (Home Economics)</h3>
                    <ul class="strand">
                        <li class="strand">Cooking</li>
                        <li class="strand">Reservations</li>
                        <li class="strand">Bakery</li>
                        <li class="strand">Bartender</li>
                        <li class="strand">Home services</li>
                        <li class="strand">Bartender (Cruise Ship)</li>
                    </ul>
                </div>
            </div>

            <h3 class="acads">Academic Tracks</h3>
            <div class="strands" id="tracks">
                <div class="card">
                    <h3 class="ict">STEM</h3>
                    <ul class="strand">
                        <li class="strand">Science</li>
                        <li class="strand">Technology</li>
                        <li class="strand">Engineering</li>
                        <li class="strand">Mathematics</li>
                    </ul>
                </div>
                <div class="card">
                    <h3 class="ict">ABM</h3>
                    <ul class="strand">
                        <li class="strand">Accountancy</li>
                        <li class="strand">Business & Management</li>
                    </ul>
                </div>
                <div class="card">
                    <h3 class="ict">GAS</h3>
                    <ul class="strand">
                        <li class="strand">General Academics</li>
                    </ul>
                </div>
                <div class="card">
                    <h3 class="ict">HUMMS</h3>
                    <ul class="strand">
                        <li class="strand">Humanities</li>
                        <li class="strand">Social Science</li>
                    </ul>
                </div>
            </div>

            <h3 class="sports">Sports Track</h3>
            <div class="strands" id="sport">
                <div class="card">
                    <h3 class="ict">SPORTS</h3>
                    <ul class="strand">
                        <li class="strand">Coaching</li>
                        <li class="strand">Team Sports</li>
                        <li class="strand">Basketball</li>
                        <li class="strand">Volleyball</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <footer class="other-container">
        <div class="image-logo">
            <img src="./img/International_College_Tech_University-removebg-preview.png" alt="">
            <div class="title">
                <h3 class="logo">International College Tech University</h3>
                <p class="address">2940 Legarda St. Sampaloc, Manila</p>
                <p class="no">(02) 998-992-989</p>
                <p class="no">(02) 998-992-995</p>
                <div class="social">
                    <a href=""><ion-icon name="logo-facebook"></ion-icon></a>
                    <a href=""><ion-icon name="logo-twitter"></ion-icon></a>
                    <a href=""><ion-icon name="logo-instagram"></ion-icon></a>
                </div>
            </div>
        </div>

        <div class="other-links">
            <a href="index.php">Home</a>
            <a href="">About us</a>
            <a href="">History</a>
            <a href="">Terms & Services</a>
            <a href="">Privacy Policy</a>
            <a href="">Copyright</a>
        </div>
    </footer>



    <script type="module" src="https://unpkg.com/ionicons@8.0.13/dist/ionicons/ionicons.esm.js"></script>
      <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
  <script src="./js/index.js"></script>
</body>
</html>
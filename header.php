<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: header.php -->
<!-- Description: To create and display a universal header for Tourlaysia website. -->
<!-- Date first written: 15/6/2025 -->
<!-- Date last modified: 28/6/2025 -->

<?php
    @session_start(); // Start session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="./img/logo/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css">
    <link rel="stylesheet" href="./styles/styles.css">
    <link rel="stylesheet" href="./styles/header.css">
    <link rel="stylesheet" href="./styles/logout_popup.css">
</head>
<body>
    <?php
        include './crud/db_connection.php'; // Connect database

        if (isset($_SESSION['SES_UserID'])) {
            $refUserID = $_SESSION['SES_UserID']; // Retrieve user ID with session variable

            // Select record and store value
            $query = "SELECT * FROM user_account_t WHERE usr_ID = '$refUserID';";
            $results = mysqli_query($connection, $query);
            $data = mysqli_fetch_assoc($results);
        
            $name = $data['usr_name'];
            $role = $data['usr_role'];
            $profPic = $data['usr_prof_pic'];
        }
    ?>

    <!--Sidebar nav-->
    <div id="jsNavMenu" class="sidebar-menu">
        <a class="closeBtn" onclick="closeNav()">
            <i class="ri-close-large-fill"></i>
        </a>
        <a href="home_page.php" class="sbr-link-menu">
            <i class="ri-home-9-fill" id="sidebar-icon"></i>
            <span class="link-text">Home</span>
        </a>
        <a href="package_page.php" class="sbr-link-menu">
            <i class="ri-suitcase-fill" id="sidebar-icon"></i>
            <span class="link-text">Packages</span>
        </a>
        <a href="infoMainPage.php" class="sbr-link-menu">
            <i class="ri-global-line" id="sidebar-icon"></i>
            <span class="link-text">Info Site</span>
        </a>
        <a href="blogMainPage.php" class="sbr-link-menu">
            <i class="ri-article-fill" id="sidebar-icon"></i>
            <span class="link-text">Blogs</span>
        </a>
        <a href="about_us.php" class="sbr-link-menu">
            <i class="ri-information-2-fill" id="sidebar-icon"></i>
            <span class="link-text">About</span>
        </a>
        <?php
            if (isset($_SESSION['SES_UserID'])) {
                if ($role != "Tourist") {
        ?>
                    <a href="./staff_dashboard/Staff_Dashboard.php" class="sbr-link-menu">
                        <i class="ri-dashboard-horizontal-fill" id="sidebar-icon"></i>
                        <span class="link-text">Staff Dashboard</span>
                    </a>
        <?php
            } else {
        ?>
                    <a href="feedbackForm.php" class="sbr-link-menu">
                        <i class="ri-questionnaire-fill" id="sidebar-icon"></i>
                        <span class="link-text">Feedback</span>
                    </a>
        <?php
                }
            }
        ?>

        <?php
            if (isset($_SESSION['SES_UserID'])) {
        ?>
                <a href="accountDashboard.php" class="sbr-link-menu2">
                    <i class="ri-account-circle-fill" id="sidebar-icon"></i>
                    <span class="link-text">Acc: <?php echo $name;?></span>
                </a> 
                <a href="#" class="sbr-link-menu2" onclick="document.getElementById('delPopup').style.display='block'">
                    <i class="ri-logout-box-fill" id="sidebar-icon"></i>
                    <span class="link-text">Logout</span>
                </a>                       
        <?php
            } else {
        ?>
                <a href="registerTouristPage.php" class="sbr-link-menu2">
                    <i class="ri-user-add-fill" id="sidebar-icon"></i>
                    <span class="link-text">Register</span>
                </a>
                <a href="touristLoginPage.php" class="sbr-link-menu2">
                    <i class="ri-login-box-fill" id="sidebar-icon"></i>
                    <span class="link-text">Login</span>
                </a>
        <?php
            }
        ?>
    </div>
    
    <!-- Main header-->
    <header class="header" id="startPage">
        <nav class="header-navbar">
            <i class="ri-menu-2-line" id="hamburger-menu" onclick="openNav()"></i>
            <div class="nav-logo">
                <a href="index.php">
                    <img src="./img/logo/Tourlaysia_Logo_transp.png" alt="Tourlaysia Logo" class="header-logo">
                </a>
                <a href="index.php" class="tourlaysia">Tourlaysia</a>
                <span class="slogan"> - Gateway to MY Journey</span>
            </div>
            <ul class="nav-list">
                <li class="nav-item">
                    <a href="home_page.php" class="header-link">
                        <i class="ri-home-9-fill" style="font-size:1.2rem;" id="header-icon"></i>
                        <span class="link-text">Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="package_page.php" class="header-link">
                        <i class="ri-suitcase-fill" style="font-size:1.2rem;" id="header-icon"></i>
                        <span class="link-text">Packages</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="infoMainPage.php" class="header-link">
                        <i class="ri-global-line" style="font-size:1.2rem;" id="header-icon"></i>
                        <span class="link-text">Info Site</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="blogMainPage.php" class="header-link">
                        <i class="ri-article-fill" style="font-size:1.2rem;" id="header-icon"></i>
                        <span class="link-text">Blogs</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="about_us.php" class="header-link">
                        <i class="ri-information-2-fill" style="font-size:1.2rem;" id="header-icon"></i>
                        <span class="link-text">About</span>
                    </a>
                </li>
                <?php
                    if (isset($_SESSION['SES_UserID'])) {
                        if ($role != "Tourist") {
                    ?>
                            <li class="nav-item">
                                <a href="./staff_dashboard/Staff_Dashboard.php" class="header-link">
                                    <i class="ri-dashboard-horizontal-fill" style="font-size:1.2rem;" id="header-icon"></i>
                                    <span class="link-text">Staff Dashboard</span>
                                </a>
                            </li>
                    <?php
                        } else {
                    ?>
                            <li class="nav-item">
                                <a href="feedbackForm.php" class="header-link">
                                    <i class="ri-questionnaire-fill" style="font-size:1.2rem;" id="header-icon"></i>
                                    <span class="link-text">Feedback</span>
                                </a>
                            </li>
                <?php
                        }
                    }
                ?>
            </ul>
            <div class="nav-profile">
                <?php
                    if (isset($_SESSION['SES_UserID'])) {
                ?>
                        <?php
                            if ($profPic != NULL) {
                        ?>
                                <img src="./img/profile/<?php echo $profPic;?>" alt="Profile Picture" class="profile-pic" onerror="this.onerror=null; this.src='./img/anonymous.png'">
                        <?php
                            } else {
                        ?>
                                <img src="./img/anonymous.png" alt="Profile Picture" class="profile-pic">
                        <?php
                            }
                        ?>
                        <a href="accountDashboard.php" class="username">
                            <span class="name-text"><?php echo $name;?></span>
                            <i class="ri-corner-up-right-fill" id="acc-arrow"></i>
                        </a> 
                        <a href="#" class="username" onclick="document.getElementById('delPopup').style.display='block'">
                            <span class="name-text">Logout</span>
                            <i class="ri-logout-box-fill" id="acc-arrow"></i>
                        </a>                       
                <?php
                    } else {
                ?>
                        <button onclick="document.location='registerTouristPage.php';" class="profile-btn">
                            <i class="ri-user-add-fill"></i>
                            Register
                        </button>
                        <button onclick="document.location='touristLoginPage.php';" class="profile-btn">
                            <i class="ri-login-box-fill"></i>
                            Login
                        </button>
                <?php
                    }
                ?>
            </div>
        </nav>
    </header>

    <div id="delPopup" class="popupBox">
        <i onclick="document.getElementById('delPopup').style.display='none'" class="ri-close-large-fill closeIcon"></i>
        <form action="" method="POST" class="popup-form" >
            <div class="popup-form-div">
                <h1>Log Out Account</h1>
                <p>Are you sure you want to log out your user account? <span>Your session will be terminated.</span></p>
            
                <div class="clearfix">
                    <input type="button" onclick="document.getElementById('delPopup').style.display='none'" class="cancelbtn" value="Cancel">
                    <input type="submit" name="logOutAccount" onclick="document.getElementById('delPopup').style.display='none'" class="deletebtn" value="Log Out">
                </div>
            </div>
        </form>
    </div>

    <!-- JavaScript for log out popup box-->
    <script src="./js/popupBox.js"></script>

    <script>
        function openNav() {
            document.getElementById("jsNavMenu").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("jsNavMenu").style.width = "0";
        }
    </script>

    <!-- If user confirms log out -->
    <?php
        if(isset($_POST['logOutAccount'])) {
            include './crud/logout_account.php';
        }
    ?>
</body>
</html>
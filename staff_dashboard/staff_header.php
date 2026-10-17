<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: staff_header.php -->
<!-- Description: To create and display a universal header for Tourlaysia website in staff pages. -->
<!-- Date first written: 9/7/2025 -->
<!-- Date last modified: 9/7/2025 -->

<?php
    @session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="../img/logo/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css">
    <link rel="stylesheet" href="./staff_styles/staff_styles.css">
    <link rel="stylesheet" href="./staff_styles/staff_header.css">
    <link rel="stylesheet" href="./staff_styles/logout_popup.css">
</head>
<body>
    <?php
        include './staff_crud/db_connection.php'; // Connect database

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
        <a href="Staff_Dashboard.php" class="sbr-link-menu">
            <i class="ri-dashboard-fill" id="sidebar-icon"></i>
            <span class="link-text">Dashboard</span>
        </a>

        <?php
            if($role == "Admin") {
        ?>

                <a href="manageUser.php" class="sbr-link-menu">
                    <i class="ri-user-3-fill" id="sidebar-icon"></i>
                    <span class="link-text">Accounts</span>
                </a>
        <?php
            }
        ?>
        <?php
            if($role == "Admin" || $role == "Office staff") {
        ?>
                <a href="manageBooking.php" class="sbr-link-menu">
                    <i class="ri-book-2-fill" id="sidebar-icon"></i>
                    <span class="link-text">Bookings</span>
                </a>
                <a href="manageBillPaymentReceipt.php" class="sbr-link-menu">
                    <i class="ri-currency-fill" id="sidebar-icon"></i>
                    <span class="link-text">Finances</span>
                </a>
                <a href="manageTripSchedule.php" class="sbr-link-menu">
                    <i class="ri-calendar-schedule-fill" id="sidebar-icon"></i>
                    <span class="link-text">Schedules</span>
                </a>
                <a href="manageFeedback.php" class="sbr-link-menu">
                    <i class="ri-feedback-fill" id="sidebar-icon"></i>
                    <span class="link-text">Feedbacks</span>
                </a>
        <?php
            }
        ?>
        <?php
            if($role == "Tour guide" || $role == "Bus driver") {
        ?>
                <a href="viewTripSchedule.php" class="sbr-link-menu">
                    <i class="ri-calendar-schedule-fill" id="sidebar-icon"></i>
                    <span class="link-text">View Schedules</span>
                </a>        
        <?php
            }
        ?>
        <?php
            if($role == "Tour guide") {
        ?>
                <a href="Mark_attendance1.php" class="sbr-link-menu">
                    <i class="ri-mark-pen-fill" id="sidebar-icon"></i>
                    <span class="link-text">Mark Attendance</span>
                </a>
        <?php
            }
        ?>
        <a href="../home_page.php" class="sbr-link-menu">
            <i class="ri-home-9-fill" id="sidebar-icon"></i>
            <span class="link-text">To Home</span>
        </a>
        <?php
            if (isset($_SESSION['SES_UserID'])) {
        ?>
                <a href="../accountDashboard.php" class="sbr-link-menu2">
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
                <a href="../staffLoginPage.php" class="sbr-link-menu2">
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
                <a href="../index.php">
                    <img src="../img/logo/Tourlaysia_Logo_transp.png" alt="Tourlaysia Logo" class="header-logo">
                </a>
                <a href="../index.php" class="tourlaysia">Tourlaysia</a>
                <span class="slogan"> - Gateway to MY Journey</span>
            </div>
            <ul class="nav-list">
                <li class="nav-item">
                    <a href="Staff_Dashboard.php" class="header-link">
                        <i class="ri-dashboard-fill" style="font-size:1.2rem;" id="header-icon"></i>
                        <span class="link-text">Dashboard</span>
                    </a>
                </li>
                <?php
                    if($role == "Admin") {
                ?>
                        <li class="nav-item">
                            <a href="manageUser.php" class="header-link">
                                <i class="ri-user-3-fill" style="font-size:1.2rem;" id="header-icon"></i>
                                <span class="link-text">Accounts</span>
                            </a>
                        </li>                      
                <?php
                    }
                ?>
                <?php
                    if($role == "Admin" || $role == "Office staff") {
                ?>
                        <li class="nav-item">
                            <a href="manageBooking.php" class="header-link">
                                <i class="ri-book-2-fill" style="font-size:1.2rem;" id="header-icon"></i>
                                <span class="link-text">Bookings</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="manageBillPaymentReceipt.php" class="header-link">
                                <i class="ri-currency-fill" style="font-size:1.2rem;" id="header-icon"></i>
                                <span class="link-text">Finances</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="manageFeedback.php" class="header-link">
                                <i class="ri-feedback-fill" style="font-size:1.2rem;" id="header-icon"></i>
                                <span class="link-text">Feedbacks</span>
                            </a>
                        </li>
                <?php
                    }
                ?>
                <?php
                    if($role == "Office staff") {
                ?>
                        <li class="nav-item">
                            <a href="manageTripSchedule.php" class="header-link">
                                <i class="ri-calendar-schedule-fill" style="font-size:1.2rem;" id="header-icon"></i>
                                <span class="link-text">Schedules</span>
                            </a>
                        </li>
                <?php
                    }
                ?>
                <?php
                    if($role == "Tour guide" || $role == "Bus driver") {
                ?>
                        <li class="nav-item">
                            <a href="viewTripSchedule.php" class="header-link">
                                <i class="ri-calendar-schedule-fill" style="font-size:1.2rem;" id="header-icon"></i>
                                <span class="link-text">View Schedules</span>
                            </a>
                        </li>
                <?php
                    }
                ?>
                <?php
                    if($role == "Tour guide") {
                ?>
                        <li class="nav-item">
                            <a href="Mark_attendance1.php" class="header-link">
                                <i class="ri-mark-pen-fill" style="font-size:1.2rem;" id="header-icon"></i>
                                <span class="link-text">Mark Attendance</span>
                            </a>
                        </li>
                <?php
                    }
                ?>
                <li class="nav-item">
                    <a href="../home_page.php" class="header-link">
                        <i class="ri-home-9-fill" style="font-size:1.2rem;" id="header-icon"></i>
                        <span class="link-text">To Home</span>
                    </a>
                </li>
            </ul>
            <div class="nav-profile">
                <?php
                    if (isset($_SESSION['SES_UserID'])) {
                ?>
                        <?php
                            if ($profPic != NULL) {
                        ?>
                                <img src="../img/profile/<?php echo $profPic;?>" alt="Profile Picture" class="profile-pic">
                        <?php
                            } else {
                        ?>
                                <img src="../img/anonymous.png" alt="Profile Picture" class="profile-pic">
                        <?php
                            }
                        ?>
                        <a href="../accountDashboard.php" class="username">
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
                        <button href="../staffLoginPage.php" class="profile-btn">
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
    <script src="./staff_js/popupBox.js"></script>

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
            include './staff_crud/logout_account.php';
        }
    ?>
</body>
</html>
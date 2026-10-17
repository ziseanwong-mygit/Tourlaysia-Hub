<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: staff_footer.php -->
<!-- Description: To create and display a universal footer for Tourlaysia website in staff pages. -->
<!-- Date first written: 9/7/2025 -->
<!-- Date last modified: 9/7/2025 -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="../img/logo/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css">
    <link rel="stylesheet" href="./staff_styles/staff_styles.css">
    <link rel="stylesheet" href="./staff_styles/staff_footer.css">
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

    <footer class="footer" id="endPage">
        <div class="topBtnDiv">
            <i class="ri-arrow-up-double-line" style="font-size:1.2rem;" id="footer-icon"></i>
            <a href="#" class="back-to-top-txt">Back to Top</a>
        </div>
        <nav class="footer-navbar">
            <ul class="main-list">
                <li class="main-item">
                    <a href="../Staff_Dashboard.php" class="footer-link">
                        <i class="ri-dashboard-fill" style="font-size:1.2rem;" id="footer-icon"></i>
                        <span class="link-text">Dashboard</span>
                    </a>
                </li>
                <?php
                    if($role == "Admin") {
                ?>
                        <li class="main-item">
                            <a href="manageUser.php" class="footer-link">
                                <i class="ri-user-3-fill" style="font-size:1.2rem;" id="footer-icon"></i>
                                <span class="link-text">Accounts</span>
                            </a>
                        </li>
                <?php
                    }
                ?>
                <?php
                    if($role == "Admin" || $role == "Office staff") {
                ?>
                        <li class="main-item">
                            <a href="manageBooking.php" class="footer-link">
                                <i class="ri-book-2-line" style="font-size:1.2rem;" id="footer-icon"></i>
                                <span class="link-text">Bookings</span>
                            </a>
                        </li>
                        <li class="main-item">
                            <a href="manageBillPaymentReceipt.php" class="footer-link">
                                <i class="ri-currency-fill" style="font-size:1.2rem;" id="footer-icon"></i>
                                <span class="link-text">Finances</span>
                            </a>
                        </li>
                        <li class="main-item">
                            <a href="manageTripSchedule.php" class="footer-link">
                                <i class="ri-calendar-schedule-fill" style="font-size:1.2rem;" id="footer-icon"></i>
                                <span class="link-text">Schedules</span>
                            </a>
                        </li>
                        <li class="main-item">
                            <a href="manageFeedback.php" class="footer-link">
                                <i class="ri-feedback-fill" style="font-size:1.2rem;" id="footer-icon"></i>
                                <span class="link-text">Feedbacks</span>
                            </a>
                        </li>
                <?php
                    }
                ?>
                <?php
                    if($role == "Tour guide" || $role == "Bus driver") {
                ?>
                        <li class="main-item">
                            <a href="viewTripSchedule.php" class="footer-link">
                                <i class="ri-calendar-schedule-fill" style="font-size:1.2rem;" id="footer-icon"></i>
                                <span class="link-text">View Schedules</span>
                            </a>
                        </li>
                <?php
                    }
                ?>
                <?php
                    if($role == "Tour guide") {
                ?>
                        <li class="main-item">
                            <a href="Mark_attendance1.php" class="footer-link">
                                <i class="ri-mark-pen-fill"  style="font-size:1.2rem;" id="footer-icon"></i>
                                <span class="link-text">Mark Attendance</span>
                            </a>
                        </li>
                <?php
                    }
                ?>
                <li class="main-item">
                    <a href="../home_page.php" class="footer-link">
                        <i class="ri-home-9-fill" style="font-size:1.2rem;" id="footer-icon"></i>
                        <span class="link-text">To Home</span>
                    </a>
                </li>
            </ul>

            <div class="footer-website">
                <a href="index.php">
                    <img src="../img/logo/Tourlaysia_Logo_transp.png" alt="Tourlaysia Logo" class="footer-logo">
                </a>
                <a href="index.php" class="footer-webname">Tourlaysia</a>
                <span class="footer-slogan">Gateway to MY Journey</span>
            </div>

            <ul class="package-list">
                <li class="package-item">
                    <a href="../home_page.php" class="footer-link">
                        <i class="ri-home-9-fill" style="font-size:1.2rem;" id="footer-icon"></i>
                        <span class="link-text">Home</span>
                    </a>
                </li>
                <li class="package-item">
                    <a href="../package_page.php" class="footer-link">
                        <i class="ri-suitcase-fill" style="font-size:1.2rem;" id="footer-icon"></i>
                        <span class="link-text">Packages</span>
                    </a>
                </li>
                <li class="package-item">
                    <a href="../infoMainPage.php" class="footer-link">
                        <i class="ri-global-line" style="font-size:1.2rem;" id="footer-icon"></i>
                        <span class="link-text">Info Site</span>
                    </a>
                </li>
                <li class="package-item">
                    <a href="../blogMainPage.php" class="footer-link">
                        <i class="ri-article-fill" style="font-size:1.2rem;" id="footer-icon"></i>
                        <span class="link-text">Blogs</span>
                    </a>
                </li>
                <li class="package-item">
                    <a href="../about_us.php" class="footer-link">
                        <i class="ri-information-2-fill" style="font-size:1.2rem;" id="footer-icon"></i>
                        <span class="link-text">About Us</span>
                    </a>
                </li>
                <li class="package-item">
                    <a href="../help_support.php" class="footer-link">
                        <i class="ri-contacts-fill" style="font-size:1.2rem;" id="footer-icon"></i>
                        <span class="link-text">Contact Us</span>
                    </a>
                </li>
                <li class="package-item">
                    <a href="../feedbackForm.php" class="footer-link">
                        <i class="ri-questionnaire-fill" style="font-size:1.2rem;" id="footer-icon"></i>
                        <span class="link-text">Feedback Form</span>
                    </a>
                </li>
            </ul>
        </nav>
        <h5 class="contact-title">Find us for more:</h5>
        <div class="footer-contact-div">
            <span class="footer-contact">
                <i class="ri-phone-fill"></i>
                +60123456789
            </span>
            <span class="contact-divider">|</span>
            <span class="footer-contact">
                <i class="ri-mail-fill"></i>
                tourlaysia_official@email.com
            </span>
            <span class="contact-divider">|</span>
            <span class="footer-contact">
                <i class="ri-facebook-circle-fill"></i>
                TourlaysiaFB
            </span>
            <span class="contact-divider">|</span>
            <span class="footer-contact">
                <i class="ri-instagram-fill"></i>
                TourlaysiaIG
            </span>
            <span class="contact-divider">|</span>
            <span class="footer-contact">
                <i class="ri-tiktok-fill"></i>
                TourlaysiaTikTok
            </span>
        </div>
        <hr class="footer-line">
        <div class="footer-note-div">
            <span class="footer-note">Created by The Peaky Blinders - Capstone Project 04/25. Powered by XAMPP. Made in Malaysia 🌺.</span>
        </div>
    </footer>
</body>
</html>
<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: footer.php -->
<!-- Description: To create and display a universal footer for Tourlaysia website. -->
<!-- Date first written: 18/6/2025 -->
<!-- Date last modified: 28/6/2025 -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="./img/logo/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css">
    <link rel="stylesheet" href="./styles/styles.css">
    <link rel="stylesheet" href="./styles/footer.css">
</head>
<body>
    <footer class="footer" id="endPage">
        <div class="topBtnDiv">
            <i class="ri-arrow-up-double-line" style="font-size:1.2rem;" id="footer-icon"></i>
            <a href="#" class="back-to-top-txt">Back to Top</a>
        </div>
        <nav class="footer-navbar">
            <ul class="main-list">
                <li class="main-item">
                    <a href="home_page.php" class="footer-link">
                        <i class="ri-home-9-fill" style="font-size:1.2rem;" id="footer-icon"></i>
                        <span class="link-text">Home</span>
                    </a>
                </li>
                <li class="main-item">
                    <a href="package_page.php" class="footer-link">
                        <i class="ri-suitcase-fill" style="font-size:1.2rem;" id="footer-icon"></i>
                        <span class="link-text">Packages</span>
                    </a>
                </li>
                <li class="main-item">
                    <a href="infoMainPage.php" class="footer-link">
                        <i class="ri-global-line" style="font-size:1.2rem;" id="footer-icon"></i>
                        <span class="link-text">Info Site</span>
                    </a>
                </li>
                <li class="main-item">
                    <a href="blogMainPage.php" class="footer-link">
                        <i class="ri-article-fill" style="font-size:1.2rem;" id="footer-icon"></i>
                        <span class="link-text">Blogs</span>
                    </a>
                </li>
                <li class="main-item">
                    <a href="about_us.php" class="footer-link">
                        <i class="ri-information-2-fill" style="font-size:1.2rem;" id="footer-icon"></i>
                        <span class="link-text">About Us</span>
                    </a>
                </li>
                <li class="main-item">
                    <a href="help_support.php" class="footer-link">
                        <i class="ri-contacts-fill" style="font-size:1.2rem;" id="footer-icon"></i>
                        <span class="link-text">Contact Us</span>
                    </a>
                </li>
                <?php
                    if(isset($_SESSION['SES_UserID'])) {
                ?>
                        <li class="main-item">
                            <a href="feedbackForm.php" class="footer-link">
                                <i class="ri-questionnaire-fill" style="font-size:1.2rem;" id="footer-icon"></i>
                                <span class="link-text">Feedback Form</span>
                            </a>
                        </li>
                <?php
                    }
                ?>
            </ul>

            <div class="footer-website">
                <a href="index.php">
                    <img src="./img/logo/Tourlaysia_Logo_transp.png" alt="Tourlaysia Logo" class="footer-logo">
                </a>
                <a href="index.php" class="footer-webname">Tourlaysia</a>
                <span class="footer-slogan">Gateway to MY Journey</span>
            </div>

            <ul class="package-list">
                <li class="package-item">
                    <a href="package_results.php?filterWord=Kuala Lumpur" class="footer-link">
                        <i class="ri-map-pin-fill" style="font-size:1.2rem;" id="footer-icon"></i>
                        <span class="link-text">Kuala Lumpur</span>
                    </a>
                </li>
                <li class="package-item">
                    <a href="package_results.php?filterWord=Ipoh" class="footer-link">
                        <i class="ri-map-pin-fill" style="font-size:1.2rem;" id="footer-icon"></i>
                        <span class="link-text">Ipoh</span>
                    </a>
                </li>
                <li class="package-item">
                    <a href="package_results.php?filterWord=George Town" class="footer-link">
                        <i class="ri-map-pin-fill" style="font-size:1.2rem;" id="footer-icon"></i>
                        <span class="link-text">George Town</span>
                    </a>
                </li>
                <li class="package-item">
                    <a href="package_results.php?filterWord=Pulau Redang" class="footer-link">
                        <i class="ri-map-pin-fill" style="font-size:1.2rem;" id="footer-icon"></i>
                        <span class="link-text">Pulau Redang</span>
                    </a>
                </li>
                <li class="package-item">
                    <a href="package_results.php?filterWord=Kuching" class="footer-link">
                        <i class="ri-map-pin-fill" style="font-size:1.2rem;" id="footer-icon"></i>
                        <span class="link-text">Kuching</span>
                    </a>
                </li>
                <li class="package-item">
                    <a href="package_results.php?filterWord=Kota Kinabalu" class="footer-link">
                        <i class="ri-map-pin-fill" style="font-size:1.2rem;" id="footer-icon"></i>
                        <span class="link-text">Kota Kinabalu</span>
                    </a>
                </li>
                <li class="package-item">
                    <a href="package_results.php?keyword=All" class="footer-link">
                        <i class="ri-corner-down-right-line" style="font-size:1.2rem;" id="footer-icon"></i>
                        <span class="link-text">More Destinations</span>
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
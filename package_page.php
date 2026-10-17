<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: package_page.php -->
<!-- Description: To create card carousels and display tour packages to users. -->
<!-- Date first written: 14/6/2025 -->
<!-- Date last modified: 13/7/2025 -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="./img/logo/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css">
    <link rel="stylesheet" href="./styles/styles.css">
    <link rel="stylesheet" href="./styles/package_page.css">
    <!--"Defer" attribute is used to wait for browser to finish loading before script-->
    <script src="./js/packageCarousel.js" defer></script> 
</head>
<body>
    <?php include 'header.php';?>
    <?php include 'nav_bar.php';?>

    <?php
        include './crud/db_connection.php'; // Connect database
    ?>

    <div class="packageHeader">
        <h1>Tourlaysia Package Main Menu</h1>
        <div class="pkgHeadDesc">
            <p>
                We provide comprehensive lists of Malaysia tour packages that are categorized in recommended, latest and all sections. You may browse the packages in the carousel by <mark>dragging the cards, clicking the buttons, and scrolling the package description to view more info.</mark>
            </p>
        </div>
    </div>

    <div class="carouselBody">
        <section class="packageSection">
            <i class="ri-arrow-left-s-line" id="carouselArrowLeft"></i>
            <div class="carouselHeader">
                <h1 class="carouselHeadTitle">Recommended Packages</h1>
                <button class="carouselMoreBtn" onclick="document.location='package_results.php?keyword=Recommended';">
                    More Packages
                    <i class="ri-more-fill"></i>
                </button>
            </div>
            <ul class="packageCarousel">
                <?php
                    // Find out which package is the most booked from the tour_booking_t
                    $query2 = "SELECT p.pkg_ID, p.pkg_title, p.pkg_desc, p.pkg_img, COUNT(b.pkg_ID) AS total_bookings FROM tour_package_t p LEFT JOIN tour_booking_t b ON p.pkg_ID = b.pkg_ID GROUP BY p.pkg_ID, p.pkg_title ORDER BY total_bookings DESC;";
                    $results2 = mysqli_query($connection, $query2);
                    while($data2 = mysqli_fetch_assoc($results2)) {
                        $pkgID = $data2['pkg_ID'];
                        $pkgTitle = $data2['pkg_title'];
                        $pkgDesc = $data2['pkg_desc'];
                        $pkgImgList = $data2['pkg_img'];

                        $imgList = explode(',', $pkgImgList);
                ?>
                        <li class="packageCard">
                            <div class="cardDiv">
                                <div class="packageImageDiv">
                                    <img width="300" height="160" src="./img/package/<?php echo $imgList[0]?>" alt="Tour Package Pic" class="packageImg" draggable="false">
                                </div>
                                <h3 class="packageTitle">
                                    <a href="#"><?php echo $pkgTitle?></a>
                                </h3>
                                <div class="packageDescDiv">
                                    <span class="packageDesc"><?php echo $pkgDesc;?></span>
                                </div>
                                <div class="cardBtnDiv">
                                    <button class="cardBtn" onclick="document.location='package_info.php?pkgID=<?php echo $pkgID;?>';" id="btnView">
                                        <i class="ri-eye-fill"></i>
                                        View info
                                    </button>
                                <?php
                                    if (isset($_SESSION['SES_UserID'])) {
                                ?>
                                        <button class="cardBtn" onclick="document.location='bookingFormPage1.php?pkgID=<?php echo $pkgID?>';" id="btnBook">
                                            <i class="ri-arrow-right-up-line"></i>
                                            Book now
                                        </button>
                                <?php
                                    }
                                ?>                                    
                                </div>
                            </div>
                        </li>
                <?php
                    }
                ?>          
            </ul>
            <i class="ri-arrow-right-s-line" id="carouselArrowRight"></i>
        </section>
    </div>

    <div class="carouselBody">
        <section class="packageSection2">
            <i class="ri-arrow-left-s-line" id="carouselArrowLeft2"></i>
            <div class="carouselHeader">
                <h1 class="carouselHeadTitle">Latest Packages</h1>
                <button class="carouselMoreBtn" onclick="document.location='package_results.php?keyword=Latest';">
                    More Packages
                    <i class="ri-more-fill"></i>
                </button>
            </div>
            <ul class="packageCarousel2">
                <?php
                    $query2 = "SELECT * FROM tour_package_t ORDER BY trv_period ASC;";
                    $results2 = mysqli_query($connection, $query2);
                    while($data2 = mysqli_fetch_assoc($results2)) {
                        $pkgID = $data2['pkg_ID'];
                        $pkgTitle = $data2['pkg_title'];
                        $pkgDesc = $data2['pkg_desc'];
                        $pkgImgList = $data2['pkg_img'];

                        $imgList = explode(',', $pkgImgList);
                ?>
                        <li class="packageCard2">
                            <div class="cardDiv">
                                <div class="packageImageDiv">
                                    <img width="300" height="160" src="./img/package/<?php echo $imgList[0]?>" alt="Tour Package Pic" class="packageImg" draggable="false">
                                </div>
                                <h3 class="packageTitle">
                                    <a href="#"><?php echo $pkgTitle?></a>
                                </h3>
                                <div class="packageDescDiv">
                                    <span class="packageDesc"><?php echo $pkgDesc;?></span>
                                </div>
                                <div class="cardBtnDiv">
                                    <button class="cardBtn" onclick="document.location='package_info.php?pkgID=<?php echo $pkgID;?>';" id="btnView">
                                        <i class="ri-eye-fill"></i>
                                        View info
                                    </button>
                                <?php
                                    if (isset($_SESSION['SES_UserID'])) {
                                ?>                                
                                        <button class="cardBtn" onclick="document.location='bookingFormPage1.php?pkgID=<?php echo $pkgID?>';" id="btnBook">
                                            <i class="ri-arrow-right-up-line"></i>
                                            Book now
                                        </button>
                                <?php
                                    }
                                ?>                               
                                </div>
                            </div>
                        </li>
                <?php
                    }
                ?>       
            </ul>
            <i class="ri-arrow-right-s-line" id="carouselArrowRight"></i>
        </section>
    </div>
    
    <div class="carouselBody">
        <section class="packageSection3">
            <i class="ri-arrow-left-s-line" id="carouselArrowLeft3"></i>
            <div class="carouselHeader">
                <h1 class="carouselHeadTitle">All Packages</h1>
                <button class="carouselMoreBtn" onclick="document.location='package_results.php?keyword=All';">
                    More Packages
                    <i class="ri-more-fill"></i>
                </button>
            </div>
            <ul class="packageCarousel3">
                <?php
                    $query2 = "SELECT * FROM tour_package_t;";
                    $results2 = mysqli_query($connection, $query2);
                    while($data2 = mysqli_fetch_assoc($results2)) {
                        $pkgID = $data2['pkg_ID'];
                        $pkgTitle = $data2['pkg_title'];
                        $pkgDesc = $data2['pkg_desc'];
                        $pkgImgList = $data2['pkg_img'];

                        $imgList = explode(',', $pkgImgList);
                ?>
                        <li class="packageCard3">
                            <div class="cardDiv">
                                <div class="packageImageDiv">
                                    <img width="300" height="160" src="./img/package/<?php echo $imgList[0]?>" alt="Tour Package Pic" class="packageImg" draggable="false">
                                </div>
                                <h3 class="packageTitle">
                                    <a href="#"><?php echo $pkgTitle?></a>
                                </h3>
                                <div class="packageDescDiv">
                                    <span class="packageDesc"><?php echo $pkgDesc;?></span>
                                </div>
                                <div class="cardBtnDiv">
                                    <button class="cardBtn" onclick="document.location='package_info.php?pkgID=<?php echo $pkgID;?>';" id="btnView">
                                        <i class="ri-eye-fill"></i>
                                        View info
                                    </button>
                                <?php
                                    if (isset($_SESSION['SES_UserID'])) {
                                ?>                                
                                        <button class="cardBtn" onclick="document.location='bookingFormPage1.php?pkgID=<?php echo $pkgID?>';" id="btnBook">
                                            <i class="ri-arrow-right-up-line"></i>
                                            Book now
                                        </button>
                                <?php
                                    }
                                ?>                                
                                </div>
                            </div>
                        </li>
                <?php
                    }
                ?>         
            </ul>
            <i class="ri-arrow-right-s-line" id="carouselArrowRight"></i>
        </section>
    </div>
    <?php include 'footer.php';?>
</body>
</html>
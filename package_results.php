<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: package_results.php -->
<!-- Description: To create a webpage for displaying the tour packages based on searches and filters, using cards in grid layout-->
<!-- Date first written: 8/7/2025 -->
<!-- Date last modified: 8/7/2025 -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="./img/logo/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="./styles/styles.css">
    <link rel="stylesheet" href="./styles/package_results.css">
</head>
<body>
    <?php include 'header.php';?>
    <?php include 'nav_bar.php';?>

    <?php
        include './crud/db_connection.php'; // Connect database
    ?>

    <div class="results-title-div">
        <?php
            if (isset($_GET['searchWord'])) {
        ?>
                <?php
                    $searchWord = $_GET['searchWord'];
                    // Get how many records found
                    $query3 = "SELECT COUNT(*) AS NumofRecord FROM tour_package_t WHERE pkg_ID LIKE '%$searchWord%' OR pkg_title LIKE '%$searchWord%' OR pkg_desc LIKE '%$searchWord%' OR pkg_dest LIKE '%$searchWord%' OR trv_dura LIKE '%$searchWord%' OR trv_period LIKE '%$searchWord%' OR pkg_price LIKE '%$searchWord%' OR pkg_transp LIKE '%$searchWord%' OR pkg_act LIKE '%$searchWord%' OR pkg_perks LIKE '%$searchWord%';";
                    $results3 = mysqli_query($connection, $query3);
                    $data3 = mysqli_fetch_assoc($results3);
                    $totalResults = $data3['NumofRecord'];
                ?>

                <div class="results-title-desc">
                    <h1 class="results-title">Tour Package Search Results</h1>
                    <h4 class="results-desc"><?php echo $totalResults;?> Search Results for "<?php echo $_GET['searchWord'];?>"</h4>
                </div>
        <?php
            } else if (isset($_GET['filterWord'])) {
        ?>
                <div class="results-title-desc">
                    <h1 class="results-title">Tour Package Filter Results</h1>
                    <h4 class="results-desc">Filtered packages with word "<?php echo $_GET['filterWord'];?>"</h4>
                </div>
        <?php
            } else {
                if ($_GET['keyword'] == "Recommended") {
        ?>
                    <div class="results-title-desc">
                        <h1 class="results-title">List of Recommended Tour Packages</h1>
                        <h4 class="results-desc">Here are the tour packages recommended by us to new tourists!</h4>
                    </div>
        <?php
                } else if ($_GET['keyword'] == "Latest") {
        ?>
                    <div class="results-title-desc">
                        <h1 class="results-title">List of Latest Tour Packages</h1>
                        <h4 class="results-desc">Here are the latest tour packages created by us to explore new tours!</h4>
                    </div>
        <?php
                } else {
        ?>
                    <div class="results-title-desc">
                        <h1 class="results-title">All Tour Packages</h1>
                        <h4 class="results-desc">Here are all the available tour packages offered by us to you! </h4>
                    </div>      
        <?php              
                }
            }
        ?>
    </div>

    <main class="pkg-grid-container">
    <?php
        if (isset($_GET['searchWord'])) {
    ?>
            <?php
                $query2 = "SELECT * FROM tour_package_t WHERE pkg_ID LIKE '%$searchWord%' OR pkg_title LIKE '%$searchWord%' OR pkg_desc LIKE '%$searchWord%' OR pkg_dest LIKE '%$searchWord%' OR trv_dura LIKE '%$searchWord%' OR trv_period LIKE '%$searchWord%' OR pkg_price LIKE '%$searchWord%' OR pkg_transp LIKE '%$searchWord%' OR pkg_act LIKE '%$searchWord%' OR pkg_perks LIKE '%$searchWord%';";
                $results2 = mysqli_query($connection, $query2);
                while($data2 = mysqli_fetch_assoc($results2)) {
                    $pkgID = $data2['pkg_ID'];
                    $pkgTitle = $data2['pkg_title'];
                    $pkgDesc = $data2['pkg_desc'];
                    $pkgDest = $data2['pkg_dest'];
                    $trvPeriod = $data2['trv_period'];
                    $pkgPrice = $data2['pkg_price'];
                    $pkgImgList = $data2['pkg_img'];

                    $imgList = explode(',', $pkgImgList);
            ?>
                    <div class="pkg-grid-card">
                        <div class="package-pic-div">
                            <img src="./img/package/<?php echo $imgList[0]?>" width="300" height="160" alt="Package Picture" class="package-pic">
                        </div>    
                        <div class="pkg-title-div">   
                            <a href="#" class="pkg-title"><?php echo $pkgTitle;?></a>
                        </div>
                        <div class="pkg-desc-div">
                            <p class="pkg-desc"><?php echo $pkgDesc;?></p>
                        </div>
                        <div class="pkg-info-div">
                            <p class="pkg-info"><b class="pkg-label">Destination: </b><?php echo $pkgDest;?></p>
                            <p class="pkg-info"><b class="pkg-label">Period: </b><?php echo $trvPeriod;?></p>
                            <p class="pkg-info"><b class="pkg-label">Cost: </b><?php echo $pkgPrice;?></p>
                        </div>
                        <div class="pkg-btn-div">
                            <button class="pkg-act-btn" onclick="document.location='package_info.php?pkgID=<?php echo $pkgID;?>';" id="btnView">
                                <i class="ri-eye-fill"></i>
                                View package
                            </button>
                        <?php
                            if (isset($_SESSION['SES_UserID'])) {
                        ?>                        
                                <button class="pkg-act-btn" onclick="document.location='bookingFormPage1.php?pkgID=<?php echo $pkgID?>';" id="btnBook">
                                    <i class="ri-arrow-right-up-line"></i>
                                    Book package
                                </button>
                        <?php
                            }
                        ?>                        
                        </div>
                    </div>
            <?php
                }
            ?>
    <?php
        } else if (isset($_GET['filterWord'])) {
    ?>
            <?php
                $filterWord = $_GET['filterWord'];
                $query2 = "SELECT * FROM tour_package_t WHERE pkg_title LIKE '%$filterWord%' OR pkg_desc LIKE '%$filterWord%' OR pkg_dest LIKE '%$filterWord%' OR trv_dura LIKE '%$filterWord%' OR trv_period LIKE '%$filterWord%' OR pkg_transp LIKE '%$filterWord%' OR pkg_act LIKE '%$filterWord%' OR pkg_perks LIKE '%$filterWord%';";
                $results2 = mysqli_query($connection, $query2);
                while($data2 = mysqli_fetch_assoc($results2)) {
                    $pkgID = $data2['pkg_ID'];
                    $pkgTitle = $data2['pkg_title'];
                    $pkgDesc = $data2['pkg_desc'];
                    $pkgDest = $data2['pkg_dest'];
                    $trvPeriod = $data2['trv_period'];
                    $pkgPrice = $data2['pkg_price'];
                    $pkgImgList = $data2['pkg_img'];

                    $imgList = explode(',', $pkgImgList);
            ?>
                    <div class="pkg-grid-card">
                        <div class="package-pic-div">
                            <img src="./img/package/<?php echo $imgList[0]?>" width="300" height="160" alt="Package Picture" class="package-pic">
                        </div>    
                        <div class="pkg-title-div">   
                            <a href="#" class="pkg-title"><?php echo $pkgTitle;?></a>
                        </div>
                        <div class="pkg-desc-div">
                            <p class="pkg-desc"><?php echo $pkgDesc;?></p>
                        </div>
                        <div class="pkg-info-div">
                            <p class="pkg-info"><b class="pkg-label">Destination: </b><?php echo $pkgDest;?></p>
                            <p class="pkg-info"><b class="pkg-label">Period: </b><?php echo $trvPeriod;?></p>
                            <p class="pkg-info"><b class="pkg-label">Cost: </b><?php echo $pkgPrice;?></p>
                        </div>
                        <div class="pkg-btn-div">
                            <button class="pkg-act-btn" onclick="document.location='package_info.php?pkgID=<?php echo $pkgID;?>';" id="btnView">
                                <i class="ri-eye-fill"></i>
                                View package
                            </button>
                        <?php
                            if (isset($_SESSION['SES_UserID'])) {
                        ?>
                                <button class="pkg-act-btn" onclick="document.location='bookingFormPage1.php?pkgID=<?php echo $pkgID?>';" id="btnBook">
                                    <i class="ri-arrow-right-up-line"></i>
                                    Book package
                                </button>
                        <?php
                            }
                        ?>
                        </div>
                    </div>
            <?php
                }
            ?>
    <?php
        } else {
            if ($_GET['keyword'] == "Recommended") {
    ?>
            <?php
                $query2 = "SELECT p.pkg_ID, p.pkg_title, p.pkg_desc, p.pkg_dest, p.trv_period, p.pkg_price, p.pkg_img, COUNT(b.pkg_ID) AS total_bookings FROM tour_package_t p LEFT JOIN tour_booking_t b ON p.pkg_ID = b.pkg_ID GROUP BY p.pkg_ID, p.pkg_title ORDER BY total_bookings DESC;";
                $results2 = mysqli_query($connection, $query2);
                while($data2 = mysqli_fetch_assoc($results2)) {
                    $pkgID = $data2['pkg_ID'];
                    $pkgTitle = $data2['pkg_title'];
                    $pkgDesc = $data2['pkg_desc'];
                    $pkgDest = $data2['pkg_dest'];
                    $trvPeriod = $data2['trv_period'];
                    $pkgPrice = $data2['pkg_price'];
                    $pkgImgList = $data2['pkg_img'];

                    $imgList = explode(',', $pkgImgList);
            ?>
                    <div class="pkg-grid-card">
                        <div class="package-pic-div">
                            <img src="./img/package/<?php echo $imgList[0]?>" width="300" height="160" alt="Package Picture" class="package-pic">
                        </div>    
                        <div class="pkg-title-div">   
                            <a href="#" class="pkg-title"><?php echo $pkgTitle;?></a>
                        </div>
                        <div class="pkg-desc-div">
                            <p class="pkg-desc"><?php echo $pkgDesc;?></p>
                        </div>
                        <div class="pkg-info-div">
                            <p class="pkg-info"><b class="pkg-label">Destination: </b><?php echo $pkgDest;?></p>
                            <p class="pkg-info"><b class="pkg-label">Period: </b><?php echo $trvPeriod;?></p>
                            <p class="pkg-info"><b class="pkg-label">Cost: </b><?php echo $pkgPrice;?></p>
                        </div>
                        <div class="pkg-btn-div">
                            <button class="pkg-act-btn" onclick="document.location='package_info.php?pkgID=<?php echo $pkgID;?>';" id="btnView">
                                <i class="ri-eye-fill"></i>
                                View package
                            </button>
                        <?php
                            if (isset($_SESSION['SES_UserID'])) {
                        ?>
                                <button class="pkg-act-btn" onclick="document.location='bookingFormPage1.php?pkgID=<?php echo $pkgID?>';" id="btnBook">
                                    <i class="ri-arrow-right-up-line"></i>
                                    Book package
                                </button>
                        <?php
                            }
                        ?>
                        </div>
                    </div>
            <?php
                }
            ?>
    <?php
            } else if ($_GET['keyword'] == "Latest") {
    ?>
            <?php
                $query2 = "SELECT * FROM tour_package_t ORDER BY trv_period ASC;";
                $results2 = mysqli_query($connection, $query2);
                while($data2 = mysqli_fetch_assoc($results2)) {
                    $pkgID = $data2['pkg_ID'];
                    $pkgTitle = $data2['pkg_title'];
                    $pkgDesc = $data2['pkg_desc'];
                    $pkgDest = $data2['pkg_dest'];
                    $trvPeriod = $data2['trv_period'];
                    $pkgPrice = $data2['pkg_price'];
                    $pkgImgList = $data2['pkg_img'];

                    $imgList = explode(',', $pkgImgList);
            ?>
                    <div class="pkg-grid-card">
                        <div class="package-pic-div">
                            <img src="./img/package/<?php echo $imgList[0]?>" width="300" height="160" alt="Package Picture" class="package-pic">
                        </div>    
                        <div class="pkg-title-div">   
                            <a href="#" class="pkg-title"><?php echo $pkgTitle;?></a>
                        </div>
                        <div class="pkg-desc-div">
                            <p class="pkg-desc"><?php echo $pkgDesc;?></p>
                        </div>
                        <div class="pkg-info-div">
                            <p class="pkg-info"><b class="pkg-label">Destination: </b><?php echo $pkgDest;?></p>
                            <p class="pkg-info"><b class="pkg-label">Period: </b><?php echo $trvPeriod;?></p>
                            <p class="pkg-info"><b class="pkg-label">Cost: </b><?php echo $pkgPrice;?></p>
                        </div>
                        <div class="pkg-btn-div">
                            <button class="pkg-act-btn" onclick="document.location='package_info.php?pkgID=<?php echo $pkgID;?>';" id="btnView">
                                <i class="ri-eye-fill"></i>
                                View package
                            </button>
                    <?php
                        if (isset($_SESSION['SES_UserID'])) {
                    ?>
                            <button class="pkg-act-btn" onclick="document.location='bookingFormPage1.php?pkgID=<?php echo $pkgID?>';" id="btnBook">
                                <i class="ri-arrow-right-up-line"></i>
                                Book package
                            </button>                            
                    <?php
                        }
                    ?>
                        </div>
                    </div>
            <?php
                }
            ?>
    <?php
            } else {
    ?>
            <?php
                $query2 = "SELECT * FROM tour_package_t;";
                $results2 = mysqli_query($connection, $query2);
                while($data2 = mysqli_fetch_assoc($results2)) {
                    $pkgID = $data2['pkg_ID'];
                    $pkgTitle = $data2['pkg_title'];
                    $pkgDesc = $data2['pkg_desc'];
                    $pkgDest = $data2['pkg_dest'];
                    $trvPeriod = $data2['trv_period'];
                    $pkgPrice = $data2['pkg_price'];
                    $pkgImgList = $data2['pkg_img'];

                    $imgList = explode(',', $pkgImgList);
            ?>
                    <div class="pkg-grid-card">
                        <div class="package-pic-div">
                            <img src="./img/package/<?php echo $imgList[0]?>" width="300" height="160" alt="Package Picture" class="package-pic">
                        </div>    
                        <div class="pkg-title-div">   
                            <a href="#" class="pkg-title"><?php echo $pkgTitle;?></a>
                        </div>
                        <div class="pkg-desc-div">
                            <p class="pkg-desc"><?php echo $pkgDesc;?></p>
                        </div>
                        <div class="pkg-info-div">
                            <p class="pkg-info"><b class="pkg-label">Destination: </b><?php echo $pkgDest;?></p>
                            <p class="pkg-info"><b class="pkg-label">Period: </b><?php echo $trvPeriod;?></p>
                            <p class="pkg-info"><b class="pkg-label">Cost: </b><?php echo $pkgPrice;?></p>
                        </div>
                        <div class="pkg-btn-div">
                            <button class="pkg-act-btn" onclick="document.location='package_info.php?pkgID=<?php echo $pkgID;?>';" id="btnView">
                                <i class="ri-eye-fill"></i>
                                View package
                            </button>
                        <?php
                            if (isset($_SESSION['SES_UserID'])) {
                        ?>                    
                                <button class="pkg-act-btn" onclick="document.location='bookingFormPage1.php?pkgID=<?php echo $pkgID?>';" id="btnBook">
                                    <i class="ri-arrow-right-up-line"></i>
                                    Book package
                                </button>
                        <?php
                            }
                        ?>
                        </div>
                    </div>
            <?php
                }
            ?>    
    <?php              
            }
        }
    ?>  
    </main>
    <?php include 'footer.php';?>
</body>
</html>
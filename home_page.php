<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: home_page.php -->
<!-- Description: To create homepage to allow users to view their bookings, itineraries, recommended packages, feedback form and perform other actions through buttons . -->
<!-- Date first written: 8/7/2025 -->
<!-- Date last modified: 13/7/2025 -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="./img/logo/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="./styles/styles.css">
    <link rel="stylesheet" href="./styles/home_page.css">
    <link rel="stylesheet" href="./styles/logout_popup.css">
    <script src="./js/homeCarousel.js" defer></script> 
</head>
<body>
    <?php include 'header.php';?>
    <?php include 'nav_bar.php';?>

    <?php
        include './crud/db_connection.php'; // Connect database

        if (isset($_SESSION['SES_UserID'])) {
            $refUserID = $_SESSION['SES_UserID']; // Retrieve user ID with session variable

            // Select record and store value
            $query = "SELECT * FROM user_account_t WHERE usr_ID = '$refUserID';";
            $results = mysqli_query($connection, $query);
            $data = mysqli_fetch_assoc($results);
        
            $role = $data['usr_role'];
            $name = $data['usr_name'];
            $email = $data['usr_email'];
            $noTel = $data['usr_no_tel'];
            $profPic = $data['usr_prof_pic'];
        }
    ?>

    <div class="home-title-desc">
        <h1 class="home-title">Discover Malaysia with Tourlaysia</h1>
        <?php 
            if(isset($_SESSION['SES_UserID'])) {
        ?>
                <p class="home-desc">Welcome back, Traveller <span><?php echo $name;?></span>! You can explore more packages, view your list of bookings and account, submit feedback and perform other actions as well in one go.</p>
        <?php
            } else {
        ?>
                <p class="home-desc">
                    This is your home page. <a href="registerTouristPage.php">Create a new account</a> or <a href="touristLoginPage.php">log in your account</a> to start your adventure!
                </p>
        <?php        
            }
        ?>
    </div>

    <main class="main-container">
        <aside class="account-sidebar">
            <?php
                if(isset($_SESSION['SES_UserID'])) {
            ?>
                    <div class="sidebar-info-div">
                        <?php
                            if ($profPic != NULL) {
                        ?>
                                <div class="sidebar-img-div">
                                    <img width="120" height="150" src="./img/profile/<?php echo $profPic;?>" alt="Profile picture" onerror="this.onerror=null; this.src='./img/anonymous.png'" class="sidebar-img loginpic">
                                </div>
                        <?php
                            } else {
                        ?>
                                <div class="sidebar-img-div">
                                    <img width="120" height="150" src="./img/anonymous.png" alt="Anonymous picture" class="sidebar-img">
                                </div>
                        <?php
                            }
                        ?>
                        <div class="info-text-div logininfo">
                            <span class="accInfo"><b class="accLabel">User Role: </b><?php echo $role;?></span>
                            <span class="accInfo"><b class="accLabel">Username: </b><?php echo $name;?></span>
                            <span class="accInfo"><b class="accLabel">Email: </b><?php echo $email;?></span>
                            <span class="accInfo"><b class="accLabel">No. Tel: </b><?php echo $noTel;?></span>
                        </div>
                    </div>
                    <div class="sidebar-btn-div">
                        <button class="sidebar-btn accDashBtn" onclick="document.location='accountDashboard.php';">
                            <i class="ri-user-add-fill"></i>
                            Account Dashboard
                        </button>
                        <button class="sidebar-btn editBtn" onclick="document.location='editMyProfilePage.php';">
                            <i class="ri-edit-2-fill"></i>
                            Edit Account
                        </button>
                        <button class="sidebar-btn delBtn" onclick="document.getElementById('delPopup2').style.display='block'">
                            <i class="ri-delete-bin-6-fill"></i>
                            Delete Account
                        </button>
                        <button class="sidebar-btn logoutBtn" onclick="document.getElementById('delPopup').style.display='block'">
                            <i class="ri-logout-box-fill"></i>
                            Log out Account
                        </button>
                    </div>
            <?php
                } else {
            ?>
                    <div class="sidebar-info-div">
                        <div class="sidebar-img-div">
                            <img width="120" height="150" src="./img/anonymous.png" alt="Anonymous picture" class="sidebar-img">
                        </div>
                        <div class="info-text-div">
                            <span class="accInfo"><b class="accLabel">User Role: </b>-</span>
                            <span class="accInfo"><b class="accLabel">Username: </b>-</span>
                            <span class="accInfo"><b class="accLabel">Email: </b>-</span>
                            <span class="accInfo"><b class="accLabel">No. Tel: </b>-</span>
                        </div>
                    </div>
                    <div class="sidebar-btn-div">
                        <button class="sidebar-btn registerBtn" onclick="document.location='registerTouristPage.php';">
                            <i class="ri-user-add-fill"></i>
                            Register Account
                        </button>
                        <button class="sidebar-btn loginBtn" onclick="document.location='touristLoginPage.php';">
                            <i class="ri-login-box-fill"></i>
                            Log in Account
                        </button>
                    </div>
            <?php
                }
            ?>
        </aside>        

        <section class="action-section">
            <h2 class="header-title">
                List of Actions
            </h2>
            <div class="action-btn-div">
                <?php
                    if(isset($_SESSION['SES_UserID'])) {
                ?>
                        <button class="actionBtn" onclick="document.location='moreBookings.php';">
                            <i class="ri-arrow-right-up-line"></i>
                            Manage Bookings
                        </button>
                        <button class="actionBtn" onclick="document.location='moreItineraries.php';">
                            <i class="ri-arrow-right-up-line"></i>
                            Manage Itineraries
                        </button>
                        <?php
                            if($role != "Tourist") {
                        ?>
                                <button class="actionBtn" onclick="document.location='./staff_dashboard/Staff_Dashboard.php';">
                                    <i class="ri-arrow-right-up-line"></i>
                                    Go to Staff Dashboard
                                </button>
                        <?php
                            }
                        ?>
                        <!--
                        <button class="actionBtn" onclick="document.location='#';">
                            <i class="ri-arrow-right-up-line"></i>
                            View Trip Schedule
                        </button>
                        -->
                <?php
                    }
                ?>
                <button class="actionBtn" onclick="document.location='package_page.php';">
                    <i class="ri-arrow-right-up-line"></i>
                    Explore Tour Packages
                </button>
                <button class="actionBtn" onclick="document.location='infoMainPage.php';">
                    <i class="ri-arrow-right-up-line"></i>
                    Visit Info Site
                </button>
                <button class="actionBtn" onclick="document.location='blogMainPage.php';">
                    <i class="ri-arrow-right-up-line"></i>
                    Visit Blog Page
                </button>
            </div>
        </section>

        <section class="feedback-section">
            <div class="feedback-header">
                <h2 class="header-title">
                    Submit Your Feedback
                </h2>
            </div>
            <form action="" method="POST">
                <textarea name="feedbackContent" id="feedbackArea" placeholder="Type your feedback for us to read!" required></textarea>
                <br>
                <button type="submit" name="feedbackSend">
                    <i class="ri-send-plane-fill"></i>
                    Send Feedback
                </button>
            </form>
        </section>

        <?php
            if(isset($_SESSION['SES_UserID'])) {
        ?>
        <section class="bookings-section">
            <div class="bookings-header">
                <h2 class="header-title2">Your Bookings</h2>
                <?php
                    $query0 = "SELECT * FROM tour_booking_t WHERE usr_ID = '$refUserID';";
                    $results0 = mysqli_query($connection, $query0);
                    if (mysqli_num_rows($results0) == 0) {
                        // No button displayed
                    } else {
                ?>
                        <button class="moreBtn" onclick="document.location='moreBookings.php';">More bookings <i class="ri-more-fill"></i></button>
                <?php
                    }
                ?>             
            </div>
            <div class="booking-carousel">
                <div class="carouselDiv">
                    <i class="ri-arrow-left-s-line" id="carouselArrowLeft"></i>
                    <ul class="carouselList">
                        <?php
                            $query3 = "SELECT * FROM tour_booking_t WHERE usr_ID = '$refUserID';";
                            $results3 = mysqli_query($connection, $query3);
                            if (mysqli_num_rows($results3) == 0) {
                        ?>
                                <li class="carouselCard">
                                    <div class="cardDiv">
                                        <h3 class="carouselTitle">
                                            <a href="#">No booking</a>
                                        </h3>
                                        <div class="carouselDescDiv">
                                            <span class="carouselDesc">Please create a booking to get started!</span>
                                        </div>
                                        <div class="carouselBookInfo">
                                            <span class="bookInfo"><b class="bookLabel">ID: </b>-</span>
                                            <span class="bookInfo"><b class="bookLabel">Date: </b>-</span>
                                            <span class="bookInfo"><b class="bookLabel">Dest: </b>-</span>
                                            <span class="bookInfo"><b class="bookLabel">Pax: </b>-</span>
                                            <span class="bookInfo"><b class="bookLabel">Status: </b>-</span>
                                        </div>
                                    </div>
                                </li>
                        <?php
                            } else {
                                while($data3 = mysqli_fetch_assoc($results3)) {
                                    $bknID = $data3['bkn_ID'];
                                    $bknTitle = $data3['bkn_title'];
                                    $bknDesc = $data3['bkn_desc'];
                                    $pkgDest = $data3['pkg_dest'];
                                    $bknDate = $data3['bkn_date'];
                                    $numPax = $data3['num_pax'];
                                    $bknStatus = $data3['bkn_status'];

                                    $query6 = "SELECT itr_ID FROM itinerary_t WHERE bkn_ID = '$bknID';";
                                    $results6 = mysqli_query($connection, $query6);
                                    $data6 = mysqli_fetch_assoc($results6);
                                    $itrID = $data6 ? $data6['itr_ID'] : null;
                        ?>
                                    <li class="carouselCard">
                                        <div class="cardDiv">
                                            <h3 class="carouselTitle">
                                                <a href="#"><?php echo $bknTitle;?></a>
                                            </h3>
                                            <div class="carouselDescDiv">
                                                <span class="carouselDesc"><?php echo $bknDesc?></span>
                                            </div>
                                            <div class="carouselBookInfo">
                                                <span class="bookInfo"><b class="bookLabel">ID: </b><?php echo $bknID?></span>
                                                <span class="bookInfo"><b class="bookLabel">Date: </b><?php echo $bknDate?></span>
                                                <span class="bookInfo"><b class="bookLabel">Dest: </b><?php echo $pkgDest?></span>
                                                <span class="bookInfo"><b class="bookLabel">Pax: </b><?php echo $numPax?></span>
                                                <span class="bookInfo"><b class="bookLabel">Status: </b><?php echo $bknStatus?></span>
                                            </div>
                                            <div class="cardBtnDiv">
                                                <button class="cardBtn" onclick="document.location='viewBookingPage.php?bkn_ID=<?php echo $bknID?>';" id="btnBookView">
                                                    <i class="ri-eye-fill"></i>
                                                    View info
                                                </button>
                                                <?php
                                                    if ($itrID != NULL) {
                                                ?>
                                                        <button class="cardBtn" onclick="document.location='viewItineraryPage.php?itr_ID=<?php echo $itrID?>';" id="btnBookItin">
                                                            <i class="ri-file-list-3-fill"></i>
                                                            View Itinerary
                                                        </button>
                                                <?php
                                                    } else {
                                                ?>
                                                        <button class="cardBtn" onclick="document.location='itinerary_formOne.php?bknID=<?php echo $bknID?>&pkgDest=<?php echo $pkgDest?>';" id="btnBookItin">
                                                            <i class="ri-file-list-3-fill"></i>
                                                            Customize Itinerary
                                                        </button>
                                                <?php
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </li>
                        <?php
                                }
                            }
                        ?>
                    </ul>
                    <i class="ri-arrow-right-s-line" id="carouselArrowRight"></i>    
                </div>
            </div>    
        </section>

        <section class="bills-section">
            <div class="bills-header">
                <h2 class="header-title3">Your Bills</h2>
                <?php
                    $query0 = "SELECT * FROM bill_rec_t WHERE usr_ID = '$refUserID';";
                    $results0 = mysqli_query($connection, $query0);
                    if (mysqli_num_rows($results0) == 0) {
                        // No button displayed
                    } else {
                ?>
                        <button class="moreBtn" onclick="document.location='moreBills.php';">More bills <i class="ri-more-fill"></i></button>
                <?php
                    }
                ?>
            </div>
            <div class="bills-carousel">
                <div class="carouselDiv3">
                    <i class="ri-arrow-left-s-line" id="carouselArrowLeft3"></i>
                    <ul class="carouselList3">
                        <?php
                            $query4 = "SELECT * FROM bill_rec_t b LEFT JOIN payment_rec_t p ON b.bil_ID = p.bil_ID WHERE b.usr_ID = '$refUserID' OR p.pyt_status IS NULL OR p.pyt_status != 'Complete';";
                            $results4 = mysqli_query($connection, $query4);
                            if (mysqli_num_rows($results4) == 0) {
                        ?>
                                <li class="carouselCard3">
                                    <div class="cardDiv">
                                        <h3 class="carouselTitle">
                                            <a href="#">No bill</a>
                                        </h3>
                                        <div class="carouselDescDiv">
                                            <span class="carouselDesc">It seems the staff has not added any bills...</span>
                                        </div>
                                        <div class="carouselBookInfo">
                                            <span class="bookInfo"><b class="bookLabel">Item Name: </b>-</span>
                                            <span class="bookInfo"><b class="bookLabel">Quantity: </b>-</span>
                                            <span class="bookInfo"><b class="bookLabel">Price: </b>-</span>
                                        </div>
                                        <div class="carouselBookInfo">
                                            <span class="bookInfo"><b class="bookLabel">Subtotal: </b>-</span>
                                            <span class="bookInfo"><b class="bookLabel">Service: </b>-</span>
                                            <span class="bookInfo"><b class="bookLabel">Additional: </b>-</span>
                                            <span class="bookInfo"><b class="bookLabel">Total: </b>-</span>
                                        </div>
                                    </div>
                                </li>
                        <?php
                            } else {
                                while($data4 = mysqli_fetch_assoc($results4)) {
                                    $billID = $data4['bil_ID'];
                                    $subtotal = $data4['sbt_amount'];
                                    $serviceCh = $data4['svc_charge'];
                                    $addCh = $data4['add_charge'];
                                    $total = $data4['tot_amount'];
                                    $staffName = $data4['stf_name'];
                        ?>
                                    <li class="carouselCard">
                                        <div class="cardDiv">
                                            <h3 class="carouselTitle">
                                                <a href="#"><?php echo $billID;?></a>
                                            </h3>
                                            <?php
                                                $query5 = "SELECT * FROM bill_item_list_t WHERE bil_ID = '$billID';";
                                                $results5 = mysqli_query($connection, $query5);
                                                if (mysqli_num_rows($results5) == 0) {
                                            ?>
                                                    <div class="carouselDescDiv">
                                                        <span class="carouselDesc">No bill items</span>
                                                    </div>
                                            <?php
                                                } else {
                                                    while($data5 = mysqli_fetch_assoc($results5)) {
                                                        $itemName = $data5['item_name'];
                                                        $itemQty = $data5['item_qty'];
                                                        $itemPrice = $data5['item_pri'];
                                            ?> 
                                                        <div class="carouselBookInfo">
                                                            <span class="bookInfo"><b class="bookLabel">Item Name: </b><?php echo $itemName?></span>
                                                            <span class="bookInfo"><b class="bookLabel">Quantity: </b><?php echo $itemQty?></span>
                                                            <span class="bookInfo"><b class="bookLabel">Price: </b><?php echo $itemPrice?></span>
                                                        </div>
                                            <?php
                                                    }
                                                }
                                            ?>
                                            <div class="carouselBookInfo">
                                                <span class="bookInfo"><b class="bookLabel">Subtotal: </b><?php echo $subtotal?></span>
                                                <span class="bookInfo"><b class="bookLabel">Service: </b><?php echo $serviceCh?></span>
                                                <span class="bookInfo"><b class="bookLabel">Additional: </b><?php echo $addCh?></span>
                                                <span class="bookInfo"><b class="bookLabel">Total: </b><?php echo $total?></span>
                                            </div>
                                            <div class="cardBtnDiv">
                                                <button class="cardBtn" onclick="document.location='viewBillPage.php?billID=<?php echo $billID;?>';" id="btnBookView">
                                                    <i class="ri-eye-fill"></i>
                                                    View info
                                                </button>
                                                <button class="cardBtn" onclick="document.location='payment1.php?billID=<?php echo $billID;?>';" id="btnBookItin">
                                                    <i class="ri-bank-card-fill"></i>
                                                    Make payment
                                                </button>
                                            </div>
                                        </div>
                                    </li>
                        <?php
                                }
                            }
                        ?>
                    </ul>
                    <i class="ri-arrow-right-s-line" id="carouselArrowRight3"></i>    
                </div>
            </div>    
        </section>
        <?php
            }
        ?>

        <section class="packages-section">
            <div class="packages-header">
                <h2 class="header-title2">Tour Package Shop</h2>
                <button class="moreBtn" onclick="document.location='package_page.php';">More Packages <i class="ri-more-fill"></i></button>
            </div>
            <div class="package-carousel">
                <div class="carouselDiv2">
                    <i class="ri-arrow-left-s-line" id="carouselArrowLeft2"></i>
                    <ul class="carouselList2">
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
                            <li class="carouselCard2">
                                <div class="cardDiv">
                                    <div class="carouselImageDiv">
                                        <img width="300" height="160" src="./img/package/<?php echo $imgList[0]?>" alt="Tour Package Pic" class="carouselImg" draggable="false">
                                    </div>
                                    <h3 class="carouselTitle">
                                        <a href="#"><?php echo $pkgTitle;?></a>
                                    </h3>
                                    <div class="carouselDescDiv">
                                        <span class="carouselDesc"><?php echo $pkgDesc?></span>
                                    </div>
                                    <div class="cardBtnDiv">
                                        <button class="cardBtn" onclick="document.location='package_info.php?pkgID=<?php echo $pkgID;?>';" id="btnPkgView">
                                            <i class="ri-eye-fill"></i>
                                            View info
                                        </button>
                                        <?php
                                            if (isset($_SESSION['SES_UserID'])) {
                                        ?>                                    
                                            <button class="cardBtn" onclick="document.location='bookingFormPage1.php?pkgID=<?php echo $pkgID?>';" id="btnPkgBook">
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
                    <i class="ri-arrow-right-s-line" id="carouselArrowRight2"></i>    
                </div>
            </div> 
        </section>
    </main>

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

    <div id="delPopup2" class="popupBox">
        <i onclick="document.getElementById('delPopup2').style.display='none'" class="ri-close-large-fill closeIcon"></i>
        <form action="" method="POST" class="popup-form" >
            <div class="popup-form-div">
                <h1>Delete Account</h1>
                <p>Are you sure you want to delete your user account? <span>You will be logged out after deleting account.</span></p>
            
                <div class="clearfix">
                    <input type="button" onclick="document.getElementById('delPopup2').style.display='none'" class="cancelbtn" value="Cancel">
                    <input type="submit" name="deleteAccount" onclick="document.getElementById('delPopup2').style.display='none'" class="deletebtn" value="Delete">
                </div>
            </div>
        </form>
    </div>
    

    <!-- JavaScript for popup box-->
    <script src="./js/popupBox.js"></script>

    <!-- If user confirms log out -->
    <!-- If user submits feedback -->
    <!-- If user deletes account -->
    <?php
        if(isset($_POST['feedbackSend'])) {
            include './crud/send_feedback.php';
        }
        
        if(isset($_POST['logOutAccount'])) {
            include './crud/logout_account.php';
        }

        if(isset($_POST['deleteAccount'])) {
            include './crud/delete_account.php';
        }
    ?>

    <?php include 'footer.php';?>
</body>
</html>
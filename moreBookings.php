<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: moreBookings.php -->
<!-- Description: To create a webpage for displaying the tour bookings using cards in grid layout-->
<!-- Date first written: 14/7/2025 -->
<!-- Date last modified: 14/7/2025 -->

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
        $usrID = $_SESSION['SES_UserID'];
    ?>

    <div class="results-title-div">
        <div class="results-title-desc">
            <h1 class="results-title">Your Tour Bookings</h1>
            <h4 class="results-desc">Here are all of the tour bookings you have made previously!</h4>
        </div>
    </div>

    <main class="pkg-grid-container">
        <?php
            $query2 = "SELECT * FROM tour_booking_t WHERE usr_ID = '$usrID';";
            $results2 = mysqli_query($connection, $query2);
            while($data2 = mysqli_fetch_assoc($results2)) {
                $bknID = $data2['bkn_ID'];
                $bknTitle = $data2['bkn_title'];
                $bknDesc = $data2['bkn_desc'];
                $pkgDest = $data2['pkg_dest'];
                $bknDate = $data2['bkn_date'];
                $numPax = $data2['num_pax'];
                $bknStatus = $data2['bkn_status'];

                $query6 = "SELECT itr_ID FROM itinerary_t WHERE bkn_ID = '$bknID';";
                $results6 = mysqli_query($connection, $query6);
                $data6 = mysqli_fetch_assoc($results6);
                $itrID = $data6 ? $data6['itr_ID'] : null;
        ?>
                <div class="pkg-grid-card"> 
                    <div class="pkg-title-div">   
                        <a href="#" class="pkg-title"><?php echo $bknTitle;?></a>
                    </div>
                    <div class="pkg-desc-div">
                        <p class="pkg-desc"><?php echo $bknDesc;?></p>
                    </div>
                    <div class="pkg-info-div">
                        <p class="pkg-info"><b class="pkg-label">ID: </b><?php echo $bknID;?></p>
                        <p class="pkg-info"><b class="pkg-label">Date: </b><?php echo $bknDate;?></p>
                        <p class="pkg-info"><b class="pkg-label">Dest: </b><?php echo $pkgDest;?></p>
                        <p class="pkg-info"><b class="pkg-label">Pax: </b><?php echo $numPax;?></p>
                        <p class="pkg-info"><b class="pkg-label">Status: </b><?php echo $bknStatus;?></p>
                    </div>
                    <div class="pkg-btn-div">
                        <button class="pkg-act-btn" onclick="document.location='viewBookingPage.php?bkn_ID=<?php echo $bknID?>';" id="btnView">
                            <i class="ri-eye-fill"></i>
                            View info
                        </button>
                        <?php
                            if ($itrID != NULL) {
                        ?>
                                <button class="pkg-act-btn" onclick="document.location='viewItineraryPage.php?itr_ID=<?php echo $itrID?>';" id="btnBook">
                                    <i class="ri-file-list-3-fill"></i>
                                    View Itinerary
                                </button>
                        <?php
                            } else {
                        ?>
                                <button class="pkg-act-btn" onclick="document.location='itinerary_formOne.php?bknID=<?php echo $bknID?>&pkgDest=<?php echo $pkgDest?>';" id="btnBook">
                                    <i class="ri-file-list-3-fill"></i>
                                    Customize Itinerary
                                </button>
                        <?php
                            }
                        ?>                       
                    </div>
                </div>
    <?php
            }
    ?>  
    </main>
    <?php include 'footer.php';?>
</body>
</html>
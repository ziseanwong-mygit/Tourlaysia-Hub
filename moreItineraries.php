<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: moreItineraries.php -->
<!-- Description: To create a webpage for displaying the itineraries using cards in grid layout-->
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
            $query = "SELECT * FROM itinerary_t WHERE usr_ID = '$usrID';";
            $results = mysqli_query($connection, $query);
            while($data = mysqli_fetch_assoc($results)) {
                $refID = $data['itr_ID'];
                $refbknID = $data['bkn_ID'];
                $refName = $data['usr_name'];
                $refItrTitle = $data['itr_title'];
                $refItrDesc = $data['itr_desc'];
                $refItrStartDate = $data['itr_start_date'];
                $refItrEndDate = $data['itr_end_date'];
                $refItrDest = $data['itr_dest'];
                $refItrRemark = $data['itr_remark'];
        ?>
                <div class="pkg-grid-card"> 
                    <div class="pkg-title-div">   
                        <a href="#" class="pkg-title"><?php echo $refItrTitle;?></a>
                    </div>
                    <div class="pkg-desc-div">
                        <p class="pkg-desc"><?php echo $refItrDesc;?></p>
                    </div>
                    <div class="pkg-info-div">
                        <p class="pkg-info"><b class="pkg-label">Book ID: </b><?php echo $refbknID;?></p>
                        <p class="pkg-info"><b class="pkg-label">Start Date: </b><?php echo $refItrStartDate;?></p>
                        <p class="pkg-info"><b class="pkg-label">End Date: </b><?php echo $refItrEndDate;?></p>
                        <p class="pkg-info"><b class="pkg-label">Dest: </b><?php echo $refItrDest;?></p>
                        <p class="pkg-info"><b class="pkg-label">Remark: </b><?php echo $refItrRemark;?></p>
                    </div>
                    <div class="pkg-btn-div">
                        <button class="pkg-act-btn" onclick="document.location='viewItineraryPage.php?itr_ID=<?php echo $refID?>';" id="btnView">
                            <i class="ri-eye-fill"></i>
                            View itinerary
                        </button>  
                        <button class="pkg-act-btn" onclick="document.location='viewBookingPage.php?bkn_ID=<?php echo $refbknID?>';" id="btnView">
                            <i class="ri-eye-fill"></i>
                            View booking
                        </button>                      
                    </div>
                </div>
    <?php
            }
    ?>  
    </main>
    <?php include 'footer.php';?>
</body>
</html>
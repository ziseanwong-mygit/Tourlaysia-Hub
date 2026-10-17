<!-- Programmer Name: Seath Tan Ziren & Wong Zi Sean - Group Members of Peaky Blinders, AAPP011-4-2 Capstone Project
Project Name: viewBookingPage.php
Description: To create view itinerary page to allow users to view the itinerary of their trip.
Date first written: 14/6/2025
Date last modified: 13/7/2025 -->

<?php
    session_start();
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="./img/logo/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="./styles/styles.css">
    <link rel="stylesheet" href="./styles/viewBook_ItinPage.css">
</head>
<body>
    <?php
        include('./crud/db_connection.php');
        include('header.php');

        $getUserID = $_SESSION['SES_UserID'];
        $getBknID = $_GET["bkn_ID"];
        
        $query = "SELECT * FROM tour_booking_t WHERE bkn_ID = '$getBknID';";
        $results = mysqli_query($connection, $query);
        $data = mysqli_fetch_assoc($results);

        $refBknID = $data['bkn_ID'];
        $refPkgID = $data['pkg_ID'];
        $refPkgDest = $data['pkg_dest'];
        $refUsrDocID = $data['usr_doc_ID'];
        $refUsrName = $data['usr_name'];
        $refUsrEmail = $data['usr_email'];
        $refUsrNoTel = $data['usr_no_tel'];
        $refBknTitle = $data['bkn_title'];
        $refBknDesc = $data['bkn_desc'];
        $refBknDate = $data['bkn_date'];
        $refNumPax = $data['num_pax'];
        $refBknRemark = $data['bkn_remark'];
        $refBknStatus = $data['bkn_status'];

        $query2 = "SELECT * FROM tour_package_t WHERE pkg_ID = '$refPkgID';";
        $results2 = mysqli_query($connection, $query2);
        $data2 = mysqli_fetch_assoc($results2);

        $refPkgTitle = $data2['pkg_title'];
        $refTrvPeriod = $data2['trv_period'];
        $refPkgPrice = $data2['pkg_price'];

        $query6 = "SELECT itr_ID FROM itinerary_t WHERE bkn_ID = '$refBknID';";
        $results6 = mysqli_query($connection, $query6);
        $data6 = mysqli_fetch_assoc($results6);
        $itrID = $data6 ? $data6['itr_ID'] : null;
    ?>
    <div class="page-wrapper">
        <div class="container">
            <h1 class="title"><?php echo $refBknTitle;?></h1>
            <p class="description"><?php echo $refBknDesc;?></p>

            <h2 class="subheading">General Info</h2>
            <div class="details">
                <p><strong>Booking ID: </strong><?php echo $refBknID;?></p>
                <p><strong>IC Num/Passport ID: </strong><?php echo $refUsrDocID;?></p>
                <p><strong>Booker Name: </strong><?php echo $refUsrName;?></p>
                <p><strong>Email Address: </strong><?php echo $refUsrEmail;?></p>
                <p><strong>No Tel: </strong><?php echo $refUsrNoTel;?></p>
                <?php
                    if ($itrID != NULL) {
                ?>
                        <button class="action-btn" onclick="document.location='viewItineraryPage.php?itr_ID=<?php echo $itrID?>';" id="btnBookItin">
                            <i class="ri-file-list-3-fill"></i>
                            View Itinerary
                        </button>
                <?php
                    } else {
                ?>
                        <button class="action-btn" onclick="document.location='itinerary_formOne.php?bknID=<?php echo $refBknID?>&pkgDest=<?php echo $refPkgDest?>';" id="btnBookItin">
                            <i class="ri-file-list-3-fill"></i>
                            Customize Itinerary
                        </button>
                <?php
                    }
                ?>
            </div>

            <h2 class="subheading">Booking Info</h2>
            <div class="details">
                <p><strong>Booking Title: </strong><?php echo $refBknTitle;?></p>
                <p><strong>Booking Desc: </strong><?php echo $refBknDesc;?></p>
                <p><strong>Booking Date: </strong><?php echo $refBknDate;?></p>
                <p><strong>Number Pax: </strong><?php echo $refNumPax;?></p>
                <p><strong>Remark: </strong><?php echo $refBknRemark;?></p>
                <p>
                    <strong>Status: </strong>
                    <span
                        <?php 
                        if ($refBknStatus == "Confirmed"){
                            echo "style='color:green;'";
                        }   
                        else if ($refBknStatus == "Pending") {
                            echo "style='color:blue;'";
                        }
                        else {
                            echo "style='color:red;'";
                        }
                    ?>
                    >
                        <?php echo $refBknStatus;?>
                    </span>
                </p>
            </div>

            <h2 class="subheading">Package Info</h2>
            <div class="details">
                <p><strong>Title: </strong><?php echo $refPkgTitle;?></p>
                <p><strong>Period: </strong><?php echo $refTrvPeriod;?></p>
                <p><strong>Price: </strong>RM<?php echo $refPkgPrice;?></p>
                <button class="action-btn" onclick="document.location='package_info.php?pkgID=<?php echo $refPkgID;?>';">
                    <i class="ri-eye-fill"></i>
                    View package
                </button>
            </div>

            <h2 class="subheading">Member List</h2>
            <div class="itinerary-list">
                <?php
                    $query3 = "SELECT * FROM book_mbr_list_t WHERE bkn_ID = '$getBknID' ORDER BY mbr_seqNo ASC;";
                    $results3 = mysqli_query($connection, $query3);

                    while ($data3 = mysqli_fetch_assoc($results3)) {
                        $refSeqNo = $data3['mbr_seqNo'];
                        $refMbrDocID = $data3['mbr_doc_ID'];
                        $refMbrName = $data3['mbr_name'];
                ?>
                        <div class="itinerary-item">
                            <p><strong>No: </strong> <?php echo $refSeqNo;?></p>
                            <p><strong>Member Doc ID: </strong> <?php echo $refMbrDocID;?></p>
                            <p><strong>Member Name: </strong> <?php echo $refMbrName;?></p>
                        </div> 
                <?php           
                    }
                ?>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
</body>
</html>




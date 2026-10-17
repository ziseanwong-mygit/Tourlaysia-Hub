<!-- Programmer Name: Seath Tan Ziren - Group Members of Peaky Blinders, AAPP011-4-2 Capstone Project
Project Name: viewItineraryPage.php
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
        include('./crud/itinerary_info.php');
    ?>
    <div class="page-wrapper">
        <div class="container">
            <h1 class="title"><?php echo $refItrTitle;?></h1>
            <p class="description"><?php echo $refItrDesc;?></p>

            <div class="details">
                <p><strong>User Name: </strong><?php echo $refName;?></p>
                <p><strong>Booking ID: </strong><?php echo $refbknID;?></p>
                <p><strong>Start Date: </strong><?php echo $refItrStartDate;?></p>
                <p><strong>End Date: </strong><?php echo $refItrEndDate;?></p>
                <p><strong>Destination: </strong><?php echo $refItrDest;?></p>
                <p><strong>Remarks: </strong><?php echo $refItrRemark;?></p>
            </div>

            <h2 class="subheading">Daily Itinerary</h2>
            <div class="itinerary-list">
                <?php
                    $query2 = "SELECT * FROM itinerary_rec_list_t WHERE itr_id = '$getItrID' ORDER BY itr_date ASC, itr_time ASC;";
                    $results2 = mysqli_query($connection, $query2);

                    while ($data2 = mysqli_fetch_assoc($results2)) {
                        $refItrDate = $data2['itr_date'];
                        $refItrDay = $data2['itr_day'];
                        $refItrTime = $data2['itr_time'];
                        $refItrAct = $data2['itr_act'];
                ?>
                        <div class="itinerary-item">
                            <p><strong>Day: </strong> <?php echo $refItrDay;?></p>
                            <p><strong>Date: </strong> <?php echo $refItrDate;?></p>
                            <p><strong>Time: </strong> <?php echo $refItrTime;?></p>
                            <p><strong>Activity: </strong> <?php echo $refItrAct;?></p>  
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




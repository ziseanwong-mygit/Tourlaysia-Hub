<!-- Programmer Name: Seath Tan Ziren
Project Name: info_user.php
Description: To retrieve current itinerary from database.
Date first written: 14/6/2025 
Date last modified: 26/6/2025   -->


<?php
    include 'db_connection.php';
    $getUserID = $_SESSION['SES_UserID'];
    $getItrID = $_GET["itr_ID"];
    
    $query = "SELECT * FROM itinerary_t WHERE itr_ID = '$getItrID';";
    $results = mysqli_query($connection, $query);
    $data = mysqli_fetch_assoc($results);

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




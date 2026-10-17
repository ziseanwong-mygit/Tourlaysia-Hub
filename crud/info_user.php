<?php
    include 'db_connection.php';
    $getUserID = $_SESSION['SES_UserID'];

    $query = "SELECT * FROM user_account_t WHERE usr_id = '$getUserID';";

    $results = mysqli_query($connection, $query);
    
    $data = mysqli_fetch_assoc($results);

    $refID = $data['usr_ID'];
    $refRole = $data['usr_role'];
    $refDocID = $data['usr_doc_ID'];
    $refName = $data['usr_name'];
    $refEmail = $data['usr_email'];
    $refTelNo = $data['usr_no_tel'];
    $refGender = $data['usr_gender'];
    $refCountry = $data['usr_country'];
    $refProfPic = $data['usr_prof_pic'];
    $refJobPos = $data['usr_job_pos'];
    $refdep = $data['usr_dep'];
    $refpassword = $data['usr_pswd'];
?>



<?php
    session_start();
?> 


<?php
include 'db_connection.php';
function generateID($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }

    return $randomString; // Return the random string without prefix
}

// Function to generate Feedback ID
function generateBookingID() {
    return "BKN_" . generateID(); // Generates unique FBK ID
}

$currentDate = date("Y-m-d");     
$option = $_POST['category'];

if ($option == 'addbooking1') {
    $bookingID = generateBookingID();
    $torName = $_POST['username'];
    $torEmail = $_POST['email'];
    $torTelNo = $_POST['tor_no_tel'];
    $torUserID = $_POST['userID'];
    $torDocID = $_POST['tor_doc_ID_no'];
    $bknTitle = $_POST['bkn_title'];
    $bknDesc = $_POST['bkn_desc'];
    $pkgDest = $_POST['pkg_dest'];
    $pkgID = $_POST['pkg_ID'];
    $numPax = $_POST['num_pax'];
    $bknRemark = $_POST['bkn_remark'];
    $bknStatus = $_POST['bkn_status'];

    $query = "INSERT INTO tour_booking_t (bkn_ID, pkg_ID, pkg_dest, usr_ID, usr_doc_ID, usr_name, usr_email, usr_no_tel, bkn_title, bkn_desc, bkn_date, num_pax, bkn_remark, bkn_status) VALUES ('$bookingID', '$pkgID', '$pkgDest', '$torUserID', '$torDocID', '$torName', '$torEmail', '$torTelNo', '$bknTitle', '$bknDesc', '$currentDate', '$numPax', '$bknRemark', '$bknStatus');";
    $results = mysqli_query($connection, $query);

    if ($results) {
    ?>
        <script>
            alert("You have successfully added booking record. Your booking details are saved in the database.");
            window.location = "../manageBooking.php";
        </script>
    <?php
    } else {
    ?>                
        <script>
            alert("Sorry! Your attempt to add booking record has failed; not saving any data in database. Please try again!");
        </script>
    <?php            
    }

} else if ($option == 'addbooking2') {
    $mbrLsID = $_POST['mbr_ls_ID'];
    $bknID = $_POST['bkn_ID'];
    $mbrDocID = $_POST['mbr_doc_ID'];
    $mbrName = $_POST['mbr_name'];
    $mbrSeqNo = $_POST['mbr_seqNo'];


    $query = "INSERT INTO book_mbr_list_t (mbr_ls_ID, bkn_ID, mbr_doc_ID, mbr_name, mbr_seqNo) VALUES ('$mbrLsID', '$bknID', '$mbrDocID', '$mbrName', '$mbrSeqNo');";
    $results = mysqli_query($connection, $query);

    if ($results) {
    ?>
        <script>
            alert("You have successfully added booking record. Your booking details are saved in the database.");
            window.location = "../manageBooking.php";
        </script>
    <?php
    } else {
    ?>                
        <script>
            alert("Sorry! Your attempt to add booking record has failed; not saving any data in database. Please try again!");
            window.location = "../manageBooking.php";
        </script>
    <?php            
    }
}



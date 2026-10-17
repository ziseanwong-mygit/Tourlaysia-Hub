<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: updateBooking.php -->
<!-- Description: To update a booking record with the new details inputted by the user into the database "tourlaysiadb". -->
<!-- Date first written: 13/7/2025 -->
<!-- Date last modified: 13/7/2025 -->

<?php
    include 'db_connection.php';

    if (isset($_POST['updateBookingRec'])) {
        // Set variables with form values via POST method
        $bookingID = $_POST['bookingID'];
        $packageID = $_POST['packageID'];
        $usrID = $_POST['usrID'];
        $bookingTitle = $_POST['bookingTitle'];
        $bookingDesc = $_POST['bookingDesc'];
        $bookingDate = $_POST['bookingDate'];
        $numberOfPax = $_POST['numberOfPax'];
        $bookingRemark = $_POST['bookingRemark'];
        $bookingStatus = $_POST['bookingStatus'];

        // Retrieve package destination based on package ID
        $query = "SELECT pkg_dest FROM tour_package_t WHERE pkg_ID = '$packageID';";
        $results = mysqli_query($connection, $query);
        $data = mysqli_fetch_assoc($results);
        $packageDest = $data['pkg_dest'];

        // Retrieve booker name and email based on account ID
        $query2 = "SELECT usr_name, usr_email, usr_no_tel FROM user_account_t WHERE usr_ID = '$usrID';";
        $results2 = mysqli_query($connection, $query2);
        $data2 = mysqli_fetch_assoc($results2);

        // Set variables for the booker name and email
        $usrName = $data2['usr_name'];
        $usrEmail = $data2['usr_email'];
        $usrNoTel = $data2['usr_no_tel'];

        // Update record with new details in table
        $query3 = "UPDATE tour_booking_t SET pkg_ID = '$packageID', pkg_dest = '$packageDest', usr_ID = '$usrID', usr_name = '$usrName', usr_email = '$usrEmail', usr_no_tel = '$usrNoTel', bkn_title = '$bookingTitle', bkn_desc = '$bookingDesc', bkn_date = '$bookingDate', num_pax = '$numberOfPax', bkn_remark = '$bookingRemark', bkn_status = '$bookingStatus' WHERE bkn_ID = '$bookingID';";
        $results3 = mysqli_query($connection, $query3);
        
        // Display message result
        if($results3) {
?>
            <script>
                alert("The booking record has successfully been updated in the database. Please go to the booking record info and view the latest changes.");
                window.location = "mng_bookingInfo.php?bookID=<?php echo $bookingID?>";
            </script>
<?php        
        } else {
?>
            <script>
                alert("Sorry! The booking record has failed to be updated. Please try again.");
                window.location = "mng_bookingInfo.php?bookID=<?php echo $bookingID?>";
            </script>   
<?php
        }   
    }      
?>
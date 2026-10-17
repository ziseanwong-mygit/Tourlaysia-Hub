<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: updateBookStatus.php -->
<!-- Description: To update the status of the selected booking for confirming/rejecting/cancelling bookings in database 'tourlaysiadb' -->
<!-- Date first written: 13/7/2025 -->
<!-- Date last modified: 13/7/2025 -->

<?php
    include 'db_connection.php';

    if (isset($_POST['updateBookStatus'])) {
        // Set variables with form values via POST method
        $bookingID = $_POST['bookingID'];
        $bookingStatus = $_POST['bookingStatus'];

        // Update record with new details in table
        $query = "UPDATE tour_booking_t SET bkn_status = '$bookingStatus' WHERE bkn_ID = '$bookingID';";
        $results = mysqli_query($connection, $query);
        
        // Display message result
        if($results) {
?>
            <script>
                alert("The status of selected booking record has successfully been updated in the database. Please go to the booking record info and view the latest changes.");
                window.location = "mng_bookingInfo.php?bookID=<?php echo $bookingID?>";
            </script>
<?php        
        } else {
?>
            <script>
                alert("Sorry! The status of selected booking record has failed to be updated. Please try again.");
                window.location = "mng_bookingInfo.php?bookID=<?php echo $bookingID?>";
            </script>   
<?php
        }   
    }      
?>
<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: deleteBooking.php -->
<!-- Description: To delete a booking record from the database "tourlaysiadb". -->
<!-- Date first written: 13/7/2025 -->
<!-- Date last modified: 13/7/2025 -->

<?php
    include 'db_connection.php';

    if (isset($_POST['deleteBookingRec'])) {
        $query = "DELETE FROM tour_booking_t WHERE bkn_ID = '$bookingIDRef';";
        $results = mysqli_query($connection, $query);

        // Display message result
        if($results) {
?>
            <script>
                alert("The booking record has successfully been deleted from the database. Please go to the manage booking record page and view the latest changes.");
                window.location = "manageBooking.php"; // Link to manage booking page
            </script>
<?php        
        } else {
?>
            <script>
                alert("Sorry! The booking record has failed to be deleted. Please try again.");
                window.location = "mng_bookingInfo.php?bookID=<?php echo $bookingIDRef?>";
            </script>   
<?php
        }   
    }      
?>
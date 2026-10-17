<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: createItinerary.php -->
<!-- Description: To add an itinerary record into the database "tourlaysiadb". -->
<!-- Date first written: 12/7/2025 -->
<!-- Date last modified: 12/7/2025 -->

<?php
    include "db_connection.php";

    function generateID($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
    
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
    
        return $randomString;
    }

    if (isset($_POST['subItinForm'])) {
        // Set variables for details from itinerary form part 1
        $bookingID = $_SESSION['bookingID'];
        $usrID = $_SESSION['SES_UserID'];
        $itinTitle = $_SESSION['itinTitle'];
        $itinDesc = $_SESSION['itinDesc'];
        $itinStartDate = $_SESSION['itinStartDate'];
        $itinEndDate = $_SESSION['itinEndDate'];
        $itinDest = $_SESSION['itinDest'];
        $itinRemark = $_SESSION['itinRemark'];

        // Set variables for details from itinerary form part 2
        $itinActDate = $_POST['itinActDate'];
        $itinActDay = $_POST['itinActDay'];
        $itinActTime = $_POST['itinActTime'];
        $itinActivity = $_POST['itinActivity'];

        // Count how many rows of itinerary activity records filled by user
        $itinRowCount = count($itinActDate);

        // Generate itinerary ID
        $itinID = "ITR_" . generateID();

        // Get the user name for inserting itinerary record
        $query = "SELECT usr_name FROM tour_booking_t WHERE bkn_ID = '$bookingID';";
        $results = mysqli_query($connection, $query);
        $data = mysqli_fetch_assoc($results);
        $usrName = $data['usr_name']; // Set variable for user name in booking record

        // Insert general itinerary details into database record first
        $query2 = "INSERT INTO itinerary_t VALUES ('$itinID', '$bookingID', '$usrID', '$usrName', '$itinTitle', '$itinDesc', '$itinStartDate', '$itinEndDate', '$itinDest', '$itinRemark');";
        $results2 = mysqli_query($connection, $query2);

        // Insert each itinerary activity details into database record
        for($x = 0; $x < $itinRowCount; $x++) {
            $itinrecID = "IREC_" . generateID(); // Generate itinerary activity record ID
            $itinDayFormat = "Day " . $itinActDay[$x]; // Format the day with number; e.g. Day 1

            $query3 = "INSERT INTO itinerary_rec_list_t VALUES ('$itinrecID', '$itinID', '$itinActDate[$x]', '$itinDayFormat', '$itinActTime[$x]', '$itinActivity[$x]');";
            $results3 = mysqli_query($connection, $query3);
        }

        // Unset session variables
        unset($_SESSION['bookingID']);
        unset($_SESSION['itinTitle']);
        unset($_SESSION['itinDesc']);
        unset($_SESSION['itinStartDate']);
        unset($_SESSION['itinEndDate']);
        unset($_SESSION['itinDest']);
        unset($_SESSION['itinRemark']);

        if($results2 && $results3) {
?>
            <script>
                alert("Your itinerary record has been saved into the database. Please view your booking to view your itinerary record. Thank you for booking from us! Your booking is currently under review by our staff.");
                window.location = "home_page.php";
            </script>
<?php        
        } else {
?>
            <script>
                alert("Oops! Sorry to inform that your itinerary record has been failed to save into the database. Please try again later. Thank you for your understanding and patience.");
                window.location = "home_page.php";
            </script>   
<?php
        }   
    }      
?>
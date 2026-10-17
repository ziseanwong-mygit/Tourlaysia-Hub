<!-- Programmer Name: Seath Tan Ziren
Project Name: filterBoookingHistoryPage.php
Description: To create filtered booking history page to allow users to find their booking history with date range.
Date first written: 14/6/2025 
Date last modified: 26/6/2025   -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="./img/logo/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="./styles/bookingHistoryPage.css">
</head>
<body>
    <?php include 'header.php';?>
    <?php include './crud/db_connection.php';?>

    <?php
        if(isset($_SESSION['SES_UserID'])){
            $getUserID = $_SESSION['SES_UserID'];
        }
        $startDate = $_GET['startDate']; 
        $endDate = $_GET['endDate'];    
    ?>

    <div class="back-nav">
        <button onclick="location.href='accountDashboard.php';"><img src="https://cdn-icons-png.flaticon.com/128/130/130882.png" alt=""><h3>Back</h3></button>
    </div>

    <div class="history-container">
        <div class="filter-box">
            <h3>Filters</h3>
            <form action="" method="POST" class="filter-form">
                <div class="form-grid">
                    <div>
                        <label for="startDate">From</label>
                        <input type="date" name="startDate">
                    </div>
                    <div>
                        <label for="endDate">To</label>
                        <input type="date" name="endDate">
                    </div>
                </div>
                <div class="form-btn">
                    <button type="reset" class="form-btn-reset" onclick="location.href='bookingHistory.php';">Reset</button>
                    <button type="submit" class="form-btn-search" name="search">Search</button>
                </div>
            </form>
        </div>
<?php
        if (isset($_POST['search'])) {
            ?> 
                <script>       
                    window.location.href = "filterBookingHistory.php?startDate=<?php echo $_GET['startDate']; ?>&endDate=<?php echo $_GET['endDate']; ?>";
                </script>     
            <?php   
        }

        // get number of items found
        $counter = 0;
        $query = "SELECT * FROM tour_booking_t WHERE usr_ID = '$getUserID' AND bkn_date BETWEEN '$startDate' AND '$endDate';";
        $results = mysqli_query($connection, $query);
        while ($data = mysqli_fetch_assoc($results)) {

            if (!empty($data)) {
                $counter++;
            }
        }    
?>    
        <h2><?php echo $counter;?> results found from "<?php echo $startDate;?>" to "<?php echo $startDate;?>"</h2>
<?php
        $query = "SELECT * FROM tour_booking_t WHERE usr_ID = '$getUserID' AND bkn_date BETWEEN '$startDate' AND '$endDate';";
        $results = mysqli_query($connection, $query);
        // Check if any rows are returned
        if (mysqli_num_rows($results) != 0) {
            while  ($data = mysqli_fetch_assoc($results)) {
                $refBknID = $data['bkn_ID'];
                $refPkgID = $data['pkg_ID'];
                $refPkgDest = $data['pkg_dest'];
                $refUserName = $data['usr_name'];
                $refUserEmail = $data['usr_email'];
                $refUserTelNo = $data['usr_no_tel'];
                $refUserDocID = $data['usr_doc_ID'];
                $refBknTitle = $data['bkn_title'];
                $refBknDesc = $data['bkn_desc'];
                $refBknDate = $data['bkn_date'];
                $refpax = $data['num_pax'];
                $refBknRemarks = $data['bkn_remark'];
                $refBknStatus = $data['bkn_status'];
?>
                <div class="history-card">
                    <h3>Booking Details From </h3>
                    <div>
                        <p><strong>Name:</strong> <?php echo $refUserName; ?></p>
                        <p><strong>Email:</strong> <?php echo $refUserEmail; ?></p>
                        <p><strong>IC/Passport Number:</strong> <?php echo $refUserDocID; ?></p>
                        <p><strong>Telephone Number:</strong> <?php echo $refUserTelNo; ?></p>
                        <p><strong>Package Destination: </strong> <?php echo $refPkgDest; ?></p>
                        <p><strong>Pax: </strong> <?php echo $refpax; ?></p>
                        <p><strong>Booking Title:</strong> <?php echo $refBknTitle; ?> </p>
                        <p><strong>Booking Date:</strong> <?php echo $refBknDate; ?></p>
                        <p><strong>Booking Description:</strong> <?php echo $refBknDesc; ?></p>
                        <p><strong>Booking Remarks:</strong> <?php echo $refBknRemarks; ?></p>
                        <p><strong>Booking Status:</strong> <?php echo $refBknStatus; ?></p>
                    </div>
                </div>
<?php
                }
            }
?>
    </div>
    <?php include 'footer.php';?>
</body>
</html>
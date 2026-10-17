<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: reviewBooking.php -->
<!-- Description: To create a form that allows staffs and admins to confirm/reject/cancel bookings made by tourists. Only office staffs and admins can confirm/reject/cancel bookings-->
<!-- Date first written: 12/7/2025 -->
<!-- Date last modified: 12/7/2025 -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="../img/logo/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="./staff_styles/staff_styles.css">
    <link rel="stylesheet" href="./staff_styles/add_edit_recInfo.css">
</head>
<body>
    <?php include 'staff_header.php';?>

    <?php
        // Connect database
        include './staff_crud/db_connection.php';

        // Retrieve original values from table
        $bookingIDRef = $_GET['bookID'];

        $queryA = "SELECT * FROM tour_booking_t WHERE bkn_ID = '$bookingIDRef';";
        $resultsA = mysqli_query($connection, $queryA);
        $dataA = mysqli_fetch_assoc($resultsA);

        $pkgIDRef = $dataA['pkg_ID'];
        $pkgDestRef = $dataA['pkg_dest'];
        $userIDRef = $dataA['usr_ID'];
        $userNameRef = $dataA['usr_name'];
        $bknTitleRef = $dataA['bkn_title'];
        $bknDescRef = $dataA['bkn_desc'];
        $bknDateRef = $dataA['bkn_date'];
        $numPaxRef = $dataA['num_pax'];
        $bknRemarkRef = $dataA['bkn_remark'];
    ?>

    <div class="edit-title-desc">
        <h2 class="edit-title">Review Booking Form</h2>
        <div class="edit-desc-div">
            <p class="edit-desc">This form provides staffs and admins to confirm/reject/cancel bookings made by tourists for the selected package. Only office staffs and admins can review.</p>
        </div>
        <div class="edit-inst-div">
            <h4 style="padding-bottom:10px;">Instructions:</h4>
            <ol class="edit-list">
                <li>* Required Fields</li>
                <li>Please select a status to <b>confirm, reject or cancel</b> the booking. You can change the status again after the review.</li>
            </ol>
        </div>
    </div>
    <form action="" method="POST" class="edit-rec-form">
        <div class="label-field-div">
            <label for="bookingID">Booking ID:</label>
            <input type="text" id="bookingID" name="bookingID" value="<?php echo $bookingIDRef?>" readonly>
        </div>
        <div class="label-field-div">
            <label for="bookDate">Booking Date:</label>
            <input type="text" id="bookDate" name="bookingDate" value="<?php echo $bknDateRef?>" readonly>
        </div>
        <div class="label-field-div">
            <label for="bookerID">Booker ID:</label>
            <input type="text" id="bookerID" name="bookerID" value="<?php echo $userIDRef?>" readonly>
        </div>
        <div class="label-field-div">
            <label for="bookerName">Booker Name:</label>
            <input type="text" id="bookerName" name="usrName" value="<?php echo $userNameRef?>" readonly>
        </div>
        </div>        
        <div class="label-field-div">
            <label for="pkgID">Package ID:</label>
            <input type="text" id="pkgID" name="packageID" value="<?php echo $pkgIDRef?>" readonly>
        </div>
        <div class="label-field-div">
            <label for="pkgDest">Destination:</label>
            <input type="text" id="pkgDest" name="packageDest" value="<?php echo $pkgDestRef?>" readonly>
        </div>
        <div class="label-field-div">
            <label for="bookTitle">Title:</label>
            <input type="text" id="bookTitle" name="bookingTitle" value="<?php echo $bknTitleRef?>" readonly>
        </div>
        <div class="label-field-div">
            <label for="bookDesc"> Description:</label>
            <textarea name="bookingDesc" id="bookDesc" value="<?php echo $bknDescRef?>" rows="5" readonly></textarea>
        </div>
        <div class="label-field-div">
            <label for="numpax">Number of Pax:</label>
            <input type="number" id="numpax" name="numberOfPax" value="<?php echo $numPaxRef?>" readonly>
        </div>
        <div class="label-field-div">
            <label for="bookRemark">Remarks:</label>
            <input type="text" id="bookRemark" name="bookingRemark" value="<?php echo $bknRemarkRef?>" readonly>
        </div>
        <div class="label-field-div">
            <label for="status"><span>*</span> Status:</label>
            <select id="status" name="bookingStatus" required>
                <option value="" >Select a status</option>
                <option value="Confirmed">Confirmed</option>
                <option value="Rejected">Rejected</option>
                <option value="Cancelled">Cancelled</option>
            </select>          
        </div>
        <div class="form-buttons-div">
            <button type="submit" name="updateBookStatus">
                <i class="ri-save-fill"></i>
                Update Booking Status
            </button>
            <button type="button" name="backPrevPage" onclick="history.back();">
                <i class="ri-arrow-left-long-fill"></i>
                Back
            </button>
            <button type="reset" name="eraseData">
                <i class="ri-eraser-fill"></i>
                Erase Inputs
            </button>
         </div>
    </form>

    <?php
        if (isset($_POST['updateBookStatus'])) {
            include './staff_crud/updateBookStatus.php';
        }
    ?>

    <?php include 'staff_footer.php';?>
</body>
</html>
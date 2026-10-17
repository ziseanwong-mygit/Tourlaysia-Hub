<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: edit_bookingRec.php -->
<!-- Description: To create a form that allows staffs and admins to edit booking record. Only office staffs and admins can edit bookings.-->
<!-- Date first written: 13/7/2025 -->
<!-- Date last modified: 13/7/2025 -->

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
        $userIDRef = $dataA['usr_ID'];
        $bknTitleRef = $dataA['bkn_title'];
        $bknDescRef = $dataA['bkn_desc'];
        $bknDateRef = $dataA['bkn_date'];
        $numPaxRef = $dataA['num_pax'];
        $bknRemarkRef = $dataA['bkn_remark'];
        $bknStatusRef = $dataA['bkn_status'];
    ?>

    <div class="edit-title-desc">
        <h2 class="edit-title">Edit Booking Record Form</h2>
        <div class="edit-desc-div">
            <p class="edit-desc">This form provides staffs and admins to edit tour booking details after the record selection. Only office staffs and admins can edit.</p>
        </div>
        <div class="edit-inst-div">
            <h4 style="padding-bottom:10px;">Instructions:</h4>
            <ol class="edit-list">
                <li>* Required Fields</li>
                <li>All fields are automatically filled with the original details. Please update with the new details in the fields you wish to edit.</li>
                <li><b>Booking ID</b> cannot be changed.</li>
                <li>For changing package details, please select the correct package ID to update the destination.</li>
                <li>For changing booker details, please select the correct booker ID to update the related details.</li>
            </ol>
        </div>
    </div>
    <form action="" method="POST" class="edit-rec-form">
        <div class="label-field-div">
            <label for="bookID">Booking ID:</label>
            <input type="text" id="bookID" name="bookingID" value="<?php echo $bookingIDRef?>" readonly>
        </div>
        <div class="label-field-div">
            <label for="packID"><span>*</span> Package ID:</label>
            <select id="packID" name="packageID" required>
                <option value="">Select a package ID</option>
                <?php
                    $queryB = "SELECT pkg_ID, pkg_title FROM tour_package_t;";
                    $resultsB = mysqli_query($connection, $queryB);
                    while ($dataB = mysqli_fetch_assoc($resultsB)) {
                ?>
                        <option value="<?php echo $dataB['pkg_ID'];?>" <?php if ($pkgIDRef == $dataB['pkg_ID']) echo "selected"; ?>>
                            <?php echo $dataB['pkg_ID'];?> - <?php echo $dataB['pkg_title'];?>
                        </option>
                <?php
                    }                                   
                ?>
            </select>          
        </div>

        <div class="label-field-div">
            <label for="bookerID"><span>*</span> Booker ID:</label>
            <select id="bookerID" name="usrID" required>
                <option value="">Select a booker ID</option>
                <?php
                    $queryC = "SELECT usr_ID, usr_doc_ID, usr_name FROM user_account_t WHERE usr_role = 'Tourist';";
                    $resultsC = mysqli_query($connection, $queryC);
                    while ($dataC = mysqli_fetch_assoc($resultsC)) {
                ?>
                        <option value="<?php echo $dataC['usr_ID'];?>" <?php if ($userIDRef == $dataC['usr_ID']) echo "selected"; ?>>
                            <?php echo $dataC['usr_doc_ID'];?> - <?php echo $dataC['usr_name'];?>
                        </option>
                <?php
                    }                                   
                ?>
            </select>          
        </div>
        <div class="label-field-div">
            <label for="bookTitle"><span>*</span> Title:</label>
            <input type="text" id="bookTitle" name="bookingTitle" placeholder="E.g. 5D4N KL Booking" value="<?php echo $bknTitleRef;?>" required>
        </div>
        <div class="label-field-div">
            <label for="bookDesc">Description:</label>
            <textarea name="bookingDesc" id="bookDesc" placeholder="E.g. This booking is made for fun and thrive for KL." rows="5"><?php echo $bknDescRef;?></textarea>
        </div>
        <div class="label-field-div">
            <label for="bookDate"><span>*</span> Booking Date:</label>
            <input type="bookingDate" id="bookDate" name="bookingDate" value="<?php echo $bknDateRef;?>" required>
        </div>
        <div class="label-field-div">
            <label for="numPax"><span>*</span> Number of Pax:</label>
            <input type="number" id="numPax" name="numberOfPax" placeholder="E.g. 4" value="<?php echo $numPaxRef;?>" min="1" required>
        </div>
        <div class="label-field-div">
            <label for="bookRemark">Remarks:</label>
            <textarea name="bookingRemark" id="bookRemark" placeholder="E.g. This booking is made by member name." rows="5"><?php echo $bknRemarkRef;?></textarea>
        </div>
        <div class="label-field-div">
            <label for="status"><span>*</span> Status:</label>
            <select id="status" name="bookingStatus" required>
                <option value="" >Select a status</option>
                <option value="Confirmed" <?php if ($bknStatusRef == "Confirmed") echo "selected"; ?>>Confirmed</option>
                <option value="Rejected" <?php if ($bknStatusRef == "Rejected") echo "selected"; ?>>Rejected</option>
                <option value="Cancelled" <?php if ($bknStatusRef == "Cancelled") echo "selected"; ?>>Cancelled</option>
                <option value="Pending" <?php if ($bknStatusRef == "Pending") echo "selected"; ?>>Pending</option>
            </select>          
        </div>
        <div class="form-buttons-div">
            <button type="submit" name="updateBookingRec">
                <i class="ri-save-fill"></i>
                Update Booking
            </button>
            <button type="button" name="backPrevPage" onclick="history.back();">
                <i class="ri-arrow-left-long-fill"></i>
                Back
            </button>
            <button type="reset" name="eraseData">
                <i class="ri-eraser-fill"></i>
                Reset to Old Inputs
            </button>
         </div>
    </form>

    <?php
        if (isset($_POST['updateBookingRec'])) {
            include './staff_crud/updateBooking.php';
        }
    ?>

    <?php include 'staff_footer.php';?>
</body>
</html>
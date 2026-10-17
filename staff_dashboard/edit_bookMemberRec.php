<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: edit_bookMemberRec.php -->
<!-- Description: To create a form that allows staffs and admins to edit tour member in a booking record. Only office staffs and admins can edit tour members.-->
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
        $mbrListIDRef = $_GET['mbrListID'];
        $queryA = "SELECT * FROM book_mbr_list_t WHERE mbr_ls_ID = '$mbrListIDRef';";
        $resultsA = mysqli_query($connection, $queryA);
        $dataA = mysqli_fetch_assoc($resultsA);

        $bknIDRef = $dataA['bkn_ID'];
        $mbrDocIDRef = $dataA['mbr_doc_ID'];
        $mbrNameRef = $dataA['mbr_name'];
    ?>

    <div class="edit-title-desc">
        <h2 class="edit-title">Edit Booking Tour Member Form</h2>
        <div class="edit-desc-div">
            <p class="edit-desc">This form provides staffs and admins to edit tour member details after the booking record selection. Only office staffs and admins can edit.</p>
        </div>
        <div class="edit-inst-div">
            <h4 style="padding-bottom:10px;">Instructions:</h4>
            <ol class="edit-list">
                <li>* Required Fields</li>
                <li>All fields are automatically filled with the original details. Please update with the new details in the fields you wish to edit.</li>
                <li>Both <b>Booking Member List ID and Booking ID</b> cannot be changed.</li>
                <li>Changing the member details <b>does not affect</b> other records in the database. Only the record stored in this table is affected.</li>
            </ol>
        </div>
    </div>
    <form action="" method="POST" class="edit-rec-form">
        <div class="label-field-div">
            <label for="mbrlistID">Member List ID:</label>
            <input type="text" id="mbrlistID" name="memberListID" value="<?php echo $mbrListIDRef;?>" readonly>
        </div>
        <div class="label-field-div">
            <label for="bookID">Booking ID:</label>
            <input type="text" id="bookID" name="bookingID" value="<?php echo $bknIDRef;?>" readonly>
        </div>
        <div class="label-field-div">
            <label for="mbmdocID"><span>*</span> Member Doc ID:</label>
            <input type="text" id="mbmdocID" name="memberDocID" placeholder="E.g. 000000000000 / A0000000000" value="<?php echo $mbrDocIDRef;?>" required>
        </div>
        <div class="label-field-div">
            <label for="mbmName"><span>*</span> Member Name:</label>
            <input type="text" id="mbmName" name="memberName" placeholder="E.g. Ali bin Ahmad" value="<?php echo $mbrNameRef;?>" required>
        </div>
        <div class="form-buttons-div">
            <button type="submit" name="updateTourMember">
                <i class="ri-save-fill"></i>
                Update Tour Member
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
        if (isset($_POST['updateTourMember'])) {
            include './staff_crud/updateBookMember.php';
        }
    ?>

    <?php include 'staff_footer.php';?>
</body>
</html>
<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: add_bookMemberRec.php -->
<!-- Description: To create a form that allows staffs and admins to add a booking tour member record in a selected schedule. Only office staffs and admins can add members.-->
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
        $bookingIDRef = $_GET['bookID'];
    ?>

    <div class="edit-title-desc">
        <h2 class="edit-title">Add Booking Tour Member Record Form</h2>
        <div class="edit-desc-div">
            <p class="edit-desc">This form provides staffs and admins to add a tour member inside a selected booking record. Only office staffs and admins can add.</p>
        </div>
        <div class="edit-inst-div">
            <h4 style="padding-bottom:10px;">Instructions:</h4>
            <ol class="edit-list">
                <li>* Required Fields</li>
                <li><b>Member list ID</b> is auto-generared after form submission.</li>
                <li><b>Booking ID</b> cannot be changed.</li>
            </ol>
        </div>
    </div>
    <form action="" method="POST" class="edit-rec-form">
        <div class="label-field-div">
            <label for="bookID">Booking ID:</label>
            <input type="text" id="bookID" name="bookingID" value="<?php echo $bookingIDRef?>" readonly>
        </div>
        <div class="label-field-div">
            <label for="mbmdocID"><span>*</span> Member Doc ID:</label>
            <input type="text" id="mbmdocID" name="memberDocID" placeholder="E.g. 000000000000 / A0000000000" required>
        </div>
        <div class="label-field-div">
            <label for="mbmName"><span>*</span> Member Name:</label>
            <input type="text" id="mbmName" name="memberName" placeholder="E.g. Ali bin Ahmad" required>
        </div>
        <div class="form-buttons-div">
            <button type="submit" name="addTourMemberRec">
                <i class="ri-add-fill"></i>
                Add Tour Member
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
        if (isset($_POST['addTourMemberRec'])) {
            include './staff_crud/createBookMember.php';
        }
    ?>

    <?php include 'staff_footer.php';?>
</body>
</html>
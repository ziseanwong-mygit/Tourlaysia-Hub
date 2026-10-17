<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: add_attendanceRec.php -->
<!-- Description: To create a form that allows tour guides to create attendance records -->
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

    <div class="edit-title-desc">
        <h2 class="edit-title">Add Attendance Record Form</h2>
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
            <label for="bookID"><span>*</span> Booking ID:</label>
            <select id="bookID" name="bookingID" required>
                <option value="">Select a booking ID</option>
                <?php
                    $queryD = "SELECT bkn_ID, bkn_title FROM tour_booking_t;";
                    $resultsD = mysqli_query($connection, $queryD);
                    while ($dataD = mysqli_fetch_assoc($resultsD)) {
                ?>
                        <option value="<?php echo $dataD['bkn_ID'];?>">
                            <?php echo $dataD['bkn_ID'];?> - <?php echo $dataD['bkn_title'];?>
                        </option>
                <?php
                    }                                   
                ?>
            </select>          
        </div>
        <div class="label-field-div">
            <label for="atdDate"><span>*</span> Attendance Date:</label>
            <input type="date" id="atdDate" name="attendanceDate" required>
        </div>
        <div class="label-field-div">
            <label for="atdTitle"><span>*</span> Title:</label>
            <input type="text" id="atdTitle" name="attendanceTitle" placeholder="E.g. 5D4N KL Attenance 7 Members" required>
        </div>
        <div class="label-field-div">
            <label for="atdDesc">Description:</label>
            <textarea name="attendanceDesc" id="atdDesc" placeholder="E.g. This is my attendance list for 5D4N KL Tour. 7 members" rows="5"></textarea>
        </div>
        <div class="form-buttons-div">
            <button type="submit" name="addAttendanceRec">
                <i class="ri-add-fill"></i>
                Add Attendance
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
        if (isset($_POST['addAttendanceRec'])) {
            include './staff_crud/createAttendance.php';
        }
    ?>

    <?php include 'staff_footer.php';?>
</body>
</html>
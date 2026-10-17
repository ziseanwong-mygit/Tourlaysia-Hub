<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: add_timeslotRec.php -->
<!-- Description: To create a form that allows staffs and admins to add a timeslot record in a selected schedule. Only office staffs and admins can add timeslots.-->
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
        $scheduleIDRef = $_GET['scdID'];
    ?>

    <div class="edit-title-desc">
        <h2 class="edit-title">Add Timeslot Record Form</h2>
        <div class="edit-desc-div">
            <p class="edit-desc">This form provides staffs and admins to add a timeslot record in the selected schedule. Only office staffs and admins can add.</p>
        </div>
        <div class="edit-inst-div">
            <h4 style="padding-bottom:10px;">Instructions:</h4>
            <ol class="edit-list">
                <li>* Required Fields</li>
                <li><b>Timeslot ID</b> is auto-generared after form submission.</li>
                <li><b>Schedule ID</b> cannot be changed.</li>
            </ol>
        </div>
    </div>
    <form action="" method="POST" class="edit-rec-form">
        <div class="label-field-div">
            <label for="scdID">Schedule ID:</label>
            <input type="text" id="scdID" name="scheduleID" value="<?php echo $scheduleIDRef;?>" readonly>
        </div>
        <div class="label-field-div">
            <label for="tsDate"><span>*</span> Date:</label>
            <input type="date" id="tsDate" name="timeslotDate" required>
        </div>
        <div class="label-field-div">
            <label for="tsDate"><span>*</span> Time:</label>
            <input type="time" id="tsTime" name="timeslotTime" required>
        </div>
        <div class="label-field-div">
            <label for="tsDay"><span>*</span> Day:</label>
            <input type="text" id="tsDay" name="timeslotDay" placeholder="Day 1" required>
        </div>
        <div class="label-field-div">
            <label for="tsTransp"><span>*</span> Transportation:</label>
            <input type="text" id="tsTransp" name="timeslotTrasnp" placeholder="Bus" required>
        </div> 
        <div class="label-field-div">
            <label for="tsTasks"><span>*</span> Tasks:</label>
            <input type="text" id="tsTasks" name="timeslotTasks" placeholder="Visit KLCC" required>
        </div>
        <div class="form-buttons-div">
            <button type="submit" name="addTimeslotRec">
                <i class="ri-add-fill"></i>
                Add Timeslot
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
        if (isset($_POST['addTimeslotRec'])) {
            include './staff_crud/createTimeslot.php';
        }
    ?>

    <?php include 'staff_footer.php';?>
</body>
</html>
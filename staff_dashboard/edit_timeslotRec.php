<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: edit_timeslotRec.php -->
<!-- Description: To create a form that allows staffs and admins to edit schedule timeslot record. Only office staffs and admins can edit timeslots.-->
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
        $timeslotIDRef = $_GET['timeslotID'];
        $queryA = "SELECT * FROM scd_timeslot_list_t WHERE tsl_list_ID = '$timeslotIDRef';";
        $resultsA = mysqli_query($connection, $queryA);
        $dataA = mysqli_fetch_assoc($resultsA);

        $scheduleIDRef = $dataA['scd_ID'];
        $timeslotDateRef = $dataA['tsl_date'];
        $timeslotTimeRef = $dataA['tsl_time'];
        $timeslotDayRef = $dataA['tsl_day'];
        $timeslotTranspRef = $dataA['tsl_transp'];
        $timeslotTaskRef = $dataA['tsl_task'];
    ?>

    <div class="edit-title-desc">
        <h2 class="edit-title">Edit Timeslot Record Form</h2>
        <div class="edit-desc-div">
            <p class="edit-desc">This form provides staffs and admins to edit timeslot details after the record selection. Only office staffs and admins can edit.</p>
        </div>
        <div class="edit-inst-div">
            <h4 style="padding-bottom:10px;">Instructions:</h4>
            <ol class="edit-list">
                <li>* Required Fields</li>
                <li>All fields are automatically filled with the original details. Please update with the new details in the fields you wish to edit.</li>
                <li>Both <b>timeslot ID and bill ID</b> cannot be changed.</li>
                <li>Dates and time are not filled in automatically. Please input the original/new date and time.</li>
            </ol>
        </div>
    </div>
    <form action="" method="POST" class="edit-rec-form">
        <div class="label-field-div">
            <label for="tsID">Timeslot ID:</label>
            <input type="text" id="tsID" name="timeslotID" value="<?php echo $timeslotIDRef;?>" readonly>
        </div>
        <div class="label-field-div">
            <label for="scdID">Schedule ID:</label>
            <input type="text" id="scdID" name="scheduleID" value="<?php echo $scheduleIDRef;?>" readonly>
        </div>
        <div class="label-field-div">
            <label for="tsDate"><span>*</span> Date:</label>
            <input type="date" id="tsDate" name="timeslotDate" value="<?php echo $timeslotDateRef;?>" required>
        </div>
        <div class="label-field-div">
            <label for="tsDate"><span>*</span> Time:</label>
            <input type="time" id="tsTime" name="timeslotTime" value="<?php echo $timeslotTimeRef;?>" required>
        </div>
        <div class="label-field-div">
            <label for="tsDay"><span>*</span> Day:</label>
            <input type="text" id="tsDay" name="timeslotDay" placeholder="Day 1" value="<?php echo $timeslotDayRef;?>" required>
        </div>
        <div class="label-field-div">
            <label for="tsTransp"><span>*</span> Transportation:</label>
            <input type="text" id="tsTransp" name="timeslotTrasnp" placeholder="Bus" value="<?php echo $timeslotTranspRef;?>" required>
        </div> 
        <div class="label-field-div">
            <label for="tsTasks"><span>*</span> Tasks:</label>
            <input type="text" id="tsTasks" name="timeslotTasks" placeholder="Visit KLCC" value="<?php echo $timeslotTaskRef;?>" required>
        </div>          
        <div class="form-buttons-div">
            <button type="submit" name="updateTimeslotRec">
                <i class="ri-save-fill"></i>
                Update Timeslot
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
        if (isset($_POST['updateTimeslotRec'])) {
            include './staff_crud/updateTimeslot.php';
        }
    ?>

    <?php include 'staff_footer.php';?>
</body>
</html>
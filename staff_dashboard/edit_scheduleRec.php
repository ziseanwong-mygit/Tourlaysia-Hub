<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: edit_billRec.php -->
<!-- Description: To create a form that allows staffs and admins to edit trip schedule record. Only office staffs and admins can edit schedules.-->
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
        $scheduleIDRef = $_GET['scdID'];

        $queryA = "SELECT * FROM trip_schedule_t WHERE scd_ID = '$scheduleIDRef';";
        $resultsA = mysqli_query($connection, $queryA);
        $dataA = mysqli_fetch_assoc($resultsA);

        $gudIDRef = $dataA['gud_ID'];
        $drvIDRef = $dataA['drv_ID'];
        $itrIDRef = $dataA['itr_ID'];
        $scdTitleRef = $dataA['scd_title'];
        $scdDescRef = $dataA['scd_desc'];
        $scdDuraRef = $dataA['scd_dura'];
        $scdStaDateRef = $dataA['scd_start_date'];
        $scdEndDateRef = $dataA['scd_end_date'];
        $scdRemark = $dataA['scd_remark'];
        $staffIDRef = $dataA['stf_ID'];
    ?>

    <div class="edit-title-desc">
        <h2 class="edit-title">Edit Trip Schedule Record Form</h2>
        <div class="edit-desc-div">
            <p class="edit-desc">This form provides staffs and admins to edit trip schedule details after the record selection. Only office staffs and admins can edit.</p>
        </div>
        <div class="edit-inst-div">
            <h4 style="padding-bottom:10px;">Instructions:</h4>
            <ol class="edit-list">
                <li>* Required Fields</li>
                <li>All fields are automatically filled with the original details. Please update with the new details in the fields you wish to edit.</li>
                <li><b>Schedule ID</b> cannot be changed.</li>
                <li>For changing staff details, please select the correct account ID to update the name.</li>
            </ol>
        </div>
    </div>
    <form action="" method="POST" class="edit-rec-form">
        <div class="label-field-div">
            <label for="schID">Schedule ID:</label>
            <input type="text" id="schID" name="scheduleID" value="<?php echo $scheduleIDRef?>" readonly>
        </div>
        <div class="label-field-div">
            <label for="tgID"><span>*</span> Tour Guide ID:</label>
            <select id="tgID" name="tourGuideID" required>
                <option value="">Select a tour guide ID</option>
                <?php
                    $queryB = "SELECT usr_ID FROM user_account_t WHERE usr_role = 'Tour guide';";
                    $resultsB = mysqli_query($connection, $queryB);
                    while ($dataB = mysqli_fetch_assoc($resultsB)) {
                ?>
                        <option value="<?php echo $dataB['usr_ID'];?>" <?php if ($gudIDRef == $dataB['usr_ID']) echo "selected"; ?>>
                            <?php echo $dataB['usr_ID'];?>
                        </option>
                <?php
                    }                                   
                ?>
            </select>          
        </div>

        <div class="label-field-div">
            <label for="bdID"><span>*</span> Bus driver ID:</label>
            <select id="bdID" name="busDriverID" required>
                <option value="">Select a bus driver ID</option>
                <?php
                    $queryC = "SELECT usr_ID FROM user_account_t WHERE usr_role = 'Bus driver';";
                    $resultsC = mysqli_query($connection, $queryC);
                    while ($dataC = mysqli_fetch_assoc($resultsC)) {
                ?>
                        <option value="<?php echo $dataC['usr_ID'];?>" <?php if ($drvIDRef == $dataC['usr_ID']) echo "selected"; ?>>
                            <?php echo $dataC['usr_ID'];?>
                        </option>
                <?php
                    }                                   
                ?>
            </select>          
        </div>
        <div class="label-field-div">
            <label for="itinID">Itinerary ID:</label>
            <select id="itinID" name="itineraryID">
                <option value="">Select a itinerary ID</option>
                <?php
                    $queryD = "SELECT itr_ID, itr_title FROM itinerary_t;";
                    $resultsD = mysqli_query($connection, $queryD);
                    while ($dataD = mysqli_fetch_assoc($resultsD)) {
                ?>
                        <option value="<?php echo $dataD['itr_ID'];?>" <?php if ($itrIDRef == $dataD['itr_ID']) echo "selected"; ?>>
                            <?php echo $dataD['itr_ID'];?> - <?php echo $dataD['itr_title'];?>
                        </option>
                <?php
                    }                                   
                ?>
            </select>          
        </div>
        <div class="label-field-div">
            <label for="scdTitle"><span>*</span> Title:</label>
            <input type="text" id="scdTitle" name="scheduleTitle" placeholder="E.g. 5D4N Trip Schedule" value="<?php echo $scdTitleRef;?>" required>
        </div>
        <div class="label-field-div">
            <label for="scdDesc">Description:</label>
            <textarea name="scheduleDesc" id="scdDesc" placeholder="E.g. This trip schedule lasts 5 days 4 nights in KL." rows="5"><?php echo $scdDescRef;?></textarea>
        </div>
        <div class="label-field-div">
            <label for="scdDura"><span>*</span> Duration:</label>
            <input type="text" id="scdDura" name="scheduleDuration" placeholder="E.g. 5 days 4 nights" value="<?php echo $scdDuraRef;?>" required>
        </div>
        <div class="label-field-div">
            <label for="scdStartDate"><span>*</span> Start Date:</label>
            <input type="date" id="scdStartDate" name="scheduleStartDate" value="<?php echo $scdStaDateRef;?>" required>
        </div>
        <div class="label-field-div">
            <label for="scdEndDate"><span>*</span> End Date:</label>
            <input type="date" id="scdEndDate" name="scheduleEndDate" value="<?php echo $scdEndDateRef;?>" required>
        </div>
        <div class="label-field-div">
            <label for="scdRemark">Remarks:</label>
            <textarea name="scheduleRemark" id="scdRemark" placeholder="E.g. This trip schedule is modified by staff-name." rows="5"><?php echo $scdRemark;?></textarea>
        </div>
        <div class="label-field-div">
            <label for="staffID"><span>*</span> Staff ID:</label>
            <select id="staffID" name="stfID" required>
                <option value="">Select a staff ID</option>
                <?php
                    $queryE = "SELECT usr_ID, usr_name FROM user_account_t WHERE usr_role = 'Office staff';";
                    $resultsE = mysqli_query($connection, $queryE);
                    while ($dataE = mysqli_fetch_assoc($resultsE)) {
                ?>
                        <option value="<?php echo $dataE['usr_ID'];?>" <?php if ($staffIDRef == $dataE['usr_ID']) echo "selected"; ?>>
                            <?php echo $dataE['usr_ID'];?> - <?php echo $dataE['usr_name'];?>
                        </option>
                <?php
                    }                                   
                ?>
            </select>          
        </div>
        <div class="form-buttons-div">
            <button type="submit" name="updateScheduleRec">
                <i class="ri-save-fill"></i>
                Update Schedule
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
        if (isset($_POST['updateScheduleRec'])) {
            include './staff_crud/updateSchedule.php';
        }
    ?>

    <?php include 'staff_footer.php';?>
</body>
</html>
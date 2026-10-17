<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: mng_scheduleInfo.php -->
<!-- Description: To create a manage trip schedule record info panel that shows trip schedule details and edit/delete buttons-->
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
    <link rel="stylesheet" href="./staff_styles/mng_recInfo.css">
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

        $tourGuideID = $dataA['gud_ID'];
        $busDriverID = $dataA['drv_ID'];
        $itineraryID = $dataA['itr_ID'];
        $scheduleTitle = $dataA['scd_title'];
        $scheduleDesc = $dataA['scd_desc'];
        $scheduleDuration = $dataA['scd_dura'];
        $scheduleStartDate = $dataA['scd_start_date'];
        $scheduleEndDate = $dataA['scd_end_date'];
        $scheduleRemark = $dataA['scd_remark'];
        $staffID = $dataA['stf_ID'];
        $staffName = $dataA['stf_name'];

        // Retrieve other values from other tables
        $queryB = "SELECT usr_name FROM user_account_t WHERE usr_ID = '$tourGuideID';";
        $resultsB = mysqli_query($connection, $queryB);
        $dataB = mysqli_fetch_assoc($resultsB);
        $tourGuideName = $dataB['usr_name'];
        
        $queryC = "SELECT usr_name FROM user_account_t WHERE usr_ID = '$busDriverID';";
        $resultsC = mysqli_query($connection, $queryC);
        $dataC = mysqli_fetch_assoc($resultsC);
        $busDriverName = $dataC['usr_name'];
        
        $queryD = "SELECT itr_title FROM itinerary_t WHERE itr_ID = '$itineraryID';";
        $resultsD = mysqli_query($connection, $queryD);
        $dataD = mysqli_fetch_assoc($resultsD);
        $itineraryTitle = $dataD['itr_title']; 
    ?>
        <div class="mng-rec-title-div">
            <h2 class="mng-rec-title">Manage Trip Schedule - View, Edit / Delete Record</h2>
        </div>
        <main class="mng-rec-main-div">
            <div class="mng-rec-heading-div">
                <h3 class="mng-rec-heading">General Info</h3>
            </div>
            <div class="mng-rec-info-div">
                <div class="info-div">
                    <p><b>Schedule ID: </b><?php echo $scheduleIDRef;?></p>
                    <p></p>
                    <p><b>Tour Guide ID: </b><?php echo $tourGuideID;?></p>
                    <p><b>Tour Guide Name: </b><?php echo $tourGuideName;?></p>
                    <p>
                        <b>Bus Driver ID: </b>
                        <?php
                            if($busDriverID == NULL) {
                                echo "-";
                            } else {
                                echo $busDriverID;
                            }
                        ?>
                    </p>
                    <p>
                        <b>Bus Driver Name: </b>
                        <?php
                            if($busDriverName == NULL) {
                                echo "-";
                            } else {
                                echo $busDriverName;
                            }
                        ?>
                    </p>
                    <p>
                        <b>Itinerary ID: </b>
                        <?php
                            if($itineraryID == NULL) {
                                echo "-";
                            } else {
                                echo $itineraryID;
                            }
                        ?>
                    </p>
                    <p>
                        <b>Itinerary Title: </b>
                        <?php
                            if($itineraryTitle == NULL) {
                                echo "-";
                            } else {
                                echo $itineraryTitle;
                            }
                        ?>
                    </p>
                </div>
            </div>
        </main>

        <main class="mng-rec-main-div">
            <div class="mng-rec-heading-div">
                <h3 class="mng-rec-heading">Schedule Info</h3>
            </div>
            <div class="mng-rec-info-div">
                <div class="info-div">
                    <p><b>Schedule Title: </b><?php echo $scheduleTitle;?></p>
                    <p><b>Schedule Desc: </b><?php echo $scheduleDesc;?></p>
                    <p><b>Duration: </b><?php echo $scheduleDuration;?></p>
                    <p><b>Start Date: </b><?php echo $scheduleStartDate;?></p>
                    <p><b>End Date: </b><?php echo $scheduleEndDate;?></p>
                    <p><b>Remarks: </b><?php echo $scheduleRemark;?></p>
                    <p><b>Staff ID: </b><?php echo $staffID;?></p>
                    <p><b>Staff Name: </b><?php echo $staffName;?></p>
                </div>
            </div>
            <div class="mng-rec-btn-div">
                <button class="editBtn" onclick="document.location='./edit_scheduleRec.php?scdID=<?php echo $scheduleIDRef;?>';">
                    <i class="ri-edit-2-fill"></i>
                    Edit
                </button>
                <!-- The button will trigger a popup box to alert for deletion -->
                <button class="delBtn" onclick="document.getElementById('delPopup2').style.display='block'">
                    <i class="ri-delete-bin-2-fill"></i>
                    Delete
                </button>
                <button class="otherBtn" onclick="document.location='manageTripSchedule.php';">
                    <i class="ri-arrow-left-line"></i>
                    Back
                </button>
            </div>
        </main>

        <main class="mng-rec-main-div">
            <div class="mng-rec-heading-div">
                <h3 class="mng-rec-heading">Schedule Timeslot Info</h3>
            </div>
            <div class="table-info-div">
                <table class="table-info">
                    <tr class="table-info-row">
                        <th class="table-info-header">Date</th>
                        <th class="table-info-header">Time</th>
                        <th class="table-info-header">Day</th>
                        <th class="table-info-header">Transp.</th>
                        <th class="table-info-header">Tasks</th>
                        <th class="table-info-header">Actions</th>
                    </tr>
                    <?php
                        $queryE = "SELECT * FROM scd_timeslot_list_t WHERE scd_ID = '$scheduleIDRef' ORDER BY tsl_day ASC;";
                        $resultsE = mysqli_query($connection, $queryE);
                        while($dataE = mysqli_fetch_assoc($resultsE)) {
                            $timeslotListIDRef = $dataE['tsl_list_ID'];
                    ?>
                            <tr class="table-info-row">
                                <td class="table-info-data"><?php echo $dataE['tsl_date'];?></td>
                                <td class="table-info-data"><?php echo $dataE['tsl_time'];?></td>
                                <td class="table-info-data"><?php echo $dataE['tsl_day'];?></td>
                                <td class="table-info-data"><?php echo $dataE['tsl_transp'];?></td>
                                <td class="table-info-data"><?php echo $dataE['tsl_task'];?></td>
                                <td class="table-info-data action-btn">
                                    <button class="editBtn" onclick="document.location='./edit_timeslotRec.php?timeslotID=<?php echo $timeslotListIDRef?>';" style="margin-bottom:15px;">
                                        <i class="ri-edit-2-fill"></i>
                                        Edit
                                    </button>
                                    <!-- The button will trigger a popup box to alert for deletion -->
                                    <form method="POST" onsubmit="return confirm('Are you sure you want to delete this timeslot? Action cannot be undone.');">
                                        <input type="hidden" name="timeslotLsIDRef" value="<?php echo $timeslotListIDRef; ?>">
                                        <button class="delBtn" type="submit" name="deleteTimeslotRec">
                                            <i class="ri-delete-bin-2-fill"></i>
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                    <?php
                        }
                    ?>
                </table>
            </div>
            <div class="mng-rec-btn-div table-rec-btn">
                <button class="editBtn" onclick="document.location='./add_timeslotRec.php?scdID=<?php echo $scheduleIDRef;?>';">
                    <i class="ri-add-box-fill"></i>
                    Add Timeslot
                </button>
            </div>
        </main>

        <!--
        <div id="delPopup" class="popupBox">
            <i onclick="document.getElementById('delPopup').style.display='none'" class="ri-close-large-fill closeIcon"></i>
            <form action="" method="POST" class="popup-form" >
                <div class="popup-form-div">
                    <h1>Delete Timeslot Record</h1>
                    <p>Are you sure you want to delete this timeslot? <span>Action cannot be undone.</span></p>
                
                    <div class="clearfix">
                        <input type="hidden" name="timeslotLsIDRef" id="deleteRefRec" value="">
                        <input type="button" onclick="document.getElementById('delPopup').style.display='none'" class="cancelbtn" value="Cancel">
                        <input type="submit" name="deleteTimeslotRec" onclick="document.getElementById('delPopup').style.display='none'" class="deletebtn" value="Delete">
                    </div>
                </div>
            </form>
        </div>
         -->

        <div id="delPopup2" class="popupBox">
            <i onclick="document.getElementById('delPopup2').style.display='none'" class="ri-close-large-fill closeIcon"></i>
            <form action="" method="POST" class="popup-form" >
                <div class="popup-form-div">
                    <h1>Delete Trip Schedule Record</h1>
                    <p>Are you sure you want to delete this trip schedule? <span>Action cannot be undone.</span></p>
                
                    <div class="clearfix">
                        <input type="button" onclick="document.getElementById('delPopup2').style.display='none'" class="cancelbtn" value="Cancel">
                        <input type="submit" name="deleteScheduleRec" onclick="document.getElementById('delPopup2').style.display='none'" class="deletebtn" value="Delete">
                    </div>
                </div>
            </form>
        </div>

    <?php include 'staff_footer.php';?>

    <?php
        if (isset($_POST['deleteTimeslotRec'])) {
            include './staff_crud/deleteTimeslot.php';
        }

        if (isset($_POST['deleteScheduleRec'])) {
            include './staff_crud/deleteSchedule.php';
        }
    ?>

    <!-- JavaScript for delete popup box -->
    <script src="./staff_js/deletePopUp.js"></script> 
</body>
</html>
<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: updateSchedule.php -->
<!-- Description: To update a schedule record with the new details inputted by the user into the database "tourlaysiadb". -->
<!-- Date first written: 12/7/2025 -->
<!-- Date last modified: 12/7/2025 -->

<?php
    include 'db_connection.php';

    if (isset($_POST['updateScheduleRec'])) {
        // Set variables with form values via POST method
        $scheduleID = $_POST['scheduleID'];
        $tourGuideID = $_POST['tourGuideID'];
        $busDriverID = $_POST['busDriverID'];
        $itineraryID = $_POST['itineraryID'];
        $scheduleTitle = $_POST['scheduleTitle'];
        $scheduleDesc = $_POST['scheduleDesc'];
        $scheduleDuration = $_POST['scheduleDuration'];
        $scheduleStartDate = $_POST['scheduleStartDate'];
        $scheduleEndDate = $_POST['scheduleEndDate'];
        $scdRemark = $_POST['scheduleRemark'];
        $stfID = $_POST['stfID'];

        // Retrieve staff name based on staff ID
        $query = "SELECT usr_name FROM user_account_t WHERE usr_ID = '$stfID';";
        $results = mysqli_query($connection, $query);
        $data = mysqli_fetch_assoc($results);
        $stfName = $data['usr_name'];

        // Update record with new details in table
        $query2 = "UPDATE trip_schedule_t SET gud_ID = '$tourGuideID', drv_ID = '$busDriverID', itr_ID = '$itineraryID', scd_title = '$scheduleTitle', scd_desc = '$scheduleDesc', scd_dura = '$scheduleDuration', scd_start_date = '$scheduleStartDate', scd_end_date = '$scheduleEndDate', scd_remark = '$scdRemark', stf_ID = '$stfID', stf_name = '$stfName' WHERE scd_ID = '$scheduleID';";
        $results2 = mysqli_query($connection, $query2);

        // Display message result
        if($results2) {
?>
            <script>
                alert("The schedule record has successfully been updated in the database. Please go to the schedule record info and view the latest changes.");
                window.location = "mng_scheduleInfo.php?scdID=<?php echo $scheduleID?>";
            </script>
<?php        
        } else {
?>
            <script>
                alert("Sorry! The schedule record has failed to be updated. Please try again.");
                window.location = "mng_scheduleInfo.php?scdID=<?php echo $scheduleID?>";
            </script>   
<?php
        }   
    }      
?>
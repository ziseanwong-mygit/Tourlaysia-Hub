<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: deleteSchedule.php -->
<!-- Description: To delete a schedule record from the database "tourlaysiadb". -->
<!-- Date first written: 13/7/2025 -->
<!-- Date last modified: 13/7/2025 -->

<?php
    include 'db_connection.php';

    if (isset($_POST['deleteScheduleRec'])) {
        // Delete records from child tables first, then the last one should be parent table
        $query = "DELETE FROM scd_timeslot_list_t WHERE scd_ID = '$scheduleIDRef';";
        $results = mysqli_query($connection, $query);

        $query2 = "DELETE FROM trip_schedule_t WHERE scd_ID = '$scheduleIDRef';";
        $results2 = mysqli_query($connection, $query2);

        // Display message result
        if($results && $results2) {
?>
            <script>
                alert("The schedule record has successfully been deleted from the database. Please go to the manage schedule record page and view the latest changes.");
                window.location = "manageTripSchedule.php"; // Back to manage schedule page
            </script>
<?php        
        } else {
?>
            <script>
                alert("Sorry! The schedule record has failed to be deleted. Please try again.");
                window.location = "mng_scheduleInfo.php?scdID=<?php echo $scheduleIDRef?>";
            </script>   
<?php
        }   
    }      
?>
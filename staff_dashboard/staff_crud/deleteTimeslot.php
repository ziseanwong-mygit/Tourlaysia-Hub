<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: deleteTimeslot.php -->
<!-- Description: To delete a timeslot record of the selected schedule from the database "tourlaysiadb". -->
<!-- Date first written: 13/7/2025 -->
<!-- Date last modified: 13/7/2025 -->

<?php
    include 'db_connection.php';

    if (isset($_POST['deleteTimeslotRec'])) {
        // Set variable
        $timeslotLsIDRef = $_POST['timeslotLsIDRef'];

        // Delete records from child tables first, then the last one should be parent table
        $query = "DELETE FROM scd_timeslot_list_t WHERE tsl_list_ID = '$timeslotLsIDRef';";
        $results = mysqli_query($connection, $query);

        // Display message result
        if($results) {
?>
            <script>
                alert("The schedule timeslot record has successfully been deleted from the database. Please go to the schedule record info and view the latest changes.");
                window.location = "mng_scheduleInfo.php?scdID=<?php echo $scheduleIDRef?>";
            </script>
<?php        
        } else {
?>
            <script>
                alert("Sorry! The schedule timeslot record has failed to be deleted. Please try again.");
                window.location = "mng_scheduleInfo.php?scdID=<?php echo $scheduleIDRef?>";
            </script>   
<?php
        }   
    }
?>
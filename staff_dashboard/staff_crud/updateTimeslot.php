<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: updateTimeslot.php -->
<!-- Description: To update a timeslot record with the new details inputted by the user into the database "tourlaysiadb". -->
<!-- Date first written: 12/7/2025 -->
<!-- Date last modified: 12/7/2025 -->

<?php
    include 'db_connection.php';

    if (isset($_POST['updateTimeslotRec'])) {
        // Set variables with form values via POST method
        $timeslotID = $_POST['timeslotID'];
        $scheduleID = $_POST['scheduleID'];
        $timeslotDate = $_POST['timeslotDate'];
        $timeslotTime = $_POST['timeslotTime'];
        $timeslotDay = $_POST['timeslotDay'];        
        $timeslotTrasnp = $_POST['timeslotTrasnp'];
        $timeslotTasks = $_POST['timeslotTasks'];

        // Update record with new details in table
        $query = "UPDATE scd_timeslot_list_t SET tsl_date = '$timeslotDate', tsl_time = '$timeslotTime', tsl_day = '$timeslotDay', tsl_transp = '$timeslotTrasnp', tsl_task = '$timeslotTasks' WHERE tsl_list_ID = '$timeslotID';";
        $results = mysqli_query($connection, $query);

        // Display message result
        if($results) {
?>
            <script>
                alert("The timeslot record has successfully been updated in the database. Please go to the schedule record info and view the latest changes in the timeslot record.");
                window.location = "mng_scheduleInfo.php?scdID=<?php echo $scheduleID?>";
            </script>
<?php        
        } else {
?>
            <script>
                alert("Sorry! The timeslot record has failed to be updated. Please try again.");
                window.location = "mng_scheduleInfo.php?scdID=<?php echo $scheduleID?>";
            </script>   
<?php
        }   
    }      
?>
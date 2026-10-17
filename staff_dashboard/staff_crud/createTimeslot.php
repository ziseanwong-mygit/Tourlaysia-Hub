<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: createTimeslot.php -->
<!-- Description: To add a timeslot record into the database "tourlaysiadb". -->
<!-- Date first written: 12/7/2025 -->
<!-- Date last modified: 12/7/2025 -->

<?php
    include 'db_connection.php';

    function generateID($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
    
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
    
        return $randomString;
    }

    if (isset($_POST['addTimeslotRec'])) {
        // Set variables for details from add_timeslotRec.php
        $scheduleID = $_POST['scheduleID'];
        $timeslotDate = $_POST['timeslotDate'];
        $timeslotTime = $_POST['timeslotTime'];
        $timeslotDay = $_POST['timeslotDay'];
        $timeslotTrasnp = $_POST['timeslotTrasnp'];
        $timeslotTasks = $_POST['timeslotTasks'];

        // Generate bill item record ID
        $tslListID = "TSL_" . generateID();

        $query = "INSERT INTO scd_timeslot_list_t VALUES ('$tslListID', '$scheduleID', '$timeslotDate', '$timeslotTime', '$timeslotDay', '$timeslotTrasnp', '$timeslotTasks');";
        $results = mysqli_query($connection, $query);

        // Display message result
        if($results) {
?>
            <script>
                alert("A timeslot record has successfully been created and saved into the database. Please go to the schedule record info and view the latest timeslot record.");
                window.location = "mng_scheduleInfo.php?scdID=<?php echo $scheduleID?>";
            </script>
<?php        
        } else {
?>
            <script>
                alert("Sorry! The timeslot record has failed to be created and saved. Please try again.");
                window.location = "mng_scheduleInfo.php?scdID=<?php echo $scheduleID?>";
            </script>   
<?php
        }   
    }      
?>
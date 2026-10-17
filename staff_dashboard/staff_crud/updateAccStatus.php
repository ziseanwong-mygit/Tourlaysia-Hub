<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: updateAccStatus.php -->
<!-- Description: To update the status of the selected booking for confirming/rejecting/cancelling bookings in database 'tourlaysiadb' -->
<!-- Date first written: 13/7/2025 -->
<!-- Date last modified: 13/7/2025 -->

<?php
    include 'db_connection.php';

    if (isset($_POST['updateAccStatus'])) {
        // Set variables with form values via POST method
        $accountID = $_POST['usrID'];
        $accountStatus = $_POST['accountStatus'];

        // Update record with new details in table
        $query = "UPDATE user_account_t SET usr_status = '$accountStatus' WHERE usr_ID = '$accountID';";
        $results = mysqli_query($connection, $query);
        
        // Display message result
        if($results) {
?>
            <script>
                alert("The status of selected account record has successfully been updated in the database. Please go to the account record info and view the latest changes.");
                window.location = "mng_userAccInfo.php?userID=<?php echo $accountID?>";
            </script>
<?php        
        } else {
?>
            <script>
                alert("Sorry! The status of selected account record has failed to be updated. Please try again.");
                window.location = "mng_userAccInfo.php?userID=<?php echo $accountID?>";
            </script>   
<?php
        }   
    }      
?>
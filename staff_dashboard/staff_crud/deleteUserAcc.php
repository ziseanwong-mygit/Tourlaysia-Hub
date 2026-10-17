<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: deleteUserAcc.php -->
<!-- Description: To delete a user account record from the database "tourlaysiadb". -->
<!-- Date first written: 13/7/2025 -->
<!-- Date last modified: 13/7/2025 -->

<?php
    include 'db_connection.php';

    if (isset($_POST['deleteUserAccRec'])) {
        $query = "DELETE FROM user_account_t WHERE usr_ID = '$userIDRef';";
        $results = mysqli_query($connection, $query);

        // Display message result
        if($results) {
?>
            <script>
                alert("The user account record has successfully been deleted from the database. Please go to the manage user account record page and view the latest changes.");
                window.location = "manageUser.php"; 
            </script>
<?php        
        } else {
?>
            <script>
                alert("Sorry! The user account record has failed to be deleted. Please try again.");
                window.location = "mng_userAccInfo.php?userID=<?php echo $userIDRef?>";
            </script>   
<?php
        }   
    }      
?>
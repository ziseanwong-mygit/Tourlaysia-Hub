<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: delete_account.php -->
<!-- Description: To delete a user account record from the database "tourlaysiadb". -->
<!-- Date first written: 13/7/2025 -->
<!-- Date last modified: 13/7/2025 -->

<?php
    include 'db_connection.php'; // Connect database

    if(isset($_POST['deleteAccount'])) {
        // Retrieve ID from session variable
        $userIDRef = $_SESSION['SES_UserID'];
            
        // Delete account record from table
        $query = "DELETE FROM user_account_t WHERE usr_ID = '$userIDRef';";
        $results = mysqli_query($connection, $query);

        // Display message result
        if($results) {
            // Unset session variable and destroy session
            unset($_SESSION['SES_UserID']);
            session_destroy();
?>
            <script>
                alert("Your account has been successfully deleted from the database. You are now logged out from the website. We are sorry to see you go, and hope to reconsider in joining us and using our service again. Thank you.");
                window.location = "./index.php";
            </script>
<?php        
        } else {
?>
            <script>
                alert("Oops! Your user account cannot be deleted. Please try again.");
                window.location = "home_page.php";
            </script>   
<?php
        }   
    }      
?>
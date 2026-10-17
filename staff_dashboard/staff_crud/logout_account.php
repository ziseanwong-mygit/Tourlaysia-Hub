<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: logout_account.php -->
<!-- Description: To allow users to log out of their account, by terminating the session. -->
<!-- Date first written: 13/7/2025 -->
<!-- Date last modified: 13/7/2025 -->

<?php
    include 'db_connection.php'; // Connect database

    if(isset($_POST['logOutAccount'])) {

        $refUserID = $_SESSION['SES_UserID']; // Retrieve user ID with session variable

        // Select record and store value
        $query = "SELECT * FROM user_account_t WHERE usr_ID = '$refUserID';";
        $results = mysqli_query($connection, $query);
        $data = mysqli_fetch_assoc($results);
    
        $role = $data['usr_role'];

        // Unset session variable and destroy session
        unset($_SESSION['SES_UserID']);
        session_destroy();

        // Display message based on user role
        if ($role == "Tourist") {
?>
            <script>
                alert("You have successfully logged out your tourist account! You can log back in your account at anytime. Tourlaysia thanks you for using the provided service for booking tours and trusting our professionalism!")
                window.location = "../index.php";
            </script> 
<?php
        } else {
?>
            <script>
                alert("You have successfully logged out your staff account! You can log back in your account at anytime. We thank you for helping us to manage both the organization and website for our customer's support.")
                window.location = "../index.php";
            </script>
<?php
        }
    }
?>
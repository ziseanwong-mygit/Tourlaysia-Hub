<!-- Programmer Name: Seath Tan Ziren
Project Name: change_password.php
Description: To change user password in database after user confirm changes on chnagePasswordPage.php.
Date first written: 14/6/2025 
Date last modified: 26/6/2025   -->

<?php
    include 'db_connection.php';

    if(isset($_SESSION['SES_UserID'])) {
        $getUserID = $_SESSION['SES_UserID'];
        $currentPassword = $_POST['currentPassword'];
        $newPassword = $_POST['newPassword'];
        $confirmNewPassword = $_POST['confirmNewPassword'];

        $query = "SELECT * FROM user_account_t WHERE usr_id = '$getUserID';";
        $results = mysqli_query($connection, $query);
        $data = mysqli_fetch_assoc($results);

        $refPassword = $data['usr_pswd'];

        if ($currentPassword != $refPassword){
?>      
            <script>
                alert("Your current password is incorrect. Please re-enter your current password again!");
            </script> 
<?php
        //different password and confirm password
        } else if ($newPassword != $confirmNewPassword) {
?>      
            <script>
                alert("Your password does not match with confirm password. Please re-enter your password again!");
            </script> 
<?php
        } else {
            $query2 = "UPDATE user_account_t SET usr_pswd='$newPassword' WHERE usr_ID='$getUserID';";
            $results2 = mysqli_query($connection, $query2);

            if ($results2) {
?>
                <script>
                    alert("You have successfully updated your account password!");
                    window.location = "accountDashboard.php";
                </script>
<?php
            } 
        }
    }
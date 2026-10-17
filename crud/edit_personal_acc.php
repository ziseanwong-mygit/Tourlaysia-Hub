<!-- Programmer Name: Seath Tan Ziren
Project Name: edit_personal_acc.php
Description: To change user details in database after user confirm changes.
Date first written: 14/6/2025 
Date last modified: 26/6/2025 -->

<?php
    include 'db_connection.php';

    if(isset($_SESSION['SES_UserID'])) {
        $results2 = FALSE;

        $refID = $_SESSION['SES_UserID'];
        $email = $_POST['email'];
        $name = $_POST['fullName'];
        $telno = $_POST['contactNumber'];
        $gender = $_POST['gender'];
        $country = $_POST['country'];
        $filename = $_FILES["profImg"]["name"];
        //$password = $_POST['password'];

        $query = "UPDATE user_account_t SET usr_name='$name', usr_email='$email', usr_no_tel='$telno', 
                  usr_gender='$gender', usr_country='$country' WHERE usr_ID='$refID';";
        $results = mysqli_query($connection, $query);

        if (!empty($filename)) {
            $oldImgName = $getImgName;

            $tempname = $_FILES["profImg"]["tmp_name"];
            $folder = "../img/profile/" . $filename;

            $query2 = "UPDATE user_account_t SET usr_prof_pic='$filename' WHERE usr_ID='$refID';";

            $results2 = mysqli_query($connection, $query2);

            if($results2) {
                unlink("../img/profile/" . $oldImgName);
                move_uploaded_file($tempname, $folder);
            }
        }

        //update details and image
        if ($results && $results2) {
    ?>
        <script>
            alert("You have successfully updated your account info! Your profile image has also been replaced with new one. Please check your account.");
            window.location = "accountDashboard.php";
        </script>
    <?php
        //update details only
        } else if ($results) {
    ?>
        <script>
            alert("You have successfully updated your account info! Please check your account.");
            window.location = "accountDashboard.php";
        </script>
    <?php
        //no update
        } else {
    ?>
        <script>
            alert("Oh no! Your updating account process has failed! Please try again.");
            window.location = "accountDashboard.php";
        </script>
    <?php
        }

    } 
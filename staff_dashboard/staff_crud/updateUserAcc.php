<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: updateUserAcc.php -->
<!-- Description: To update a user account record with the new details inputted by the user into the database "tourlaysiadb". -->
<!-- Date first written: 12/7/2025 -->
<!-- Date last modified: 12/7/2025 -->

<?php
    include 'db_connection.php';

    if (isset($_POST['updateUsrAcc'])) {
        // Set variables with form values via POST method
        $usrID = $_POST['usrID'];
        $userDocType = $_POST['userDocType'];
        $userDocID = $_POST['userDocID'];
        $userName = $_POST['userName'];
        $userEmail = $_POST['userEmail'];        
        $userNoTel = $_POST['userNoTel'];
        $userGender = $_POST['userGender'];
        $userCountry = $_POST['userCountry'];
        $userGender = $_POST['userGender'];
        $filename = $_FILES["userProfilePic"]["name"];
        $userJobPos = $_POST['userJobPos'];
        $userDept = $_POST['userDept'];
        $userPswd = $_POST['userPswd'];

        // Update record with new details in table
        $query = "UPDATE user_account_t SET usr_doc_ID = '$userDocID', usr_name = '$userName', usr_email = '$userEmail', usr_no_tel = '$userNoTel', usr_gender = '$userGender', usr_country = '$userCountry', usr_pswd = '$userPswd' WHERE usr_ID = '$usrID';";
        $results = mysqli_query($connection, $query);

        // If user role is Office staff / Admin / Tour guide / Bus driver, update job position and department
        if ($userRole != "Tourist") {
            $query2 = "UPDATE user_account_t SET usr_job_pos = '$userJobPos', usr_dep = '$userDept' WHERE usr_ID = '$usrID';";
            $results2 = mysqli_query($connection, $query2);
        } else {
            $results2 = TRUE;
        }

        if ($filename != NULL) {
            $oldImgName = $userProfPic;

            $tempname = $_FILES["userProfilePic"]["tmp_name"];
            $folder = "../img/profile/" . $filename;

            $query3 = "UPDATE user_account_t SET usr_prof_pic ='$filename' WHERE usr_ID = '$usrID';";
            $results3 = mysqli_query($connection, $query3);

            if($results3) {
                unlink("../img/profile/" . $oldImgName);
                move_uploaded_file($tempname, $folder);
            }
        } else {
            $results3 = TRUE;
        }
    
        // Display message result
        if($results && $results2 && $results3) {
?>
            <script>
                alert("The user account record has successfully been updated in the database. Please go to the user account record info and view the latest changes in the timeslot record.");
                window.location = "mng_userAccInfo.php?userID=<?php echo $usrID?>";
            </script>
<?php        
        } else {
?>
            <script>
                alert("Sorry! The user account record has failed to be updated. Please try again.");
                window.location = "mng_userAccInfo.php?userID=<?php echo $usrID?>";
            </script>   
<?php
        }   
    }      
?>